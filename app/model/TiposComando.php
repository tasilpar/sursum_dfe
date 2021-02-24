<?php

class TiposComando extends TRecord
{
    const TABLENAME  = 'tipos_comando';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('descricao');
            
    }

    /**
     * Method getCmdss
     */
    public function getCmdss()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('tipo_comando_id', '=', $this->id));
        return Cmds::getObjects( $criteria );
    }

    
}

