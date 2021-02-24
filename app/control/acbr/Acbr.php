<?php

class Acbr implements Iacbr
{
    protected $formaIntegracao ;
    protected object $acbr ;
    private $idTrans;

    public function __construct( object $acbr)
    {
        $this->acbr = $acbr;
        //var_dump($acbr);


    }

    public function setCmd($comando)
    {
        if($this->acbr instanceof Iacbr){
            $this->acbr->setCmd($comando);
        }

    }

    public function getRetCmd()
    {
        $ret = '';
        if($this->acbr instanceof Iacbr){
            $ret = $this->acbr->getRetCmd();
        }

        return $ret;
    }

    public function getArqsCmd()
    {
        // TODO: Implement getArqsCmd() method.
        if($this->acbr instanceof Iacbr) {
            $ret = $this->acbr->getArqsCmd();
        }
        return $ret;
    }
    public function setTransId($idTrans)
    {
        $this->idTrans = $idTrans;
        $this->acbr->setTransId($idTrans);
    }
}