<?php

require_once __DIR__ . '/vendor/autoload.php';

$transport = Swift_SmtpTransport::newInstance('smtp.yandex.ru', 465, 'ssl')
  ->setUsername('noreply@pigareva.de')
  ->setPassword('wap5oD2Lold4aUg3')
;

$mailer = Swift_Mailer::newInstance($transport);

