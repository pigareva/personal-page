<?php
require_once __DIR__ . '/../mail.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	try {
		if (!isset($_POST['email'])) {
			throw new Exception('Missing email');
		}
		$email = trim($_POST['email']);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			throw new Exception('Invalid email');
		}

		if (!isset($_POST['name'])) {
			throw new Exception('Missing name');
		}
		$name = trim($_POST['name']);
		if (mb_strlen($name) < 4) {
			throw new Exception('Name is too short');
		}

		if (isset($_POST['phone'])) {
			$phone = trim($_POST['phone']);
			if (mb_strlen($phone) < 7) {
				throw new Exception('Phone number is too short');
			}
		} else {
			$phone = 'none';
		}

		if (!isset($_POST['message'])) {
			throw new Exception('Missing message');
		}
		$message = trim($_POST['message']);
		if (mb_strlen($message) < 10) {
			throw new Exception('Message is too short');
		}
	} catch (Exception $e) {
		echo $e->getMessage();
		exit(1);
	}

	$body = "Name: ${name}\nEmail: ${email}\nPhone: ${phone}\nMessage: " . nl2br($message);
	$message = Swift_Message::newInstance('New Contact Request')
		->setFrom(array('noreply@pigareva.de'))
		->setTo(array('olga@pigareva.de'))
		->setBody($body);

	$result = $mailer->send($message);
	header('Location: http://www.pigareva.de/');
}

