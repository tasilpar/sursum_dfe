<?php

class DocsFiscal extends TRecord
{
    const TABLENAME  = 'docs_fiscal';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'max'; // {max, serial}

    private $uncontrole;
    private $pessoa;
    private $transacao;
    private $arquivo;
    private $emissor;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('emissor_id');
        parent::addAttribute('dt_hr_emissao');
        parent::addAttribute('dt_hr_saida');
        parent::addAttribute('unid_controle_id');
        parent::addAttribute('pessoa_id');
        parent::addAttribute('nr_docto');
        parent::addAttribute('serie_docto');
        parent::addAttribute('num_modelo_docto');
        parent::addAttribute('vl_docto');
        parent::addAttribute('transacao_id');
        parent::addAttribute('cod_versao_nfe');
        parent::addAttribute('num_protocolo');
        parent::addAttribute('cod_versao_apl');
        parent::addAttribute('dt_hr_recbto_protocolo');
        parent::addAttribute('arquivo_id');
        parent::addAttribute('num_tipo_ambiente');
        parent::addAttribute('chave_acesso');
            
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
    /**
     * Method set_pessoas
     * Sample of usage: $var->pessoas = $object;
     * @param $object Instance of Pessoas
     */
    public function set_pessoa(Pessoas $object)
    {
        $this->pessoa = $object;
        $this->pessoa_id = $object->id;
    }

    /**
     * Method get_pessoa
     * Sample of usage: $var->pessoa->attribute;
     * @returns Pessoas instance
     */
    public function get_pessoa()
    {
    
        // loads the associated object
        if (empty($this->pessoa))
            $this->pessoa = new Pessoas($this->pessoa_id);
    
        // returns the associated object
        return $this->pessoa;
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
     * Method set_arquivos
     * Sample of usage: $var->arquivos = $object;
     * @param $object Instance of Arquivos
     */
    public function set_arquivo(Arquivos $object)
    {
        $this->arquivo = $object;
        $this->arquivo_id = $object->id;
    }

    /**
     * Method get_arquivo
     * Sample of usage: $var->arquivo->attribute;
     * @returns Arquivos instance
     */
    public function get_arquivo()
    {
    
        // loads the associated object
        if (empty($this->arquivo))
            $this->arquivo = new Arquivos($this->arquivo_id);
    
        // returns the associated object
        return $this->arquivo;
    }
    /**
     * Method set_emissores
     * Sample of usage: $var->emissores = $object;
     * @param $object Instance of Emissores
     */
    public function set_emissor(Emissores $object)
    {
        $this->emissor = $object;
        $this->emissor_id = $object->id;
    }

    /**
     * Method get_emissor
     * Sample of usage: $var->emissor->attribute;
     * @returns Emissores instance
     */
    public function get_emissor()
    {
    
        // loads the associated object
        if (empty($this->emissor))
            $this->emissor = new Emissores($this->emissor_id);
    
        // returns the associated object
        return $this->emissor;
    }

    /**
     * Method getMovtosEventoDocFiscals
     */
    public function getMovtosEventoDocFiscals()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('doc_fiscal_id', '=', $this->id));
        return MovtosEventoDocFiscal::getObjects( $criteria );
    }

    
}

