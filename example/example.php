<?php

/**
 * mail.php
 */

use ChrisDfr\Simplemail\Simplemail;
use ChrisDfr\ConfigJSON\ConfigJSON as Cfg;

require dirname(__DIR__) . str_replace("/", DIRECTORY_SEPARATOR, "/vendor/autoload.php");

Cfg::load(dirname(__DIR__) . str_replace("/", DIRECTORY_SEPARATOR, "/conf/conf.json"));

$mail = Simplemail::getMailer(Cfg::$setting['host'], Cfg::$setting['user'], Cfg::$setting['password'], true, false);

try {
    $mail->isHTML(true);
    $mail->setFrom(Cfg::$setting['email'], Cfg::$setting['name']);
    $mail->addAddress(Cfg::$setting['to'], Cfg::$setting['name']);
    $mail->Subject = "Test d'envoi d'email";
    $mail->Body = "Coucou, ceci est une message <b>HTML en gras</b>";
    $mail->AltBody = "Coucou, ceci est une message texte sans html";
    $mail->send();
    echo "Le message a bien été envoyé." . PHP_EOL;
}
catch(Exception $e) {
    echo "Le message n'a pas pu être envoyé. Mailer Error: " . $mail->ErrorInfo . PHP_EOL;
    exit(1);
}
