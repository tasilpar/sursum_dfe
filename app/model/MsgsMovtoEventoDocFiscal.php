<?php

class MsgsMovtoEventoDocFiscal extends TRecord
{
    const TABLENAME  = 'msgs_movto_evento_doc_fiscal';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('movto_evento_docto_fiscal_id');
        parent::addAttribute('cod_mensagem');
        parent::addAttribute('descr_mensagem');
        parent::addAttribute('dt_hr_consulta');
        parent::addAttribute('dt_hr_retorno');
            
    }

    
}

