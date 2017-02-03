<?php

namespace App\Contracts;

interface MailInterface
{
	/**	
	 * Send active profile message
	 *
	 * @param string $dataEmail
	 * @param string $email
	 * @return response
	 */
	public function send($dataEmail, $email, $phone);

	/**	
	 * Send forgos password hash
	 *
	 * @param string $data
	 * @param string $email
	 * @return response
	 */
	public function forgotPassHash($data, $email);

	/**	
	 * Send all task to providers by category
	 *
	 * @param array $data
	 * @param array $email
	 * @return response
	 */
	public function sendTaskToProviders($data, $email);

	/**	
	 * Send email to admin
	 *
	 * @param array $data
	 * @param string $email
	 * @return response
	 */
	public function sendContact($data,$email);
}