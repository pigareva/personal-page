<?php

require_once __DIR__ . '/vendor/autoload.php';

$config = include_once __DIR__ . '/config.php';

$transport = Swift_SmtpTransport::newInstance('smtp.yandex.ru', 465, 'ssl')
  ->setUsername($config['username'])
  ->setPassword($config['password'])
;

$mailer = Swift_Mailer::newInstance($transport);

