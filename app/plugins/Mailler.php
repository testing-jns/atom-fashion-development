<?php 

namespace plugins;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once(PATH_APP ."/views/mailer/template.php");

class Mailler {
    private static $mail;
    private static $success = false;
    private static function initialize($target, $url_verify) {
        self::$mail = new PHPMailer(true);

        self::$mail->isSMTP();
        self::$mail->Host       = PM_HOST;
        self::$mail->SMTPAuth   = true;
        self::$mail->Username   = PM_USER;
        self::$mail->Password   = PM_PASS;
        self::$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        self::$mail->Port       = 465;

        self::$mail->setFrom(PM_USER, PM_NAME);
        self::$mail->addAddress($target);
        self::$mail->addReplyTo(PM_USER, PM_NAME);

        self::$mail->Subject = "Email Confirmation";
        self::$mail->Body    = template($url_verify);
        self::$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
    }

    private static function execute() {
        try {
            self::$mail->send();
            self::$success = true;
        } catch (Exception $exception) {
            // create logs
            // self::logs()
        }
    }

    private static function response() {
        return ["success" => self::$success];
    }

    public static function run($target, $url_verify) {
        self::initialize($target, $url_verify);
        self::execute();
        return self::response();
    }
}