<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\LookupFormRequest;
use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\ConfirmationFormRequest;
use App\Http\Requests\CCLookupFormRequest;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7;
use GuzzleHttp\Client;

class AccountController extends Controller
{
	//--- Lookup Section ---//

	public function lookup()
	{
		//Get general information
		$info = config('constants.information');
		//Get the view depending on version
		$view = 'sections.lookup';

		//Get ip address
		$ip_address = $this->get_ip_address();
		Log::info('Lookup Form Webpage | ip_address: '.$ip_address);

		return view($view)->with('info', $info);
	}

	public function search(LookupFormRequest $request)
	{
		if (count($request->all()) > 1) {
			//Request data
			$member_id = $request->input('member_id');
			$email = $request->input('email');
			$username = $request->input('username');
			$password = $request->input('password');
			$cc_number = $request->input('cc_number');
			$recaptcha = $request->input('g-recaptcha-response');
			//Get client's ip address
			$ip_address = !empty($request->ip()) ? $request->ip() : $this->get_ip_address();
			//Get current url
			$url = $request->fullUrl();

			//Store Lookup information in LOGS
			Log::info('Lookup Form | ip_address: '.$ip_address.' - memberid: '.$member_id.' - email: '.$email.' - username: '.$username.' - password: '.$password.' - cc_number: '.$cc_number.' - URL: '.$url);

			if ($ip_address) {
				//Get information from ipinfo.io
				$location_data = $this->get_info_by_ip($ip_address);
				//filter data if api has sent a response
				if ($location_data) {
					$country = $location_data->country;
					$city = $location_data->city;

					//Store location info from client in LOGS
					Log::info('Lookup Form | ip_address: '.$ip_address.' - country: '.$country.' - city: '.$city.' - URL: '.$url);
				}
			}

			//Get site id
			$website_details = config('constants.netbilling_api');
			$site_id = $website_details['site_id'];

			if (!$recaptcha) {
				//No recaptcha sent in request
				return redirect()->route('lookup')->withErrors('Something went wrong!. Please reload and try again.');
			}

			//Check if request parameters exist
			if (($email && $username) || ($email && $member_id) || ($email && $password) || ($username && $member_id) || ($username && $password) || ($member_id && $password)) {
				//SQL Query - Account Lookup
				$account = DB::table('member')
							->join('member_info', 'member.memberid', '=', 'member_info.memberid')
							->join('site', 'member.siteid', '=', 'site.siteid')
							->join('tour', 'member.siteid', '=', 'tour.siteid')
							->join('member_subscription', 'member.memberid', '=', 'member_subscription.memberid')
							->join('biller_option_detail', function($join) {
								$join->on('member_subscription.billerid', '=', 'biller_option_detail.billerid')
									 ->on('tour.tourid', '=', 'biller_option_detail.tourid');
							})
							->select('member_subscription.memberidx', 'biller_option_detail.field_value', 'biller_option_detail.tourid', 'member_info.firstname', 'member_info.lastname', 'member.email', 'member.username', 'member.password', 'tour.url')
							->where('biller_option_detail.field_name', '=', 'biller_siteinfo_access_keyword')							
							->where(function ($query) use ($site_id, $email, $username) {
								$query->where('member.siteid', $site_id)
									  ->where('member.email', $email)
									  ->where('member.username', $username);
							})
							->orWhere(function ($query) use ($site_id, $email, $member_id) {
								$query->where('member.siteid', $site_id)
									  ->where('member.email', $email)
									  ->where('member_subscription.memberidx', 'NETBILLING:' . $member_id);
							})
							->orWhere(function ($query) use ($site_id, $email, $password) {
								$query->where('member.siteid', $site_id)
									  ->where('member.email', $email)
									  ->where('member.password', $password);
							})
							->orWhere(function ($query) use ($site_id, $username, $member_id) {
								$query->where('member.siteid', $site_id)
									  ->where('member.username', $username)
									  ->where('member_subscription.memberidx', 'NETBILLING:' . $member_id);
							})
							->orWhere(function ($query) use ($site_id, $username, $password) {
								$query->where('member.siteid', $site_id)
									  ->where('member.username', $username)
									  ->where('member.password', $password);
							})
							->orWhere(function ($query) use ($site_id, $member_id, $password) {
								$query->where('member.siteid', $site_id)
									  ->where('member_subscription.memberidx', 'NETBILLING:' . $member_id)
									  ->where('member.password', $password);
							})
							->first();

				//Account Found
				if ($account) {
					//Process data to get just member id
					$memberid_arr = explode(':', $account->memberidx);
					$memberidx = end($memberid_arr);

					//Create account information array
					$acc_info = array(
						'member_id' => $memberidx,
						'first_name' => $account->firstname,
						'last_name' => $account->lastname,
						'email' => $account->email,
						'username' => $account->username,
						'password' => $account->password,
						'site_url' => $account->url
					);

					//Store account information in LOGS
					Log::info('Lookup Form | ip_address: '.$ip_address.' - account_info(keys): '.implode(",", array_keys($acc_info)).' - account_info(values): '.implode(",", $acc_info).' - URL: '.$url);


					//Store information in session
					$request->session()->put('account', $acc_info);
					//Redirect to result function
					return redirect()->route('result');
				} else {
					//Store not found register in LOGS
					Log::info('Lookup Form | ip_address: '.$ip_address.' - Account Not Found - URL: '.$url);

					//Account membership not found
					return redirect()->route('lookup')->withErrors('Account membership not found.');
				}
			} elseif($cc_number) {
				//Search account by credit card
				$response = $this->search_by_cc($cc_number);

				//Store Lookup information in LOGS
				Log::info('Lookup Form | ip_address: '.$ip_address.' - cc_number: '.$cc_number.' - URL: '.$url);

				//Check result
				if (isset($response->found) && ($response->found == true)) {
					//Get just account details
					$account = $response->member;
					//Get formatted url. ex: http://www.example.com
					$new_url = $this->format_to_site_url($account->PrimarySite);

					//Set account information
					$acc_info = array(
						'member_id' => $account->MemberID,
						'first_name' => $account->FirstName,
						'last_name' => $account->LastName,
						'email' => $account->Email,
						'username' => $account->Login,
						'password' => $account->Password,
						'site_url' => $new_url
					);

					//Store account information in LOGS
					Log::info('Lookup Form (cc) | ip_address: '.$ip_address.' - account_info(keys): '.implode(",", array_keys($acc_info)).' - account_info(values): '.implode(",", $acc_info).' - URL: '.$url);
					
					//Store information in session
					$request->session()->put('account', $acc_info);
					//Redirect to result function
					return redirect()->route('result');
				} else {
					//Store not found register in LOGS
					Log::info('Lookup Form (cc) | ip_address: '.$ip_address.' - Account Not Found - URL: '.$url);

					//Account membership not found by credit card
					return redirect()->route('lookup')->withErrors('Account membership not found.');
				}
			} else {
				//No data in sent request
				return redirect()->route('lookup')->withErrors('Please enter two or more parameters');
			}
		} else {
			//No data in sent request
			return redirect()->route('lookup')->withErrors('Please enter two or more parameters');
		}
	}

