<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class NozzleController extends ControllerBase
{
    /**
     * Index action
     */
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
     * Searches for nozzle
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Nozzle', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $nozzle = Nozzle::find($parameters);
        if (count($nozzle) == 0) {
            $this->flash->notice("The search did not find any nozzle");

            $this->dispatcher->forward([
                "controller" => "nozzle",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $nozzle,
            'limit'=> 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a nozzle
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $nozzle = Nozzle::findFirstByid($id);
            if (!$nozzle) {
                $this->flash->error("part was not found");

                $this->dispatcher->forward([
                    'controller' => "nozzle",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $nozzle->id;

            $this->tag->setDefault("id", $nozzle->id);
            $this->tag->setDefault("partnumber", $nozzle->partnumber);
            $this->tag->setDefault("description", $nozzle->description);
            $this->tag->setDefault("onhand", $nozzle->onhand);
            $this->tag->setDefault("min", $nozzle->min);
            $this->tag->setDefault("max", $nozzle->max);
            $this->tag->setDefault("p1", $nozzle->p1);
            $this->tag->setDefault("p2", $nozzle->p2);
            $this->tag->setDefault("p3", $nozzle->p3);
            $this->tag->setDefault("p4", $nozzle->p4);
            $this->tag->setDefault("p5", $nozzle->p5);

        }
    }

    /**
     * Creates a new nozzle
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "nozzle",
                'action' => 'index'
            ]);

            return;
        }

        $partnum=strtolower($this->request->getPost("partnumber"));
        $dup=0;

        $conn = new mysqli('localhost', 'root', '', 'greenleaf');
        $result = $conn->query("SELECT partnumber FROM nozzle");
        while ($row = $result->fetch_assoc()) {
            $lower=strtolower($row['partnumber']);
            if ($lower == $partnum) {
                $dup=1;
            }
            if($dup==1){break;}
        }

        if($dup!='1') {
            $nozzle = new Nozzle();
            $nozzle->partnumber = $this->request->getPost("partnumber");
            $nozzle->description = $this->request->getPost("description");
            $nozzle->onhand = $this->request->getPost("onhand");
            $nozzle->min = $this->request->getPost("min");
            $nozzle->max = $this->request->getPost("max");
            $nozzle->p1 = $this->request->getPost("p1");
            $nozzle->p2 = $this->request->getPost("p2");
            $nozzle->p3 = $this->request->getPost("p3");
            $nozzle->p4 = $this->request->getPost("p4");
            $nozzle->p5 = $this->request->getPost("p5");


            if (!$nozzle->save()) {
                foreach ($nozzle->getMessages() as $message) {
                    $this->flash->error($message);
                }

                $this->dispatcher->forward([
                    'controller' => "nozzle",
                    'action' => 'new'
                ]);

                return;
            }

            $this->flash->success("Nozzle was created successfully");

            $this->tag->setDefault("id", "");
            $this->tag->setDefault("partnumber", "");
            $this->tag->setDefault("description", "");
            $this->tag->setDefault("onhand", "");
            $this->tag->setDefault("min", "");
            $this->tag->setDefault("max", "");
            $this->tag->setDefault("p1", "");
            $this->tag->setDefault("p2", "");
            $this->tag->setDefault("p3", "");
            $this->tag->setDefault("p4", "");
            $this->tag->setDefault("p5", "");

            $this->dispatcher->forward([
                'controller' => "nozzle",
                'action' => 'new'
            ]);
        } else{
            $this->flash->error("Part number already exists");
            $this->dispatcher->forward([
                'controller' => "nozzle",
                'action' => 'new'
            ]);
        }
    }

    /**
     * Saves a nozzle edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "nozzle",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $nozzle = Nozzle::findFirstByid($id);

        if (!$nozzle) {
            $this->flash->error("nozzle does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "nozzle",
                'action' => 'index'
            ]);

            return;
        }

        $nozzle->partnumber = $this->request->getPost("partnumber");
        $nozzle->description = $this->request->getPost("description");
        $nozzle->onhand = $this->request->getPost("onhand");
        $nozzle->min = $this->request->getPost("min");
        $nozzle->max = $this->request->getPost("max");
        $nozzle->p1 = $this->request->getPost("p1");
        $nozzle->p2 = $this->request->getPost("p2");
        $nozzle->p3 = $this->request->getPost("p3");
        $nozzle->p4 = $this->request->getPost("p4");
        $nozzle->p5 = $this->request->getPost("p5");
        

        if (!$nozzle->save()) {

            foreach ($nozzle->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "nozzle",
                'action' => 'edit',
                'params' => [$nozzle->id]
            ]);

            return;
        }

        $this->flash->success("nozzle was updated successfully");

        $this->tag->setDefault("id", "");
        $this->tag->setDefault("partnumber", "");
        $this->tag->setDefault("description", "");
        $this->tag->setDefault("onhand", "");
        $this->tag->setDefault("min", "");
        $this->tag->setDefault("max", "");
        $this->tag->setDefault("p1", "");
        $this->tag->setDefault("p2", "");
        $this->tag->setDefault("p3", "");
        $this->tag->setDefault("p4", "");
        $this->tag->setDefault("p5", "");

        $this->dispatcher->forward([
            'controller' => "nozzle",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a nozzle
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $nozzle = Nozzle::findFirstByid($id);
        if (!$nozzle) {
            $this->flash->error("nozzle was not found");

            $this->dispatcher->forward([
                'controller' => "nozzle",
                'action' => 'index'
            ]);

            return;
        }

        if (!$nozzle->delete()) {

            foreach ($nozzle->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "nozzle",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("nozzle was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "nozzle",
            'action' => "index"
        ]);
    }

}
