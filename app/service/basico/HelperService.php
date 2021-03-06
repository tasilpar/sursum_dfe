<?php

class HelperService
{
   public static function retornarOpcoesTxt($campo)
    {
        $aCampo = explode(',',$campo);
        $retorno = '';
        for($i = 0;$i < count($aCampo);$i++ )
        {
            if($retorno =='' )
                $retorno = "'".$aCampo[$i]."'";
            else
                $retorno .= ",'".$aCampo[$i]."'";

        }
        return $retorno;



    }
    public static function converterDecimal($valor)
    {
        $valor = str_replace(".","",$valor);
        $valor = str_replace(",",".",$valor);
        return $valor;

    }

    public static function utilIncrValor($variavel,$incremento,$delimitador = ',',$logDesconsideraBranco=false)
    {
        $retorno = $variavel;
        $logIncrementar = false;
        if($logDesconsideraBranco == true){
            if($incremento <> '' ){
                $logIncrementar = true;
            }
        }else{
            $logIncrementar = true;
        }
        if($logIncrementar == true){
            if($variavel == ''){
                $retorno = $incremento;
            }
            else{
                $retorno .= $delimitador.$incremento;
            }
        }

        return $retorno;
    }

    public static function dataAtual()
    {
        $dia= date('d');
        $mes= date('m');
        $ano= date('Y');
        $completa = "$dia/$mes/$ano";
        $completaUs = "{$ano}-{$mes}-{$dia}";
        return array('dia' => $dia, 'mes' => $mes, 'ano' => $ano, 'completa' => $completa,
            'completa_us'=> $completaUs);
    }

    public static function intervaloData($dtHrIni,$dtHrFim,$tipoRetorno = '')
    {
        $retorno = 0;
        $oDataIni = new DateTime($dtHrIni);
        $oDataFim = new DateTime($dtHrFim);
        //var_dump($oDataIni);
        //var_dump($oDataFim);

        $oDif     	= $oDataIni->diff($oDataFim);
        $anoDif		= $oDif->format("%Y");
        $mesDif		= $oDif->format("%M");
        $diaDif		= $oDif->format("%D");
        $horaDif	= $oDif->format("%H");
        $minutoDif	= $oDif->format("%I");
        $segundoDif	= $oDif->format("%S");

        $aRetorno = array('ano' => $anoDif, 'mes' => $mesDif, 'dia' => $diaDif,
            'hora' => $horaDif , 'minuto' => $minutoDif, 'segundo' => $segundoDif	);
        switch($tipoRetorno){
            case 'dia':
                $retorno = $oDif->days;
                break;
            case 'hora':
                $retorno = ($oDif->days * 24) + $horaDif + ($minutoDif / 60);
                break;
            case 'minuto':
                $retorno = ($oDif->days * 24 * 60) + ($horaDif * 60) + $minutoDif;
                break;
            default:
                $retorno = $aRetorno;
        }


        return $retorno;
    }

    /*function tratarHoraProtheus($horario)
    {
        $retorno = '';
        $hora = '';
        $minut = '';
        if(trim(($horario)) <> ''  ){
            $aHora = explode(":",$horario);
            $hora = intval($aHora[0]);
            $minut = intval($aHora[1]);
            if($hora < 10){
                $hora = "0".$hora;
            }
            if($minut < 10){
                $minut = "0".$minut;
            }
        }

        //echo "hora ini:$horaIni e minut ini:$minutIni<br>";
        $retorno = $hora.":".$minut;
        return $retorno;

    }*/
    public static function preencherZerosAEsquerda($num,$tamanho=0)
    {
        $tamanhoNumero = strlen($num);

        $qtRepeticoes = $tamanho - $tamanhoNumero;
        if($qtRepeticoes < 0){
            $qtRepeticoes = 0;
        }
        $zeros = str_repeat('0',$qtRepeticoes);
        $numero = $zeros.$num;
        return $numero;

    }
    function retirarAcento($palavra)
    {

        //return preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//IGNORE', $palavra ) );
        return $palavra;
    }

    public static function retirarAcentoSimples($texto)
    {
        return preg_replace(
            array("/(á|à|ã|â|ä)/",
                "/(Á|À|Ã|Â|Ä)/",
                "/(é|è|ê|ë)/",
                "/(É|È|Ê|Ë)/",
                "/(í|ì|î|ï)/",
                "/(Í|Ì|Î|Ï)/",
                "/(ó|ò|õ|ô|ö)/",
                "/(Ó|Ò|Õ|Ô|Ö)/",
                "/(ú|ù|û|ü)/",
                "/(Ú|Ù|Û|Ü)/",
                "/(ñ)/",
                "/(Ñ)/",
                "/(ç)/",
                "/(Ç)/"),
            explode(" ","a A e E i I o O u U n N c C"),$texto
        );

    }



    public static function formatarNumero($numero,$qtDecimais=2)
    {
        $numero = number_format($numero,$qtDecimais,',','.');
        return $numero;
    }
    function tratarNumero($num)
    {
        if(trim($num) == ''){
            $num = 0;
        }
        return $num;

    }


    public static function formatarPreco($moeda,$vl)
    {
        $valor  = round($vl,2);
        if(strstr($valor,'.') ==false){
            $valor = "$valor.00";
        }
        if($moeda =='real' or $moeda == '1'){
            $sinal = "R$";
        }else{
            $sinal = "US$";
        }
        if($valor  <> '' and $valor <> 0){

            $valor = number_format($valor,2,',','.');
        }
        /* $aValor = explode('.',$valor);
         if( strlen($aValor[1]) == 1 ){
             $aValor[1] .= '0';
         }
         $valor = $aValor[0].",".$aValor[1];
     }else{
         $valor = "0,00";
     }*/

        $valor = "$sinal $valor";

        if($vl == 0){
            $valor = '';
        }
        return $valor;

    }