	public function result(LookupFormRequest $request)
	{
		//Account information
		$customer = $request->session()->pull('account');

		if (empty($customer)) {
			//Go back to lookup form
			return redirect()->route('lookup');
		}

		//Get general information
		$info = config('constants.information');
		//Get the view depending on version
		$view = 'sections.account';

		//Get ip address
		$ip_address = $this->get_ip_address();
		Log::info('Result Webpage | ip_address: '.$ip_address);

		return view($view)->with(['info' => $info, 'customer' => $customer]);
	}

	//--- Cancel Subscription Section ---//

	public function cancel()
	{
		//Get general information
		$info = config('constants.information');
		//Get the view depending on version
		$view = 'sections.cancel';

		//Get ip address
		$ip_address = $this->get_ip_address();
		Log::info('Cancel Form Webpage | ip_address: '.$ip_address);

		return view($view)->with('info', $info);
	}

	public function login(LoginFormRequest $request)
	{
		if (count($request->all()) > 1) { 
			//Request data
			$username = $request->input('username');
			$password = $request->input('password');
			$cc_number = $request->input('cc_number');
			$recaptcha = $request->input('g-recaptcha-response');
			//Get client's ip address
			$ip_address = !empty($request->ip()) ? $request->ip() : $this->get_ip_address();
			//Get current url
			$url = $request->fullUrl();

			//Store Login information in LOGS
			Log::info('Login Form | ip_address: '.$ip_address.' - username: '.$username.' - password: '.$password.' - cc_number: '.$cc_number.' - URL: '.$url);

			if ($ip_address) {
				//Get information from ipinfo.io
				$location_data = $this->get_info_by_ip($ip_address);
				//filter data if api has sent a response
				if ($location_data) {
					$country = $location_data->country;
					$city = $location_data->city;

					//Store location info from client in LOGS
					Log::info('Login Form | ip_address: '.$ip_address.' - country: '.$country.' - city: '.$city.' - URL: '.$url);
				}
			}

			//Get site id
			$website_details = config('constants.netbilling_api');
			$site_id = $website_details['site_id'];

			if (!$recaptcha) {
				//No recaptcha sent in request
				return redirect()->route('cancel')->withErrors('Something went wrong!. Please reload and try again.');
			}

			if($cc_number) {
				//Search account by credit card
				$response = $this->search_by_cc($cc_number);

				//Store Login information in LOGS
				Log::info('Login Form | ip_address: '.$ip_address.' - cc_number: '.$cc_number.' - URL: '.$url);

				//Account found by credit card
				if (isset($response->found) && ($response->found == true)) {
					//Get just account details
					$account = $response->member;
					//Get formatted url. ex: http://www.example.com
					$new_url = $this->format_to_site_url($account->PrimarySite);

					//Define user credentials
					$username = $account->Login;
					$password = $account->Password;					
				} else {
					//Store not found register in LOGS
					Log::info('Login Form (cc) | ip_address: '.$ip_address.' - Account Not Found - URL: '.$url);

					//Account membership not found by credit card
					return redirect()->route('cancel')->withErrors('Account membership not found.');
				}
			}

			//Check if request parameters exist
			if ($username && $password) {
				//SQL Query - Account Lookup
				$account = DB::table('member')
							->join('member_subscription', 'member.memberid', '=', 'member_subscription.memberid')
							->join('tour', 'member.siteid', '=', 'tour.siteid')
							->join('biller_option_detail', function($join) {
								$join->on('member_subscription.billerid', '=', 'biller_option_detail.billerid')
									 ->on('tour.tourid', '=', 'biller_option_detail.tourid');
							})
							->select('member_subscription.memberidx', 'biller_option_detail.field_value', 'biller_option_detail.tourid')
							->where('biller_option_detail.field_name', '=', 'biller_siteinfo_access_keyword')
							->where(function ($query) use ($site_id, $username, $password) {
								$query->where('member.siteid', $site_id)
									  ->where('member.username', $username)
									  ->where('member.password', $password);
							})
							->first();

				//Account Found
				if ($account) {
					//Process data to get just member id
					$memberid_arr = explode(':', $account->memberidx);
					$memberidx = end($memberid_arr);

					//Create account information array
					$acc_info = array(
						'member_id' => $memberidx,
						'netbilling_key' => $account->field_value,
						'id' => $account->tourid
					);

					//Store account information in LOGS
					Log::info('Login Form | ip_address: '.$ip_address.' - account_info(keys): '.implode(",", array_keys($acc_info)).' - account_info(values): '.implode(",", $acc_info).' - URL: '.$url);

					//Store information in session
					$request->session()->put('account_details', $acc_info);
					//Redirect to confirmation function
					return redirect()->route('confirmation');
				} else {
					//Store not found register in LOGS
					Log::info('Login Form | ip_address: '.$ip_address.' - Account Not Found - URL: '.$url);

					//Account membership not found
					return redirect()->route('cancel')->withErrors('Account membership not found.');
				}
			} else {
				//No data in sent request
				return redirect()->route('cancel')->withErrors('Please insert credentials.');
			}
		} else {
			//No data in sent request
			return redirect()->route('cancel')->withErrors('Please insert credentials or credit card digits.');
		}
	}

