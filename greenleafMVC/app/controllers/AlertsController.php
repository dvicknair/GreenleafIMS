<?php

class AlertsController extends Phalcon\Mvc\Controller
{

    public function indexAction()
    {

    }
    public function onConstruct()
    {
        if ($this->session->has('auth')) {
            echo
            "
                <div class=\"page-header\" align=\"center\">
                    <h1>Alerts</h1>
                </div>
            ";
            $error = 'false';
            $conn = new mysqli('localhost', 'root', '', 'greenleaf');
            $result = $conn->query("SELECT * FROM PART");
            while ($row = $result->fetch_assoc()) {
                if ($row['onhand'] < $row['min']) {
                    $error = 'true';
                    $part = $row['partnumber'];
                    $this->flash->error("Part -$part- is below minimum stock level");
                }
            }
            $resultn = $conn->query("SELECT * FROM nozzle");
            while ($rown = $resultn->fetch_assoc()) {
                if ($rown['onhand'] < $rown['min']) {
                    $error = 'true';
                    $partn = $rown['partnumber'];
                    $this->flash->error("Nozzle -$partn- is below minimum stock level");
                }
            }
            if ($error == 'false') {
                $this->flash->success("All Inventory Levels OK!");
            }
            print_r($row);
        }
        else {
            $this->dispatcher->forward([
                'controller' => "users",
                'action' => 'index'
            ]);
        }
    }



}