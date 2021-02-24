<?php

use Adianti\Control\TPage;
use Adianti\Database\TCriteria;
use Adianti\Database\TFilter;
use Adianti\Database\TTransaction;
/*use Monolog\Logger;
use Monolog\Handler\StreamHandler;*/

class TesteController extends TPage
{
    public function __construct($param)
    {

        TTransaction::open('sursum_dfe');
        $transacaoId = TransacaoService::criar();

        $objIntegracao = ParametrosAcbrService::getObjIntegracao();
        $acbr = new Acbr($objIntegracao);
        $acbr->setTransId($transacaoId);
        $acbr->setCmd('IBGE.BuscarPorCodigo("3554003")');

        $ret = $acbr->getRetCmd();
        TransacaoService::encerrar($transacaoId);
        //var_dump($ret);
        TTransaction::close();
        /*parent::__construct();
         TTransaction::open('sursum_dfe');
        $oTrans = ParametrosAcbr::last();
        
        $resultado = '';
        echo "<h1>oi</h1>";
        var_dump($oTrans);
        echo "<h1>oi2</h1>";
        $aTrans =  $oTrans->toArray();
        var_dump($aTrans);
        
        
        $criterio =  new TCriteria();
        $criterio->add(new TFilter('cod_parametro','=','dir_acbr_entrada'));
        $aParam = ParametrosAcbr::getIndexedArray('id','val_parametro',$criterio);
         echo "<h1>oi3</h1>";
        var_dump($aParam);
         echo "<h1>oi4</h1>";
        echo 'valor:'.$aParam[1];
        
        TTransaction::close();


// create a log channel
        $log = new Logger('name');
        $log->pushHandler(new StreamHandler('c:/temp/your.log', Logger::WARNING));

// add records to the log
        $log->warning('Foo');
        $log->error('Bar');
        $subst = ['valor'=>$resultado];
        $template = new THtmlRenderer('app/resources/teste.html');
        $template->enableSection('main',$subst);
        parent::add($template);*/
    }
    
/*    // função executa ao clicar no item de menu
    public function onShow($param = null)
    {
        
    }*/
}




    