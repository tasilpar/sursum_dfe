<?php


use Adianti\Database\TCriteria;
use Adianti\Database\TFilter;

class AcbrArquivo implements Iacbr
{
    private  $idTrans = 0;
    private $nomeArquivo = '';
    private $nomeArquivoRet = '';
    private $arquivo;
    public function __construct()
    {

        $this->arquivo = new Arquivo();
    }

    public function setCmd($comando)
    {

        $dirEntrada             = $this->getDirEntrada();
        $this->nomeArquivo      = Helpers::juntarDirArq($dirEntrada,$this->idTrans.".txt");
        echo "nome arquivo: {$this->nomeArquivo} <br>";
        $this->arquivo->setNomeArquivo($this->nomeArquivo)
        ->setConteudoArquivo($comando)
        ->criar();
    }

    private function getDirEntrada()
    {
        return ParametrosAcbrService::getVlParamAcbr('dir_acbr_entrada','c:\acbr\entrada');

    }

    private function getDirSaida()
    {
        return ParametrosAcbrService::getVlParamAcbr('dir_acbr_saida','c:\acbr\saida');
    }

    public function getRetCmd()
    {
        $dirSaida   = $this->getDirSaida();
        $this->nomeArquivoRet = Helpers::juntarDirArq($dirSaida,$this->idTrans.".txt");
        echo "nome arquivo ret: $this->nomeArquivoRet <br>";
        $lAchou = 0;


        while($lAchou == false){
            if(file_exists($this->nomeArquivoRet)){
                $conteudo = $this->arquivo->setNomeArquivo($this->nomeArquivoRet)
                ->getConteudoArquivo();
                $lAchou = true;
            }
        }
        return $conteudo;
        // TODO: Implement getCmd() method.
    }

    public function getArqsCmd()
    {
        // TODO: Implement getTrans() method.
    }

    public function setTransId($idTrans)
    {
        $this->idTrans = $idTrans;
    }
}