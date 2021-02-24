<?php

class Eventos extends TRecord
{
    const TABLENAME  = 'eventos';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $grupo;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('cod_evento');
        parent::addAttribute('nome');
        parent::addAttribute('grupo_id');
            
    }

    /**
     * Method set_grupos_evento
     * Sample of usage: $var->grupos_evento = $object;
     * @param $object Instance of GruposEvento
     */
    public function set_grupo(GruposEvento $object)
    {
        $this->grupo = $object;
        $this->grupo_id = $object->id;
    }

    /**
     * Method get_grupo
     * Sample of usage: $var->grupo->attribute;
     * @returns GruposEvento instance
     */
    public function get_grupo()
    {
    
        // loads the associated object
        if (empty($this->grupo))
            $this->grupo = new GruposEvento($this->grupo_id);
    
        // returns the associated object
        return $this->grupo;
    }

    
}

