<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

class InfoController extends Controller
{    
	//--- Information Section ---//

	public function index()
	{
		//Get general information
		$info = config('constants.information');
		//Get the view depending on version
		$view = 'sections.index';

		//Get ip address
		$ip_address = $this->get_ip_address();
		Log::info('Homepage | ip_address: '.$ip_address);

		return view($view)->with('info', $info);
	}

	public function terms()
	{
		//Get general information
		$info = config('constants.information');
		//Get the view depending on version
		$view = 'sections.terms';

		//Get ip address
		$ip_address = $this->get_ip_address();
		Log::info('Terms Webpage | ip_address: '.$ip_address);

		return view($view)->with('info', $info);
	}

	public function privacy()
	{
		//Get general information
		$info = config('constants.information');
		//Get the view depending on version
		$view = 'sections.privacy';

		//Get ip address
		$ip_address = $this->get_ip_address();
		Log::info('Privacy Webpage | ip_address: '.$ip_address);

		return view($view)->with('info', $info);
	}

	public function refund()
	{
		//Get general information
		$info = config('constants.information');
		//Get the view depending on version
		$view = 'sections.refund';

		//Get ip address
		$ip_address = $this->get_ip_address();
		Log::info('Refund Webpage | ip_address: '.$ip_address);

		return view($view)->with('info', $info);
	}

	//--- Utility Functions ---//

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