	public function confirmation()
	{
		//Get general information
		$info = config('constants.information');
		//Get the view depending on version
		$view = 'sections.confirmation';

		//Get ip address
		$ip_address = $this->get_ip_address();
		Log::info('Confirmation Webpage | ip_address: '.$ip_address);

		return view($view)->with('info', $info);
	}

	public function process(ConfirmationFormRequest $request) 
	{
		//Get data from login
		$details = $request->session()->pull('account_details');

		if (empty($details)) {
			//Go back to cancellation form
			return redirect()->route('lookup');
		}

		//Get client's ip address
		$ip_address = $request->ip();
		//Get current url
		$url = $request->fullUrl();

		//Store Lookup information in LOGS
		Log::info('Process | ip_address: '.$ip_address.' - acc_details: '.$details.' - URL: '.$url);

		if($request->input('cancel_subscription')) {
			//Cancel Subscription
			$type = 'cancellation';

		} elseif ($request->input('update_membership')) {
			//New Membership
			$type = 'membership';

		} else {
			//Keep in confirmation view
			return redirect()->route('confirmation');
		}

		//Store Lookup information in LOGS
		Log::info('Process | ip_address: '.$ip_address.' - process_type: '.$type.' - URL: '.$url);

		if (!$type || !$details) {
			//Redirect and show message from server
			return redirect()->route('cancel')->withErrors('Something went wrong with request parameters. Please try again.');
		} else {
			//Execute function to connect to netbilling server
			$response = $this->execute_request($type, $details);

			//Get response information
			$status = $response->getStatusCode();
			$msg = $this->get_reason_phrase($response);

			switch ($status) {
				case 200:
						//Everything went good
						return redirect()->route($type);
					break;

				case 400:
						//Redirect and show message from server
						return redirect()->route('cancel')->withErrors($msg);
					break;

				default:
						//Redirect and show error message
						return redirect()->route('cancel')->withErrors('Please try again later. Something went wrong with your request.');
					break;
			}
		}
	}

