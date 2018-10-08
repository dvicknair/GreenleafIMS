<?php

class ReportsController extends Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        
    }
    public function onConstruct()
    {
        if ($this->session->has('auth')) {

        } else {
            $this->flash->error("You must be logged in to continue");
            $this->dispatcher->forward([
                'controller' => "users",
                'action' => 'index'
            ]);
        }
    }

}