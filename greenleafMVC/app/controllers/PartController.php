<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class PartController extends ControllerBase
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
     * Searches for part
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Part', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $part = Part::find($parameters);
        if (count($part) == 0) {
            $this->flash->notice("The search did not find any part");

            $this->dispatcher->forward([
                "controller" => "part",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $part,
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
     * Edits a part
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $part = Part::findFirstByid($id);
            if (!$part) {
                $this->flash->error("part was not found");

                $this->dispatcher->forward([
                    'controller' => "part",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $part->id;

            $this->tag->setDefault("id", $part->id);
            $this->tag->setDefault("partnumber", $part->partnumber);
            $this->tag->setDefault("description", $part->description);
            $this->tag->setDefault("onhand", $part->onhand);
            $this->tag->setDefault("min", $part->min);
            $this->tag->setDefault("max", $part->max);
            
        }
    }

    /**
     * Creates a new part
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "part",
                'action' => 'index'
            ]);

            return;
        }

        $partnum=strtolower($this->request->getPost("partnumber"));
        $dup=0;

        $conn = new mysqli('localhost', 'root', '', 'greenleaf');
        $result = $conn->query("SELECT partnumber FROM PART");
        while ($row = $result->fetch_assoc()) {
            $lower=strtolower($row['partnumber']);
            if ($lower == $partnum) {
                $dup=1;
            }
            if($dup==1){break;}
        }
        if($dup!='1') {
            $part = new Part();
            $part->partnumber = $this->request->getPost("partnumber");
            $part->description = $this->request->getPost("description");
            $part->onhand = $this->request->getPost("onhand");
            $part->min = $this->request->getPost("min");
            $part->max = $this->request->getPost("max");


            if (!$part->save()) {
                foreach ($part->getMessages() as $message) {
                    $this->flash->error($message);
                }

                $this->dispatcher->forward([
                    'controller' => "part",
                    'action' => 'new'
                ]);

                return;
            }

            $this->flash->success("part was created successfully");

            $this->tag->setDefault("id", "");
            $this->tag->setDefault("partnumber", "");
            $this->tag->setDefault("description", "");
            $this->tag->setDefault("onhand", "");
            $this->tag->setDefault("min", "");
            $this->tag->setDefault("max", "");

            $this->dispatcher->forward([
                'controller' => "part",
                'action' => 'new'
            ]);
        } else{
            $this->flash->error("Part number already exists");
            $this->dispatcher->forward([
                'controller' => "part",
                'action' => 'new'
            ]);
        }
    }

    /**
     * Saves a part edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "part",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $part = Part::findFirstByid($id);

        if (!$part) {
            $this->flash->error("part does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "part",
                'action' => 'index'
            ]);

            return;
        }

        $part->partnumber = $this->request->getPost("partnumber");
        $part->description = $this->request->getPost("description");
        $part->onhand = $this->request->getPost("onhand");
        $part->min = $this->request->getPost("min");
        $part->max = $this->request->getPost("max");
        

        if (!$part->save()) {

            foreach ($part->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "part",
                'action' => 'edit',
                'params' => [$part->id]
            ]);

            return;
        }

        $this->flash->success("part was updated successfully");

        $this->tag->setDefault("id", "");
        $this->tag->setDefault("partnumber", "");
        $this->tag->setDefault("description", "");
        $this->tag->setDefault("onhand", "");
        $this->tag->setDefault("min", "");
        $this->tag->setDefault("max", "");

        $this->dispatcher->forward([
            'controller' => "part",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a part
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $part = Part::findFirstByid($id);
        if (!$part) {
            $this->flash->error("part was not found");

            $this->dispatcher->forward([
                'controller' => "part",
                'action' => 'index'
            ]);

            return;
        }

        if (!$part->delete()) {

            foreach ($part->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "part",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("part was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "part",
            'action' => "index"
        ]);
    }

}
