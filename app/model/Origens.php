<?php

class Origens extends TRecord
{
    const TABLENAME  = 'origens';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('codigo');
        parent::addAttribute('titulo');
        parent::addAttribute('descricao');
            
    }

    /**
     * Method getTransacoess
     */
    public function getTransacoess()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('origem_id', '=', $this->id));
        return Transacoes::getObjects( $criteria );
    }
    /**
     * Method getFormatosChaveOrigems
     */
    public function getFormatosChaveOrigems()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('origem_id', '=', $this->id));
        return FormatosChaveOrigem::getObjects( $criteria );
    }

    
}

