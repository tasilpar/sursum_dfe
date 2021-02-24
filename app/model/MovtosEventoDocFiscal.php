<?php

class MovtosEventoDocFiscal extends TRecord
{
    const TABLENAME  = 'movtos_evento_doc_fiscal';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $doc_fiscal;
    private $transacao;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('cod_protocolo');
        parent::addAttribute('doc_fiscal_id');
        parent::addAttribute('dt_hr_envio');
        parent::addAttribute('descr_envio');
        parent::addAttribute('cod_retorno');
        parent::addAttribute('descr_retorno');
        parent::addAttribute('transacao_id');
        parent::addAttribute('dt_hr_retorno');
            
    }

    /**
     * Method set_docs_fiscal
     * Sample of usage: $var->docs_fiscal = $object;
     * @param $object Instance of DocsFiscal
     */
    public function set_doc_fiscal(DocsFiscal $object)
    {
        $this->doc_fiscal = $object;
        $this->doc_fiscal_id = $object->id;
    }

    /**
     * Method get_doc_fiscal
     * Sample of usage: $var->doc_fiscal->attribute;
     * @returns DocsFiscal instance
     */
    public function get_doc_fiscal()
    {
    
        // loads the associated object
        if (empty($this->doc_fiscal))
            $this->doc_fiscal = new DocsFiscal($this->doc_fiscal_id);
    
        // returns the associated object
        return $this->doc_fiscal;
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

    
}

