<?php

class Listas extends TRecord
{
    const TABLENAME  = 'listas';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome');
        parent::addAttribute('descricao');
            
    }

    /**
     * Method getOpcoesListas
     */
    public function getOpcoesListas()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('lista_id', '=', $this->id));
        return OpcoesLista::getObjects( $criteria );
    }

    
}

