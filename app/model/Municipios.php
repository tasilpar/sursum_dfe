<?php

class Municipios extends TRecord
{
    const TABLENAME  = 'municipios';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'max'; // {max, serial}

    private $estado;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome');
        parent::addAttribute('estado_id');
            
    }

    /**
     * Method set_estados
     * Sample of usage: $var->estados = $object;
     * @param $object Instance of Estados
     */
    public function set_estado(Estados $object)
    {
        $this->estado = $object;
        $this->estado_id = $object->id;
    }

    /**
     * Method get_estado
     * Sample of usage: $var->estado->attribute;
     * @returns Estados instance
     */
    public function get_estado()
    {
    
        // loads the associated object
        if (empty($this->estado))
            $this->estado = new Estados($this->estado_id);
    
        // returns the associated object
        return $this->estado;
    }

    
}

