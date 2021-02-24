<?php

use Adianti\Database\TCriteria;
use Adianti\Database\TFilter;

class ParametrosAcbrService
{
    
    public static function getVlParamAcbr($codParam,$vlPadrao='')
    {
        $vlParam = $vlPadrao;
        $criterio =  new TCriteria();
        $criterio->add(new TFilter('cod_parametro','=',$codParam));
        $aParam = ParametrosAcbr::getIndexedArray('id','val_paramametro',$criterio);
        var_dump($aParam);
        if(isset($aParam['val_parametro'])){
            $vlParam = $aParam['val_parametro'];
        }
        return $vlParam;
        
    }
    public static function getFormaIntegracao()
    {
        $vlPadrao = 'arquivo';
        $vlParam = self::getVlParamAcbr('forma_integracao',$vlPadrao);
        return $vlParam;

    }
    public static function getObjIntegracao()
    {
        $formaIntegracao =  ParametrosAcbrService::getFormaIntegracao();
        //echo "forma integração: $formaIntegracao";

        switch ($formaIntegracao){
            case 'arquivo':
                $obj = new AcbrArquivo();
                break;
            case 'tcp':
                $obj = new AcbrTcp();
                break;
            case 'lib':
                $obj = new AcbrLib();
                break;
            default:
                $obj = new stdClass();
        }
        return $obj;

    }

}
