<?php


namespace Core\Components;


class Mailer extends \PHPMailer
{

    protected $instance = false;

    function __construct()
    {
        if (!$this->instance) {
            $this->instance = true;
            $this->isSMTP();
            $this->Host = $_ENV['MAIL_HOST'];
            $this->SMTPAuth = true;
            $this->Username = $_ENV['MAIL_USERNAME'];
            $this->Password = $_ENV['MAIL_PASSWORD'];
            $this->SMTPSecure = $_ENV['MAIL_SMTP_SECURE'];
            $this->Port = $_ENV['MAIL_SMTP_PORT'];
        }
    }

    public function layout($layout, $data = [])
    {
        extract($data);
        ob_start();
        require(BASE . DS . "App" . DS . "Views" . DS . "Layouts" . DS . "Emails" . DS . $layout . '.php');
        $this->Body = ob_get_clean();
        $this->isHTML();
    }
}