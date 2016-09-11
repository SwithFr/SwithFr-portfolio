<?php

namespace App\Controllers;


use Core\Helpers\CSRFTool;
use Core\Helpers\Image;
use Core\Helpers\ImageUploader;
use SwithError\SwithError;

class WorksController extends AppController
{

    public function index()
    {
        $this->loadModel("Page");
        $d['metas'] = $this->Page->getFirst([
            "where" => ['ref' => 'works']
        ]);

        $d['works'] = $this->Work->get([
            "where" => ['online' => 1],
            "order" => "id DESC"
        ]);

        return $this->set($d);
    }

    public function admin_add()
    {
        if ($this->Request->isPost && CSRFTool::check()) {
            $_SESSION['posted'] = $this->Request->data;
            if ($this->Work->validate($this->Request->data)) {
                $name = substr(md5($this->Request->data->title), 0, 10);
                $dest = BASE . DS . 'App' . DS . 'Webroot' . DS . 'img' . DS . 'works' . DS;
                ImageUploader::upload($_FILES['img'], $name, $dest);
                $this->Request->data->img = $name . Image::getExtension($_FILES['img']['name']);
                unset($_SESSION['posted']);
                $this->Work->create($this->Request->data);
                $this->Session->setFlash("Work added");
            } else {
                $this->Session->setFlash("Error", 'error');
            }
        }

        $this->redirect($this->Request->referer);
    }

    public function admin_delete($slug)
    {
        if ($this->Work->exist(['slug' => $slug])) {
            $work = $this->Work->getFirst([
                'fields' => 'id, img',
                'where' => ['slug' => $slug]
            ]);
            unlink(BASE . DS . 'App' . DS . 'Webroot' . DS . 'img' . DS . 'works' . DS . $work->img);
            $this->Work->delete($work->id);
        }
    }

    public function admin_edit($slug)
    {
        $this->needRender = false;
        if ($this->Request->isPost && $this->Work->exist(['slug' => $slug])) {
            if (isset($_REQUEST["PHPSESSID"])) {
                unset($_REQUEST["PHPSESSID"]);
            }
            $this->Work->update($slug, $_REQUEST);
        } else {
            (new SwithError([
                "title" => "Unknown error occured",
                "message" => "Request lost in the void..."
            ]))->display(false);
        }
    }

    public function admin_getDescription($slug)
    {
        $this->layout = 'empty';
        
        $work = $this->Work->getFirst([
            'fields' => 'description',
            "where" => ['slug' => $slug]
        ]);
        echo $work->description;
        die();
    }
}
