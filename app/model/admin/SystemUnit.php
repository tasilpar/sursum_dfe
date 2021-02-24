<?php

class SystemUnit extends TRecord
{
    const TABLENAME  = 'system_unit';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'max'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('name');
        parent::addAttribute('connection_name');
            
    }

    /**
     * Method getDocsFiscals
     */
    public function getDocsFiscals()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('unid_controle_id', '=', $this->id));
        return DocsFiscal::getObjects( $criteria );
    }
    /**
     * Method getParametrosAcbrs
     */
    public function getParametrosAcbrs()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('unid_controle_id', '=', $this->id));
        return ParametrosAcbr::getObjects( $criteria );
    }

    
}

