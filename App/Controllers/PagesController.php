<?php

namespace App\Controllers;


class PagesController extends AppController
{

    public function index()
    {
        $this->layout = "home";
        $d['metas'] = $this->Page->getFirst([
           "where" => ['ref' => 'home']
        ]);

        return $this->set($d);
    }

    public function contact()
    {
        $this->layout = "default";
        $d['metas'] = $this->Page->getFirst([
            "where" => ['ref' => 'contact']
        ]);
        
        $this->loadModel("Contact");
        if ($this->Request->isPost) {
            $d['posted'] = $this->Request->data;
            if ($this->Contact->validate($d['posted'])) {
                $subject = isset($d['posted']->subject) ? ' : ' . $d['posted']->subject : '';
                $this->loadComponent("Mailer");
                $this->Mailer->addAddress($_ENV['MAIL_USERNAME']);
                $this->Mailer->Subject = "Swith:: Un nouveau message" . $subject;
                $this->Mailer->Body = $d['posted']->msg;
                $this->Mailer->isHTML(true);
                if (!$this->Mailer->send()) {
                    $this->Session->setFlash($this->Mailer->ErrorInfo, 'error');
                } else {
                    $this->Session->setFlash("Votre message à bien été envoyé");
                    $this->redirect($this->Request->referer);
                }
            } else {
                $d['errors'] = $this->Contact->getErrors();
                $this->Session->setFlash("Veuillez verifier vos informations", 'error');
            }
        }

        return $this->set($d);
    }

    public function about()
    {
        $this->layout = "default";
        $d['metas'] = $this->Page->getFirst([
            "where" => ['ref' => 'about']
        ]);

        return $this->set($d);
    }

}
