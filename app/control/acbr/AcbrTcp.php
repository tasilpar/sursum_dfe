<?php


class AcbrTcp implements Iacbr
{
    private $idTrans;

    public function __construct()
    {


    }

    public function setCmd($comando)
    {
        // TODO: Implement setCmd() method.
    }

    public function getRetCmd()
    {
        // TODO: Implement getRetCmd() method.
    }

    public function getArqsCmd()
    {
        // TODO: Implement getArqsCmd() method.
    }
    public function setTransId($idTrans)
    {
        $this->idTrans = $idTrans;
    }
}