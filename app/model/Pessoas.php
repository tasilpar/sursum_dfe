<?php

class Pessoas extends TRecord
{
    const TABLENAME  = 'pessoas';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('id_federal');
        parent::addAttribute('razao_social');
        parent::addAttribute('num_tipo_pessoa');
            
    }

    /**
     * Method getDocsFiscals
     */
    public function getDocsFiscals()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('pessoa_id', '=', $this->id));
        return DocsFiscal::getObjects( $criteria );
    }

    
}

