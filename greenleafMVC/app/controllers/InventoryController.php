<?php


class InventoryController extends Phalcon\Mvc\Controller
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
    /**
     * Displays the adjustment form
     */
    public function receiveAction()
    {

    }
    public function receiverAction()
    {
        $partnum=$_POST['partnum'];
        $qty=$_POST['qty'];

        $conn = new mysqli('localhost','root','','greenleaf');
        $result = $conn->query("SELECT onhand FROM PART where partnumber='$partnum'");

        if(mysqli_num_rows($result)==0){
            $this->flash->error("Not a valid part number");
            $this->dispatcher->forward([
                'controller' => "inventory",
                'action' => 'receive'
            ]);
        } else {
            if($qty < 1){
                $this->flash->error("Quantity must be greater than 0");
                $this->dispatcher->forward([
                    'controller' => "inventory",
                    'action' => 'receive'
                ]);
            } else {
                $row=$result->fetch_assoc();
                $current = $row['onhand'];
                $conn->query("update part set onhand=$current+$qty where partnumber='$partnum'");

                $this->flash->success("Part Received Successfully");

                $this->tag->setDefault("partnum","");
                $this->tag->setDefault("qty","");

                $this->dispatcher->forward([
                    'controller' => "inventory",
                    'action' => 'receive'
                ]);
            }
        }
    }
    /**
     * Displays the adjustment form
     */
    public function adjustAction()
    {

    }
    public function adjustmentAction()
    {
        $partnum=$_POST['partnum'];
        $qty=$_POST['qty'];

        $conn = new mysqli('localhost','root','','greenleaf');
        $result = $conn->query("SELECT onhand FROM PART where partnumber='$partnum'");
        if(mysqli_num_rows($result)==0){
            $this->flash->error("Not a valid part number");
            $this->dispatcher->forward([
                'controller' => "inventory",
                'action' => 'adjust'
            ]);
        } else {
            if($qty == 0){
                $this->flash->error("Adjustments of 0 quantity are not needed!");
                $this->dispatcher->forward([
                    'controller' => "inventory",
                    'action' => 'adjust'
                ]);
            } else {
                $row=$result->fetch_assoc();
                $current = $row['onhand'];
                $conn->query("update part set onhand=$current+$qty where partnumber='$partnum'");

                $this->flash->success("Part Adjustment Successful");

                $this->tag->setDefault("partnum","");
                $this->tag->setDefault("qty","");

                $this->dispatcher->forward([
                    'controller' => "inventory",
                    'action' => 'adjust'
                ]);
            }
        }
    }
    public function ordernozzlesAction()
    {

    }
    public function ordernAction()
    {
        $partnum=$_POST['partnum'];
        $qty=$_POST['qty'];

        $conn = new mysqli('localhost','root','','greenleaf');
        $result = $conn->query("SELECT * FROM nozzle where partnumber='$partnum'");

        if(mysqli_num_rows($result)==0){
            $this->flash->error("Not a valid part number");
            $this->dispatcher->forward([
                'controller' => "inventory",
                'action' => 'ordernozzles'
            ]);
        } else {
            if($qty < 1){
                $this->flash->error("Quantity must be greater than 0");
                $this->dispatcher->forward([
                    'controller' => "inventory",
                    'action' => 'ordernozzles'
                ]);
            } else {
                $row = $result->fetch_assoc();
                $p1 = $row['p1'];
                $p2 = $row['p2'];
                $p3 = $row['p3'];
                $p4 = $row['p4'];
                $p5 = $row['p5'];

                $resultpart = $conn->query("SELECT partnumber,onhand FROM PART where partnumber in ('$p1','$p2','$p3','$p4','$p5')");
                while ($rowpart = $resultpart->fetch_assoc()) {
                    $partcurr = $rowpart['onhand'];
                    $currpartnumber = $rowpart['partnumber'];
                    $conn->query("update part set onhand=$partcurr-$qty where partnumber='$currpartnumber'");
                }


                $current = $row['onhand'];


                $this->flash->success("Nozzle Order recorded");

                $this->tag->setDefault("partnum", "");
                $this->tag->setDefault("qty", "");

                $this->dispatcher->forward([
                    'controller' => "inventory",
                    'action' => 'ordernozzles'
                ]);
            }
        }
    }
    public function adjustnAction()
    {

    }
    public function adjustmentnAction()
    {
        $partnum=$_POST['partnum'];
        $qty=$_POST['qty'];

        $conn = new mysqli('localhost','root','','greenleaf');
        $result = $conn->query("SELECT onhand FROM nozzle where partnumber='$partnum'");
        if(mysqli_num_rows($result)==0){
            $this->flash->error("Not a valid part number");
            $this->dispatcher->forward([
                'controller' => "inventory",
                'action' => 'adjustn'
            ]);
        } else {
            if($qty == 0){
                $this->flash->error("Adjustments of 0 quantity are not needed!");
                $this->dispatcher->forward([
                    'controller' => "inventory",
                    'action' => 'adjustn'
                ]);
            } else {
                $row=$result->fetch_assoc();
                $current = $row['onhand'];
                $conn->query("update nozzle set onhand=$current+$qty where partnumber='$partnum'");

                $this->flash->success("Nozzle Adjustment Successful");

                $this->tag->setDefault("partnum","");
                $this->tag->setDefault("qty","");

                $this->dispatcher->forward([
                    'controller' => "inventory",
                    'action' => 'adjustn'
                ]);
            }
        }
    }
    public function receivenozzleAction()
    {

    }
    public function receivenAction()
    {
        $partnum=$_POST['partnum'];
        $qty=$_POST['qty'];

        $conn = new mysqli('localhost','root','','greenleaf');
        $result = $conn->query("SELECT * FROM nozzle where partnumber='$partnum'");

        if(mysqli_num_rows($result)==0){
            $this->flash->error("Not a valid part number");
            $this->dispatcher->forward([
                'controller' => "inventory",
                'action' => 'receivenozzle'
            ]);
        } else {
            if($qty < 1){
                $this->flash->error("Quantity must be greater than 0");
                $this->dispatcher->forward([
                    'controller' => "inventory",
                    'action' => 'receivenozzle'
                ]);
            } else {
                $row = $result->fetch_assoc();


                $current = $row['onhand'];
                $conn->query("update nozzle set onhand=$current+$qty where partnumber='$partnum'");


                $this->flash->success("Nozzle Received successfully");

                $this->tag->setDefault("partnum", "");
                $this->tag->setDefault("qty", "");

                $this->dispatcher->forward([
                    'controller' => "inventory",
                    'action' => 'receivenozzle'
                ]);
            }
        }
    }

}