	public function cancellation()
	{
		//Get general information
		$info = config('constants.information');
		//Get the view depending on version
		$view = 'sections.cancellation';

		//Get ip address
		$ip_address = $this->get_ip_address();
		Log::info('Cancellation Webpage | ip_address: '.$ip_address);

		return view($view)->with('info', $info);
	}

	public function membership()
	{
		//Get general information
		$info = config('constants.information');
		//Get the view depending on version
		$view = 'sections.membership';

		//Get ip address
		$ip_address = $this->get_ip_address();
		Log::info('Membership Webpage | ip_address: '.$ip_address);

		return view($view)->with('info', $info);
	}

	public function cc_lookup(CCLookupFormRequest $request)
	{ 
		if (count($request->all()) > 1) {
			//Request data
			$first_digits = $request->input('first_digits');
			$last_digits = $request->input('last_digits');
			$recaptcha = $request->input('g-recaptcha-response');
			//Get client's ip address
			$ip_address = !empty($request->ip()) ? $request->ip() : $this->get_ip_address();
			//Get current url
			$url = $request->fullUrl();

			if ($ip_address) {
				//Get information from ipinfo.io
				$location_data = $this->get_info_by_ip($ip_address);
				//filter data if api has sent a response
				if ($location_data) {
					$country = $location_data->country;
					$city = $location_data->city;

					//Store location info from client in LOGS
					Log::info('CC Lookup Form | ip_address: '.$ip_address.' - country: '.$country.' - city: '.$city.' - URL: '.$url);
				}
			}

			if (!$recaptcha) {
				//No recaptcha sent in request
				return redirect()->route('index')->withErrors('Something went wrong!. Please reload and try again.');
			}

			if ($first_digits && $last_digits) {
				//Get complete credit card number
				$cc_number = $this->combine_numbers($first_digits, $last_digits);

				//Store CC Lookup information in LOGS
				Log::info('CC Lookup Form | ip_address: '.$ip_address.' - cc_number: '.$cc_number.' - URL: '.$url);
				
				//Get information by cc number
				$response = $this->search_by_cc($cc_number);

				if (isset($response->found) && ($response->found == true)) {
					//Get just account details
					$account = $response->member;
	
					//Get formatted url. ex: http://www.example.com
					$new_url = $this->format_to_site_url($account->PrimarySite);

					//Set account information
					$acc_info = array(
						'member_id' => $account->MemberID,
						'first_name' => $account->FirstName,
						'last_name' => $account->LastName,
						'email' => $account->Email,
						'username' => $account->Login,
						'password' => $account->Password,
						'site_url' => $new_url
					);

					//Store account information in LOGS
					Log::info('CC Lookup Form | ip_address: '.$ip_address.' - account_info(keys): '.implode(",", array_keys($acc_info)).' - account_info(values): '.implode(",", $acc_info).' - URL: '.$url);
					
					//Store information in session
					$request->session()->put('account', $acc_info);
					//Redirect to result function
					return redirect()->route('result');
				} else {
					//Store not found register in LOGS
					Log::info('CC Lookup Form | ip_address: '.$ip_address.' - Account Not Found - URL: '.$url);

					//Account membership not found by credit card
					return redirect()->route('index')->withErrors('Account membership not found.');
				}
			} else {
				//Insert required fields
				return redirect()->route('index')->withErrors('Please insert required fields.');
			}
		} else {
			//No data in sent request
			return redirect()->route('index')->withErrors('Please insert required fields.');
		}
	}

	//--- Utility Functions ---//

