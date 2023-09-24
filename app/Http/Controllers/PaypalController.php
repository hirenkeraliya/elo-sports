<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Users;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

use Illuminate\Support\Facades\Crypt;	
class PaypalController extends Controller
{
     public function transferMoneyToPaypal(Request $request)
    {  
		$user_id = auth()->user()->id; // login user id 
		$amount=$request->amount;
		$paypal_email=$request->paypal_email;
		
		$validator_data=$request->validate([
		'paypal_email'	=> 'required|email' , // validare function		
		'amount'		=> 'required|integer|min:1'  // validare function		
		],
		[
		'paypal_email.required'=>'Paypal email id required',
		'paypal_email.email'=>'Invalid paypal email id',
		'amount.required'=>'Amount required',
		'amount.integer'=>'Invalid amount' ,
		'amount.min'=>'Invalid amount' 
		]
		);
		
		
		
		 $setting=Setting::find(1);
		 
		 
		  Users::where('id', $user_id)
                    ->update([
                        'paypal_email' => $paypal_email
                    ]);
		 
		  $user_info=Users::find($user_id);// get setting 	
		 
		 if($amount<=$user_info->elo_balance){
		 
			$vEmailSubject=$user_info->paypal_email;
			// Set request-specific fields.
			$emailSubject = urlencode($vEmailSubject);
			$receiverType = urlencode('EmailAddress');
			$currency = urlencode('USD'); // or other currency ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')

			// Receivers
			// Use '0' for a single receiver. In order to add new ones: (0, 1, 2, 3...)
			// Here you can modify to obtain array data from database.
			$receivers = array(
			  0 => array(
				'receiverEmail' => $user_info->paypal_email, 
				'amount' => $amount,
				'uniqueID' => $user_info->id, // 13 chars max
				'note' => " Elo Balnace Transfered ") 
			);
			$receiversLenght = count($receivers);

			// Add request-specific fields to the request string.
			$nvpStr="&EMAILSUBJECT=$emailSubject&RECEIVERTYPE=$receiverType&CURRENCYCODE=$currency";

			$receiversArray = array();

			for($i = 0; $i < $receiversLenght; $i++)
			{
			 $receiversArray[$i] = $receivers[$i];
			}

			foreach($receiversArray as $i => $receiverData)
			{
			 $receiverEmail = urlencode($receiverData['receiverEmail']);
			 $amount = urlencode($receiverData['amount']);
			 $uniqueID = urlencode($receiverData['uniqueID']);
			 $note = urlencode($receiverData['note']);
			 $nvpStr .= "&L_EMAIL$i=$receiverEmail&L_Amt$i=$amount&L_UNIQUEID$i=$uniqueID&L_NOTE$i=$note";
			}

			// Execute the API operation; see the PPHttpPost function above.
			$httpParsedResponseAr = $this->PPHttpPost('MassPay', $nvpStr);
//var_dump($httpParsedResponseAr); die;	
			if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"]))
			{
				//$elo_balance =  $amount;
				$wallet = new WalletTransaction;
				$wallet->user_id = $user_id;
				$wallet->bet_main_id = 0;
				$wallet->bet_id = 0;
				$wallet->game_id = 0;
				$wallet->win_side = '';
				$wallet->transaction_type = 'debit';
				$wallet->transaction_amount =$amount; 
				$wallet->comment = "withdrawal";
				$wallet->email_id = $paypal_email;
				$wallet->save();
				
                $upd = Users::where('id', $user_id)
                    ->update([
                        'elo_balance' => $user_info->elo_balance-$amount
                    ]);
				
				
				return redirect()->back()->with('status','Elo Balance - '.$amount.' Transfered To Your Paypal Account Successfully'); 
			}
			else
			{
				return redirect()->back()->with('error','Transcation  failed: ' . print_r($httpParsedResponseAr));  
			}
		
		 }else
			{
				return redirect()->back()->with('error','  You can withdrawal maximum '.$user_info->elo_balance.' amount  ' );
			}
		 
		 
		 
    }

	function transferMoneyPaypalToWallet(Request $request){
		 $status=$request->status;
		 $transaction_id=$request->transaction_id;
		 $elo_amount=$request->elo_amount;
		 $usd_amount=$request->usd_amount;
		 
		 
		$user_id = auth()->user()->id; // login user id 
		 $user_info=Users::find($user_id);// get setting 	
		
		//$elo_balance =  $amount;
				$wallet = new WalletTransaction;
				$wallet->user_id = $user_id;
				$wallet->bet_main_id = 0;
				$wallet->bet_id = 0;
				$wallet->game_id = 0;
				$wallet->win_side = '';
				$wallet->transaction_id = $transaction_id;
				$wallet->transaction_type = 'credit';
				$wallet->transaction_amount =$elo_amount; 
				$wallet->comment = "Deposit";
				$wallet->save();
				
                $upd = Users::where('id', $user_id)
                    ->update([
                        'elo_balance' => $user_info->elo_balance+$elo_amount
                    ]);
					  return json_encode(['success' => '1']); exit();
				
	}
	
		function PPHttpPost($methodName_, $nvpStr_)
		{
			
			 $setting=Setting::find(1);
				$environment = $setting->environment; // or 'beta-sandbox' or 'live'.

				 $API_UserName = urlencode(Crypt::decryptString($setting->api_username));
				 $API_Password = urlencode(Crypt::decryptString($setting->api_password));
				 $API_Signature = urlencode(Crypt::decryptString($setting->api_signature));
				 $API_Endpoint = "https://api-3t.paypal.com/nvp";
				 if("sandbox" === $environment || "beta-sandbox" === $environment)
				 {
				  $API_Endpoint = "https://api-3t.$environment.paypal.com/nvp";
				 }
				 $version = urlencode('51.0');

				 // Set the curl parameters.
				 $ch = curl_init();
				 curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
				 curl_setopt($ch, CURLOPT_VERBOSE, 1);

				 // Turn off the server and peer verification (TrustManager Concept).
				 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
				 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

				 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				 curl_setopt($ch, CURLOPT_POST, 1);

				 // Set the API operation, version, and API signature in the request.
				 $nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_";

				 // Set the request as a POST FIELD for curl.
				 curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);

				 // Get response from the server.
				 $httpResponse = curl_exec($ch);

				 if( !$httpResponse)
				 {
				  exit("$methodName_ failed: " . curl_error($ch) . '(' . curl_errno($ch) .')');
				 }

				 // Extract the response details.
				 $httpResponseAr = explode("&", $httpResponse);

				 $httpParsedResponseAr = array();
				 foreach ($httpResponseAr as $i => $value)
				 {
				  $tmpAr = explode("=", $value);
				  if(sizeof($tmpAr) > 1)
				  {
				   $httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
				  }
				 }

				 if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr))
				 {
				  exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
				 }

				 return $httpParsedResponseAr;
		}
 }
