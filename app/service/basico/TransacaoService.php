<?php

use Adianti\Database\TTransaction;
use Adianti\Registry\TSession;

class TransacaoService
{
    public static function getUltId()
    {

        $idUltTrans = 0;
        $oTrans = Transacoes::last();
        if(is_object($oTrans)){
            $aTrans = $oTrans->toArray();
            $idUltTrans = $aTrans['id'];
        }

        return $idUltTrans;
        
    }
    public static function criar()
    {
        try {
            $transacao = new Transacoes();
            $transacao->dt_hr_ini = Helpers::dataHoraCorrenteUs();
            $idUsuarioCorrente = TSession::getValue('userid');
            $transacao->usuario_id = $idUsuarioCorrente ;
            $transacao->origem_id = 1;
            $transacao->cod_programa = $_SERVER["REQUEST_URI"];
            $transacao->store();
            //$id = self::getUltId();
            $id = $transacao->id;
            return $id;
        }catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
            return false;
        }
    }
    public static function encerrar($id)
    {
        try {
            $transacao = new Transacoes();
            $transacao->id = $id;
            $transacao->dt_hr_fim = Helpers::dataHoraCorrenteUs();
            $transacao->store();
            return true;
        }catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
            return false;
        }

    }
}
