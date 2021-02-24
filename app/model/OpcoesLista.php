<?php

class OpcoesLista extends TRecord
{
    const TABLENAME  = 'opcoes_lista';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $lista;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('cod_opcao');
        parent::addAttribute('desc_opcao');
        parent::addAttribute('lista_id');
            
    }

    /**
     * Method set_listas
     * Sample of usage: $var->listas = $object;
     * @param $object Instance of Listas
     */
    public function set_lista(Listas $object)
    {
        $this->lista = $object;
        $this->lista_id = $object->id;
    }

    /**
     * Method get_lista
     * Sample of usage: $var->lista->attribute;
     * @returns Listas instance
     */
    public function get_lista()
    {
    
        // loads the associated object
        if (empty($this->lista))
            $this->lista = new Listas($this->lista_id);
    
        // returns the associated object
        return $this->lista;
    }

    
}

