<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" sizes="196x196" href="img/favicon.png">
  <title>Exemplo</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

</head>
<body class="bg-light">

<?php include("menu.php");?>

<div class="container" align=center>

  <br>
	<h5>Incluir relacionamento com:</h5>
    <form action="relac_add_action.php" method="post">
    <div class="form-group">
		

    

    <?php
    include("../banco_dados_conexao.php");
    try {
      
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
      $sth = $dbh->prepare("select * from livro where id not in (SELECT id_livro FROM livro_autor where id_autor = ".$_SESSION["id"].")");
      $sth->execute();
      $result = $sth->fetchAll(PDO::FETCH_ASSOC);
      
      if (empty($result)) {
        echo "Não há itens para vincular com esse registro.";
        echo "<br>";
        echo "<a href='visualizar.php' class='btn btn-secondary'>voltar</a>";
      } else {
        echo "<select class='form-select' id='id' name='id'>";
        foreach($result as $row) {
          echo "<option value='".$row["id"]."'>";
          echo $row["nome"];
          echo "</option>";
        }
        echo "</select>";
        echo "<br>";
        echo "<button type='submit' class='btn btn-primary'>Incluir</button>";
        echo "&nbsp;";
        echo "<a href='visualizar.php' class='btn btn-secondary'>voltar</a>";
      }
      $dbh = null;
    } catch (PDOException $e) {
      print "Error!: " . $e->getMessage() . "<br/><br><a href='index.php'>voltar</a>";
      die();
    }
    ?>

    

    </div>
   
  </form>

</div>

</body>
</html>
