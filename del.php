<?php
require_once "Produto.class.php";

if(isset($_REQUEST['codigo'])){
    $codigo = $_REQUEST['codigo'];
    $sql = "DELETE FROM produto WHERE codigo=".$codigo;
    $conn->exec($sql);
    header('Location:index.php');	
}
?>