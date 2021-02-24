<?php

class Emissores extends TRecord
{
    const TABLENAME  = 'emissores';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('num_tipo_emissor');
        parent::addAttribute('nome');
            
    }

    /**
     * Method getDocsFiscals
     */
    public function getDocsFiscals()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('emissor_id', '=', $this->id));
        return DocsFiscal::getObjects( $criteria );
    }

    
}

