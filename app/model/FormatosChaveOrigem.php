<?php

class FormatosChaveOrigem extends TRecord
{
    const TABLENAME  = 'formatos_chave_origem';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $origem;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('origem_id');
        parent::addAttribute('posicao');
        parent::addAttribute('nome');
            
    }

    /**
     * Method set_origens
     * Sample of usage: $var->origens = $object;
     * @param $object Instance of Origens
     */
    public function set_origem(Origens $object)
    {
        $this->origem = $object;
        $this->origem_id = $object->id;
    }

    /**
     * Method get_origem
     * Sample of usage: $var->origem->attribute;
     * @returns Origens instance
     */
    public function get_origem()
    {
    
        // loads the associated object
        if (empty($this->origem))
            $this->origem = new Origens($this->origem_id);
    
        // returns the associated object
        return $this->origem;
    }

    
}

