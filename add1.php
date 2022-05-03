<?php
require_once "Produto.class.php";

//Adiciona novo produto
if(!isset($_REQUEST['codigo']) || $_REQUEST['codigo']==""){ //! = NOT
    $nome = $_REQUEST['nome'];
    $descricao = $_REQUEST['descricao'];
    $preco = $_REQUEST['preco'];
    $sql = "INSERT INTO produto (nome, descricao, preco) VALUES ('$nome', '$descricao', '$preco')";
    $conn->exec($sql);
    header('Location:index.php');	
} else {
   // editar o produto
   $codigo = $_REQUEST['codigo'];
   $nome = $_REQUEST['nome'];
   $descricao = $_REQUEST['descricao'];
   $preco = $_REQUEST['preco'];
   $sql = "UPDATE produto SET nome='$nome', descricao='$descricao', preco='$preco' WHERE codigo=$codigo";
   //print($sql);
   $stmt =  $conn->prepare($sql);
   //$stmt->bindParam(1,$nome);
   //$stmt->bindParam(2,$descricao);
  // $stmt->bindParam(3,$preco);
  //$stmt->bindParam(4,$codigo);    
   $stmt->execute();
   header('Location:index.php');
}

?>