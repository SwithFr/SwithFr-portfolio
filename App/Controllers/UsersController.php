<?php

namespace App\Controllers;


use Core\Helpers\CSRFTool;

class UsersController extends AppController
{
    public $layout = "empty";

    public function connect()
    {
        if ($this->Request->isPost) {
            if ($this->Auth->login($this->User, $this->Request->data)) {
                CSRFTool::generateToken();
                if($this->Auth->role() === "admin") {
                    $this->redirect("works");
                } else {
                    $this->redirect("home");
                }
            } else {
                $this->Session->setFlash(_("Le mot de passe ou le login ne correspondent pas."), "error");
            }
        } elseif($this->Auth->isLogged()) {
            $this->Session->setFlash(_("Vous êtes déjà connecté."), "warning");
            $this->redirect("home");
        }
    }

    public function register()
    {
        if ($this->Request->isPost) {
            $this->Auth->register($this->User, $this->Request->data);
        }
    }

    public function logout()
    {
        CSRFTool::removeToken();
        $this->Auth->logout();
        $this->Session->setFlash(_("Vous êtes maintenant déconnecté."));
        $this->redirect($this->Request->referer);
    }
}