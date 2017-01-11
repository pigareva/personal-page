<?php
require_once __DIR__ . '/../mail.php';

$response = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $body = file_get_contents('php://input');
    if (null === ($post = json_decode($body))) {
        throw new Exception('Bad json');
    }
	try {
		if (!isset($post['email'])) {
			throw new Exception('Missing email');
		}
		$email = trim($post['email']);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			throw new Exception('Invalid email');
		}

		if (!isset($post['name'])) {
			throw new Exception('Missing name');
		}
		$name = trim($post['name']);
		if (mb_strlen($name) < 4) {
			throw new Exception('Name is too short');
		}

		if (isset($post['phone'])) {
			$phone = trim($post['phone']);
			if (mb_strlen($phone) < 7) {
				throw new Exception('Phone number is too short');
			}
		} else {
			$phone = 'none';
		}

		if (!isset($post['message'])) {
			throw new Exception('Missing message');
		}
		$message = trim($post['message']);
		if (mb_strlen($message) < 10) {
			throw new Exception('Message is too short');
		}

        $body = "Name: ${name}\nEmail: ${email}\nPhone: ${phone}\nMessage: " . nl2br($message);
        $message = Swift_Message::newInstance('New Contact Request')
            ->setFrom(array('noreply@pigareva.de'))
            ->setTo(array('olga@pigareva.de'))
            ->setBody($body);

        $result = $mailer->send($message);

        $httpCode = 200;
        $httpText = 'OK';
	} catch (Exception $e) {
        $httpCode = 403;
        $httpText = 'Forbidden';
        $response = [
            'message' => $e->getMessage(),
        ];
	}
} else {
    $httpCode = 405;
    $httpText = 'Method Not Allowed';
}

header('Content-Type: application/json');
header('HTTP/1.1 ' . $httpCode . ' ' . $httpText);
echo json_encode($response);
