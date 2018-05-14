<?php

return [

	/*
    |--------------------------------------------------------------------------
    | General Information
    |--------------------------------------------------------------------------
    |
    | Declare general information to replace in the website.
    | Mostly for Terms, Privacy and Refund webpages.
    |
    |
    */

	'information' => [
		'support_website' => 'ccpay4.com',
		'support_email' => 'support@ccpay4.com',
		'support_phone_1' => '(760) 932-0811',
		'phone_number_1' => '7609320811',
        'support_phone_2' => '(888) 892-6136',
        'phone_number_2' => '8888926136',
		'website' => 'justclick4love.com',
		'company' => 'SW Ventures'
	],

	/*
    |--------------------------------------------------------------------------
    | Account Information
    |--------------------------------------------------------------------------
    |
    | Declare account constants.
    | First constant is related to account id for cancel subscription function
    | Second constant is related with provided price in membership upsell offer
    |
    */

    'netbilling_account' => [
    	'C_ACCOUNT' => '110200694156',
    	'R_AMOUNT' => '4.95'
    ],

    /*
    |--------------------------------------------------------------------------
    | Site Information
    |--------------------------------------------------------------------------
    |
    | Declare account constants.
    | Site ID from official website ex: 'justclick4love.com'
    | First constant is the official site tag
    | Second constant is name of token which API is waiting for
    | Third constant is the value of token which API is waiting for
    |
    */

    'netbilling_api' => [
        'site_id' => '229',
        'site_tag' => 'JC4L',
        'nb_account' => 'NB2',
        'token_name' => 'fa9985ed',
        'token_value' => 'a695bfcc-6944-4958-be00-c8de055ffd24'
    ]

];