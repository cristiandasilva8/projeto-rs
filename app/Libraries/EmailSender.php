<?php

namespace App\Libraries;

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
		$email = \Config\Services::email();

		$config = [
			'protocol' => 'smtp',
			'SMTPHost' => 'sandbox.smtp.mailtrap.io',
			'SMTPUser' => '5d950f417d719c',
			'SMTPPass' => '8149c1c3b61097',
			'SMTPPort' => 2525,
			'wordWrap' => true,
			// 'mailType' => 'html',
			// 'charset'  => 'utf-8',
		];
		
		$email->initialize($config);

		$email->setFrom($to, 'Your Name');
		$email->setTo('bruno.dc.felipe@gmail.com');
		// $email->setCC('another@another-example.com'); => Email da Empresa para vaga		

		// $template = view('template/emails/inscricao');

		$email->setSubject("email teste");
		$email->setMessage("Email enviado");	
				
		$email->send();
		// $email->printDebugger();		
	}   

	public function sendEmail()
	{	
	}
}
