<?php

class Estados extends TRecord
{
    const TABLENAME  = 'estados';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'max'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('uf');
        parent::addAttribute('nome');
            
    }

    /**
     * Method getMunicipioss
     */
    public function getMunicipioss()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('estado_id', '=', $this->id));
        return Municipios::getObjects( $criteria );
    }

    
}

