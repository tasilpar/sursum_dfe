<?php


class Arquivo
{
    protected $nomeArquivo = '';
    protected $conteudoArquivo = '';


    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function getNomeArquivo(): string
    {
        return $this->nomeArquivo;
    }

    /**
     * @param string $nomeArquivo
     */
    public function setNomeArquivo(string $nomeArquivo): Arquivo
    {
        $this->nomeArquivo = $nomeArquivo;
        return $this;
    }

    /**
     * @param string $conteudoArquivo
     */
    public function setConteudoArquivo(string $conteudoArquivo): Arquivo
    {
        $this->conteudoArquivo = $conteudoArquivo;
        return $this;
    }

    public function criar():string
    {
        //criamos o arquivo
        $arquivo = fopen($this->nomeArquivo,'w');
        //verificamos se foi criado
        if ($arquivo == false){
            $erro ='Não foi possível criar o arquivo.';
        } else{
            $erro = '';
        }
        //escrevemos no arquivo
        fwrite($arquivo, $this->conteudoArquivo);
        //Fechamos o arquivo após escrever nele
        fclose($arquivo);
        return $erro;

    }
    public function getConteudoArquivo():string
    {
        $retorno = '';
        // Abre o Arquvio no Modo r (para leitura)
        $arquivo = fopen ($this->nomeArquivo, 'r');
        // Lê o conteúdo do arquivo
        while(!feof($arquivo)){
        //Mostra uma linha do arquivo
            $retorno .= fgets($arquivo, 1024)."<br>";
        }
        // Fecha arquivo aberto
        fclose($arquivo);
        return $retorno;
    }
}