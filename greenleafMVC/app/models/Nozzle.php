<?php

class Nozzle extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=15, nullable=false)
     */
    public $id;

    /**
     *
     * @var string
     * @Column(type="string", length=15, nullable=false)
     */
    public $partnumber;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    public $description;

    /**
     *
     * @var integer
     * @Column(type="integer", length=7, nullable=false)
     */
    public $onhand;

    /**
     *
     * @var integer
     * @Column(type="integer", length=7, nullable=false)
     */
    public $min;

    /**
     *
     * @var integer
     * @Column(type="integer", length=7, nullable=false)
     */
    public $max;

    /**
     *
     * @var string
     * @Column(type="string", length=15, nullable=false)
     */
    public $p1;

    /**
     *
     * @var string
     * @Column(type="string", length=15, nullable=false)
     */
    public $p2;

    /**
     *
     * @var string
     * @Column(type="string", length=15, nullable=false)
     */
    public $p3;

    /**
     *
     * @var string
     * @Column(type="string", length=15, nullable=false)
     */
    public $p4;

    /**
     *
     * @var string
     * @Column(type="string", length=15, nullable=false)
     */
    public $p5;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("greenleaf");
        $this->setSource("nozzle");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'nozzle';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Nozzle[]|Nozzle|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Nozzle|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
