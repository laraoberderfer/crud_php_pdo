<?php
require_once "conexao.php";
if(!isset($_REQUEST['codigo'])){
  //adicionando produto
  $nome = "";
  $descricao = "";
  $preco = "";
  $codigo = "";
  $titulo = "Adicionando Produto";
} else {
  //editando produto
  $titulo = "Editando Produto";
  $codigo = $_REQUEST['codigo'];
  $stmt = $conn->prepare("SELECT * FROM produto WHERE codigo=$codigo");
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_OBJ);
  $nome = $row->nome;
  $descricao = $row->descricao;
  $preco = $row->preco;
}
?>
<html>
<head>
  <title>Oficina dos doces</title>   
  <!-- Latest compiled and minified CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Latest compiled JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>   
</head>
<body>
  <h1><?php echo $titulo; ?></h1>
  <form action="add1.php" method="post">
  <div class="mb-3 mt-3">
    <label for="nome" class="form-label">Nome:</label>
    <input type="nome" class="form-control" id="nome" name="nome" value="<?php echo $nome; ?>">
  </div>
  <div class="mb-3 mt-3">
    <label for="descricao" class="form-label">Descrição:</label>
    <input type="descricao" class="form-control" id="descricao" value="<?php echo $descricao; ?>" name="descricao">
  </div>
  <div class="mb-3 mt-3">
    <label for="preco" class="form-label">Preço:</label>
    <input type="preco" class="form-control" id="preco"  value="<?php echo $preco; ?>" name="preco">
  </div>
  <button type="submit" class="btn btn-primary">Adicionar</button>
  <input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
  </form>
</body>
</html>