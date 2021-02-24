<?php

use Adianti\Database\TCriteria;
use Adianti\Database\TFilter;
use Adianti\Database\TRecord;

class ParametrosAcbr extends TRecord
{
    const TABLENAME  = 'parametros_acbr';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $uncontrole;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('cod_parametro');
        parent::addAttribute('val_parametro');
        parent::addAttribute('unid_controle_id');
            
    }

    /**
     * Method set_system_unit
     * Sample of usage: $var->system_unit = $object;
     * @param $object Instance of SystemUnit
     */
    public function set_uncontrole(SystemUnit $object)
    {
        $this->uncontrole = $object;
        $this->unid_controle_id = $object->id;
    }

    /**
     * Method get_uncontrole
     * Sample of usage: $var->uncontrole->attribute;
     * @returns SystemUnit instance
     */
    public function get_uncontrole()
    {
    
        // loads the associated object
        if (empty($this->uncontrole))
            $this->uncontrole = new SystemUnit($this->unid_controle_id);
    
        // returns the associated object
        return $this->uncontrole;
    }

    
}

