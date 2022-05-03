<?php
require_once "conexao.php";

//Classe Produto

class Produto{
    //Atributos
    public $codigo;
    public $nome;
    public $descricao;
    public $preco;

    //Construtor
    function __construct($codigo,$nome,$descricao,$preco){
      $this->codigo = $codigo;
      $this->nome = $nome;
      $this->descricao = $descricao;
      $this->preco = $preco;
    }
    function get_codigo(){
      return $this->codigo;
    }
    function get_nome(){
      return $this->nome;
    }
    function get_descricao(){
      return $this->descricao;
    }
    function get_preco(){
      return $this->preco;
    }

}

?>