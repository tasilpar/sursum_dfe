<?php

class Cmds extends TRecord
{
    const TABLENAME  = 'cmds';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $transacao;
    private $tipo_comando;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('transacao_id');
        parent::addAttribute('tipo_comando_id');
        parent::addAttribute('dt_hr_comando');
        parent::addAttribute('comando');
        parent::addAttribute('dt_hr_retorno');
        parent::addAttribute('retorno');
        parent::addAttribute('num_metodo_comunicacao');
        parent::addAttribute('log_erro');
        parent::addAttribute('num_situacao');
            
    }

    /**
     * Method set_transacoes
     * Sample of usage: $var->transacoes = $object;
     * @param $object Instance of Transacoes
     */
    public function set_transacao(Transacoes $object)
    {
        $this->transacao = $object;
        $this->transacao_id = $object->id;
    }

    /**
     * Method get_transacao
     * Sample of usage: $var->transacao->attribute;
     * @returns Transacoes instance
     */
    public function get_transacao()
    {
    
        // loads the associated object
        if (empty($this->transacao))
            $this->transacao = new Transacoes($this->transacao_id);
    
        // returns the associated object
        return $this->transacao;
    }
    /**
     * Method set_tipos_comando
     * Sample of usage: $var->tipos_comando = $object;
     * @param $object Instance of TiposComando
     */
    public function set_tipo_comando(TiposComando $object)
    {
        $this->tipo_comando = $object;
        $this->tipo_comando_id = $object->id;
    }

    /**
     * Method get_tipo_comando
     * Sample of usage: $var->tipo_comando->attribute;
     * @returns TiposComando instance
     */
    public function get_tipo_comando()
    {
    
        // loads the associated object
        if (empty($this->tipo_comando))
            $this->tipo_comando = new TiposComando($this->tipo_comando_id);
    
        // returns the associated object
        return $this->tipo_comando;
    }

    
}

