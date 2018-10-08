<?php


class SalesController extends Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        $this->persistent->parameters = null;
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
    public function recordAction()
    {
        $partnum=$_POST['partnum'];
        $qty=$_POST['qty'];

        $conn = new mysqli('localhost','root','','greenleaf');
        $result = $conn->query("SELECT onhand FROM PART where partnumber='$partnum'");

        if(mysqli_num_rows($result)==0){
            $this->flash->error("Not a valid part number");
            $this->dispatcher->forward([
                'controller' => "sales",
                'action' => 'index'
            ]);
        } else {
            if($qty < 1){
                $this->flash->error("Quantity must be greater than 0");
                $this->dispatcher->forward([
                    'controller' => "sales",
                    'action' => 'index'
                ]);
            } else {
                $row = $result->fetch_assoc();
                $current = $row['onhand'];
                $conn->query("update part set onhand=$current-$qty where partnumber='$partnum'");

                $this->flash->success("Sale recorded successfully");

                $this->tag->setDefault("partnum", "");
                $this->tag->setDefault("qty", "");

                $this->dispatcher->forward([
                    'controller' => "sales",
                    'action' => 'index'
                ]);
            }
        }
    }
    public function salesnozzleAction()
    {

    }
    public function recordnozzleAction()
    {
        $partnum=$_POST['partnum'];
        $qty=$_POST['qty'];

        $conn = new mysqli('localhost','root','','greenleaf');
        $result = $conn->query("SELECT onhand FROM nozzle where partnumber='$partnum'");

        if(mysqli_num_rows($result)==0){
            $this->flash->error("Not a valid part number");
            $this->dispatcher->forward([
                'controller' => "sales",
                'action' => 'salesnozzle'
            ]);
        } else {
            if($qty < 1){
                $this->flash->error("Quantity must be greater than 0");
                $this->dispatcher->forward([
                    'controller' => "sales",
                    'action' => 'salesnozzle'
                ]);
            } else {
                $row = $result->fetch_assoc();
                $current = $row['onhand'];
                $conn->query("update nozzle set onhand=$current-$qty where partnumber='$partnum'");

                $this->flash->success("Sale recorded successfully");

                $this->tag->setDefault("partnum", "");
                $this->tag->setDefault("qty", "");

                $this->dispatcher->forward([
                    'controller' => "sales",
                    'action' => 'salesnozzle'
                ]);
            }
        }
    }

}