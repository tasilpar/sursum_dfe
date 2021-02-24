<?php

class Arquivos extends TRecord
{
    const TABLENAME  = 'arquivos';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $transacao;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome');
        parent::addAttribute('num_tipo_arquivo');
        parent::addAttribute('tamanho');
        parent::addAttribute('dt_hr_criacao');
        parent::addAttribute('dt_hr_exclusao');
        parent::addAttribute('transacao_id');
        parent::addAttribute('uid_arquivo');
        parent::addAttribute('chave_origem');
            
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
     * Method getDocsFiscals
     */
    public function getDocsFiscals()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('arquivo_id', '=', $this->id));
        return DocsFiscal::getObjects( $criteria );
    }

    
}

