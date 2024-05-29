<?php

namespace App\Libraries;

use PHPMailer\PHPMailer\PHPMailer;
use SendGrid;
use SendGrid\Mail\Mail;

class EmailSender
{
	/** @var Mail */
	protected $email;
	protected $to;
	protected $subject;
	protected $message;
	protected $title;
	protected $sendgrid;
	protected $debug;

    function __construct($to, $subject, $message, $title, $debug = false)
	{
		//Settings
/*		$this->email = new PHPMailer();
		$this->email->isSMTP();
		$this->email->isHTML();
		$this->email->Host = "email-ssl.com.br";;
		$this->email->Port = "587";
		$this->email->SMTPSecure = "tls";
		$this->email->SMTPAuth = true;
		$this->email->CharSet = 'UTF-8';		
		*/

        print_r("foi");
        die;
		// $this->debug = $debug;

		// $this->to = $to;
		// $this->subject = $subject;
		// $this->message = $message;
		// $this->title = $title;
		
		// $this->sendgrid = new SendGrid(getenv("sendgrid.apikey"));
		
		// /*$email->setFrom("contato@knut.expert", "Example User");
		// $email->setSubject("Sending with Twilio SendGrid is Fun");
		// $email->addTo("bruno.dc.felipe@gmail.com", "Example User");
		// $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
		// $email->addContent(
		// 	"text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
		// );*/		
		// $this->email = new Mail();
		// $this->email->setFrom("contato@knut.expert",$this->title);
		// $this->email->setSubject($this->subject);
		// $this->email->addTo($this->to);
		// $this->email->addContent(
		// 	"text/html", $this->message
		// );
		
	}

    public function teste()
    {
    
    }

	public function sendEmail()
	{	
		//$this->email->Username = "chamados@sossystem.com.br";
		//$this->email->Password ="Sos@@223344"; //colocar senha;
		
		//$this->email->addAddress($this->to);
		//$this->email->Subject = $this->subject;
		
		//$this->email->msgHTML($this->message);
		//$this->email->AltBody = "de:KNUT Expert \n email: contato@knut.expert  \n mensagem: Confirmação de Cadastro ";

		//$this->email->send();
		if($this->debug){
			try {
				$response = $this->sendgrid->send($this->email);
				print $response->statusCode() . "\n";
				print_r($response->headers());
				print $response->body() . "\n";
			} catch (Exception $e) {
				echo '<pre>';
				 $e->getMessage();
				 echo '</pre>';
			}
		}else{
				$this->sendgrid->send($this->email);
			}	
	}

	public function sendEmailSendGrid()
	{
		$email = new SendGrid();
	}

	public function changeMessage($message)
	{
		$this->message = $message;
	}

	public function changeEmailTo($email)
	{
		$this->to = $email;
	}
	public function addEmail($email, $nome)
	{
		$this->email->addBcc($email, $nome);
	}

}