    public static function desformatarValor($valor)
    {
        $valor = str_replace("R$",'',$valor);
        $valor = str_replace("US$",'',$valor);
        $valor = str_replace(".",'',$valor);
        $valor = str_replace(",",'.',$valor);
        return $valor;

    }
    public static function validaCNPJ($cnpj = null)
    {

        // Verifica se um número foi informado
        if(empty($cnpj)) {
            return false;
        }

        // Elimina possivel mascara
        $cnpj = preg_replace("/[^0-9]/", "", $cnpj);
        $cnpj = str_pad($cnpj, 14, '0', STR_PAD_LEFT);

        // Verifica se o numero de digitos informados é igual a 11
        if (strlen($cnpj) != 14) {
            return false;
        }

        // Verifica se nenhuma das sequências invalidas abaixo
        // foi digitada. Caso afirmativo, retorna falso
        else if ($cnpj == '00000000000000' ||
            $cnpj == '11111111111111' ||
            $cnpj == '22222222222222' ||
            $cnpj == '33333333333333' ||
            $cnpj == '44444444444444' ||
            $cnpj == '55555555555555' ||
            $cnpj == '66666666666666' ||
            $cnpj == '77777777777777' ||
            $cnpj == '88888888888888' ||
            $cnpj == '99999999999999') {
            return false;

            // Calcula os digitos verificadores para verificar se o
            // CPF é válido
        } else {

            $j = 5;
            $k = 6;
            $soma1 = "";
            $soma2 = "";

            for ($i = 0; $i < 13; $i++) {

                $j = $j == 1 ? 9 : $j;
                $k = $k == 1 ? 9 : $k;

                $soma2 += ($cnpj{$i} * $k);

                if ($i < 12) {
                    $soma1 += ($cnpj{$i} * $j);
                }

                $k--;
                $j--;

            }

            $digito1 = $soma1 % 11 < 2 ? 0 : 11 - $soma1 % 11;
            $digito2 = $soma2 % 11 < 2 ? 0 : 11 - $soma2 % 11;

            return (($cnpj{12} == $digito1) and ($cnpj{13} == $digito2));

        }
    }
    public static function mascara($val, $mask)
    {

        $maskared = '';

        $k = 0;

        for($i = 0; $i<=strlen($mask)-1; $i++) {
            if($mask[$i] == '#') {

                if(isset($val[$k])) $maskared .= $val[$k++];
            }
            else{
                if(isset($mask[$i]))  $maskared .= $mask[$i];

            }
        }
        return $maskared;

    }


    public static function tratarAspasSimples($texto)
    {
        $texto = str_replace("'","''",$texto);
        return $texto;

    }
    public static function convArrayParaLista($array,$logEntreAspas=false)
    {
        $lista = '';
        $tot = count($array);
        for($i=0;$i<$tot;$i++){
            if($logEntreAspas == true){
                $incr = "'{$array[$i]}'";
            }else{
                $incr = $array[$i];
            }
            $lista = self::utilIncrValor($lista,$incr,",",true);
        }
        return $lista;
    }

    public static function getQtLista($lista,$separador=',')
    {
        $qt = 0;
        if($lista <> ''){
            $aLista = explode($separador,$lista);
            if(is_array($aLista)){
                $qt = count($aLista);
            }
        }

        return $qt;
    }

    public static function unique_multidim_array($array, $key) {

        //var_dump($array);
        $temp_array = array();
        $i = 0;
        $key_array = array();
        if(is_array($array)){
            foreach($array as $val) {
                if (!in_array($val[$key], $key_array)) {
                    $key_array[$i] = $val[$key];
                    $temp_array[$i] = $val;
                }
                $i++;
            }
        }


        return $temp_array;
    }


    public static function setVarSessao($variavel,$valor)
    {
        $_SESSION[$variavel] = $valor;
    }

    public static function getVarSessao($variavel)
    {
        if(isset($_SESSION[$variavel])){
            $retorno =  $_SESSION[$variavel];
        }else{
            $retorno = '';
        }
        return $retorno;
    }

    public static function limparVarSessao($variavel)
    {
        if($variavel <> ''){
            $aVar = explode(',',$variavel);
            foreach ($aVar as $var) {
                unset($_SESSION[$var]);
            }
        }

    }
    public static function getNumEmLista($lista,$numero)
    {
        $lAchou = false;
        if($lista <> ''){
            $aLista = explode(',',$lista);
        }
        foreach ($aLista as $numLista){
            if($numLista == $numero){
                $lAchou = true;
                break;
            }
        }
        return $lAchou;
    }
    public static function convArrayEmMsg($aMsg,$tagHeader='h1')
    {
        $msg = '';
        if(is_array($aMsg)){
            $tam = count($aMsg);
            for($i=0;$i<$tam;$i++){
                $incr = $aMsg[$i];
                if($tagHeader <> ''){
                    $tagHeaderIni = "<$tagHeader>";
                    $tagHeaderFim = "</$tagHeader>";

                }
                $msg = self::utilIncrValor($msg,"{$tagHeaderIni}{$incr}{$tagHeaderFim}");
            }
        }
        return $msg;
    }

    public static function juntarDirArq($dir,$arquivo){

        $separador = self::getSeparadorArquivo($dir);
        $arquivo = join($separador,array($dir,$arquivo));
        return $arquivo;
    }

    public static function getSeparadorArquivo($arquivo)
    {
        if(strstr($arquivo,'/') <> false){
            $separador ='/';
        }else{
            $separador = '\\';
        }
        return $separador;

    }
}