	public function execute_request($type, $details)
	{
		//Get information about netbilling account
		$netbilling_info = config('constants.netbilling_account');
		$account = $netbilling_info['C_ACCOUNT'];
		$amount = $netbilling_info['R_AMOUNT'];

		//Set query string
		$query_string = array(
			'C_ACCOUNT' => $account,
			'C_MEMBER_ID' => $details['member_id'],
			'C_CONTROL_KEYWORD' => $details['netbilling_key'],
			'C_COMMAND' => 'STOP_RECURRING',
		);

		//Add items for special type
		if ($type == 'membership') {
			$query_string['C_COMMAND'] = 'SET';
			$query_string['C_WRITABLE_FIELDS'] = 'R_NEXT_AMOUNT,R_RECURRING_AMOUNT';
			$query_string['R_NEXT_AMOUNT'] = $amount;
			$query_string['R_RECURRING_AMOUNT'] = $amount;
		}

		//Start request
		$client = new Client([
			'base_uri' => 'http://secure.netbilling.com',
			'timeout' => 10000,
			'http_errors' => false
		]);

		//Send a request to http://secure.netbilling.com
		$response = $client->request('GET', '/gw/native/mupdate1.1', [
			'query' => $query_string
		]);

		return $response;
	}

	public function search_by_cc ($cc_number)
	{
		//Process cc_number
		$formatted_cc_number = $this->format_to_cc_number($cc_number);

		//Get information about netbilling api
		$netbilling_api = config('constants.netbilling_api');
		$site_tag = $netbilling_api['site_tag'];
		$nb_account = $netbilling_api['nb_account'];
		$token_name = $netbilling_api['token_name'];
		$token_value = $netbilling_api['token_value'];

		//Set headers
		$headers = array(
			'Content-Type' => 'application/json', 
			'tag' => $nb_account,
			$token_name => $token_value
		);

		//Set query string
		$query_string = array(
			'SiteTag' => $site_tag,
			'CardInfo' => $formatted_cc_number
		);

		//Start request
		$client = new Client([
			'base_uri' => 'http://netbillling-api.herokuapp.com',
			'http_errors' => false
		]);

		//Send a request to https://netbillling-api.herokuapp.com
		$response = $client->request('POST', '/api/v1/lookup', [
			'headers' => $headers ,
			'json' => $query_string 
		]);

		$ans = $response->getBody()->getContents();

		return json_decode($ans);
	}

	public function format_to_cc_number ($cc_number) 
	{
		//Convert to required format by NB API
		$delete_spaces = str_replace(' ', '', $cc_number);
		return str_replace('XXXXXX', '%', $delete_spaces);
	}

	public function format_to_site_url ($site_url) 
	{
		//Provides format to url
		$new_array = explode('(', $site_url);
		if (is_array($new_array) && count($new_array) > 1) {
			$last_item = end($new_array);
			return 'http://www.' . str_replace(')', '.com', $last_item);			
		} else {
			return 'http://www.' . $site_url . '.com';
		}
	}

	public function combine_numbers ($first_digits, $last_digits)
	{
		//Combine numbers
		return $first_digits . 'XXXXXX' . $last_digits;
	}

	public function get_reason_phrase ($response)
	{
		//Get readable response phrase
		$reason_phrase = explode(':', $response->getReasonPhrase());
		return is_array($reason_phrase) == true ? end($reason_phrase) : $reason_phrase;
	}

	public function get_info_by_ip ($ip_address)
	{   //$ip_address = '186.1.29.114';
		//Set query string
		$query_string = array(
			'token' => 'e922b95b5c0a0a',
		);

		//Start request
		$client = new Client([
			'base_uri' => 'https://ipinfo.io',
			'timeout' => 10000,
			'http_errors' => false
		]);

		//Send a request to https://ipinfo.io
		$response = $client->request('GET', '/'.$ip_address.'/json', [
			'query' => $query_string
		]);

		$ans = $response->getBody()->getContents();

		return json_decode($ans);
	}

	public function get_ip_address ()
	{
		$ip_address = '';

		if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && ('' !== trim($_SERVER['HTTP_X_FORWARDED_FOR']))) {
            $ip_address = trim($_SERVER['HTTP_X_FORWARDED_FOR']);
        } else {
            if (isset($_SERVER['REMOTE_ADDR']) && ('' !== trim($_SERVER['REMOTE_ADDR']))) {
                $ip_address = trim($_SERVER['REMOTE_ADDR']);
            }
        }

        return $ip_address;
	}

}
