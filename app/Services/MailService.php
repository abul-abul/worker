<?php 

namespace App\Services;

use App\Contracts\MailInterface;
use Mail;


class MailService implements MailInterface
{

	/**	
	 * Send active profile message
	 *
	 * @param string $dataEmail
	 * @param string $email
	 * @return response
	 */
	public function send($dataEmail, $email, $phone)
	{
		
		Mail::send('mails.active_registration', $dataEmail, function($message) use ($email)
        {
            $message->from('Mr.Shasha@shasha.com');
            $message->to($email)->subject("Thank you for signing up to Mr Shasha");
        });
	}

	/**	
	 * Send forgos password hash
	 *
	 * @param string $data
	 * @param string $email
	 * @return response
	 */
	public function forgotPassHash($data, $email)
	{
		Mail::send('mails.forgot-password', $data, function($message) use ($email)
        {
            $message->from('Mr.Shasha@shasha.com');
            $message->to($email)->subject("Welcome!");
        });
	}

	/**	
	 * Send all task to providers by category
	 *
	 * @param array $data
	 * @param array $email
	 * @return response
	 */
	public function sendTaskToProviders($data, $email)
	{
		foreach ($email as $oneEmail){
			Mail::queue('mails.new-task', $data, function($message) use ($oneEmail)
	        {
	            $message->from('Mr.Shasha@shasha.com');
	            $message->to($oneEmail)->subject("Task!");
	        });
		}
	}

	public function sendToPosterAfterPosting($data, $email)
	{
		Mail::send('mails.to-poster-after-posting', $data, function($message) use ($email)
		{
			$message->from('Mr.Shasha@shasha.com');
			$message->to($email)->subject("Thank you for submitting your request");
		});
	}

	public function sendContact($data,$email)
	{
		Mail::send('mails.contact',$data, function($message) use ($email)
        {
            $message->from($email);
            $message->to('Mr.Shasha@shasha.com');
        });
	}


	public function sendRateToProvider($data,$email)
	{
		Mail::send('mails.provider-rate',$data,function($message) use ($email)
		{
			$message->from('Mr.Shasha@shasha.com');
			$message->to($email)->subject("Provider Rate!");
		});
	}


	public function sendRequestProividerjob($data,$email)
	{
		Mail::send('mails.send-request-provider-job',$data,function($message) use ($email)
		{
			$message->from('Mr.Shasha@shasha.com');
			$message->to($email)->subject("Request Task!");
		});
	}


	public function sendMessageNotSelectedInJob($data,$email)
	{
		Mail::send('mails.not-selected-job',$data,function($message) use ($email)
		{
			$message->from('Mr.Shasha@shasha.com');
			$message->to($email)->subject("Task!");
		});
	}


	public function sendMessageNotRateProvider($data,$email)
	{
		Mail::send('mails.not-rate-provider',$data,function($message) use ($email)
		{
			$message->from('Mr.Shasha@shasha.com');
			$message->to($email)->subject("Request Task!");
		});
	}
	

}