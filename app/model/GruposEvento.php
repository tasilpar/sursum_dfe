<?php

class GruposEvento extends TRecord
{
    const TABLENAME  = 'grupos_evento';
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
     * Method getEventoss
     */
    public function getEventoss()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('grupo_id', '=', $this->id));
        return Eventos::getObjects( $criteria );
    }

    
}

