<?php

class Part extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
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
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("greenleaf");
        $this->setSource("part");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'part';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Part[]|Part|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Part|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
