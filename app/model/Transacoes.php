<?php

use Adianti\Database\TRecord;

class Transacoes extends TRecord
{
    const TABLENAME  = 'transacoes';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $origem;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('dt_hr_ini');
        parent::addAttribute('usuario_id');
        parent::addAttribute('origem_id');
        parent::addAttribute('dt_hr_fim');
        parent::addAttribute('cod_programa');
            
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

    /**
     * Method getArquivoss
     */
    public function getArquivoss()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('transacao_id', '=', $this->id));
        return Arquivos::getObjects( $criteria );
    }
    /**
     * Method getDocsFiscals
     */
    public function getDocsFiscals()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('transacao_id', '=', $this->id));
        return DocsFiscal::getObjects( $criteria );
    }
    /**
     * Method getMovtosEventoDocFiscals
     */
    public function getMovtosEventoDocFiscals()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('transacao_id', '=', $this->id));
        return MovtosEventoDocFiscal::getObjects( $criteria );
    }
    /**
     * Method getCmdss
     */
    public function getCmdss()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('transacao_id', '=', $this->id));
        return Cmds::getObjects( $criteria );
    }

    
}

