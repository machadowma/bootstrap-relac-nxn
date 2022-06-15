<!DOCTYPE html>
<html lang="en">
<head>
  <title>Exemplo</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">




  
</head>
<body class="bg-light">

<?php include("menu.php"); ?>

<div class="container">


 
<h1>Relatório</h1>


      
	<?php
	
	include("banco_dados_conexao.php");
	
	try {
	
		
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sth = $dbh->prepare('SELECT l.nome as livro, a.nome as autor from livro l left join livro_autor la on la.id_livro = l.id left join autor a on a.id = la.id_autor ORDER BY l.nome, a.nome');
		$sth->execute();
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		if(!empty($result)) {
		
			// escrevendo cabeçalho
			echo '<div class="table-responsive"> ';
			echo '<table class="table">';
			echo "<thead>";
			echo "<tr>";
			echo "<th>Livro</th>";
			echo "<th>Autor</th>";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";

			// escrevendo resultado do SELECT
			$livro = "";
			foreach($result as $row) {
				if($livro == ""){ // Primeira vez
					$livro=$row["livro"];
					echo "<tr>";
					echo "<td>".$row["livro"]."</td>";
					echo "<td>".$row["autor"];
				} else if($livro!=$row["livro"]){ // Não é a primeira vez, mas é um novo livro
					$livro=$row["livro"];
					echo "</td></tr>";
					echo "<tr>";
					echo "<td>".$row["livro"]."</td>";
					echo "<td>".$row["autor"];
				} else { // Não é a primeira vez, mas é um novo autor do mesmo livro
					echo ", ".$row["autor"];
				}
			}
			
			

			echo '</tbody>';
			echo '</table>';
			echo '</div>';

		}

		$dbh = null;
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/><br><a href='index.php'>voltar</a>";
		die();
	}

	
	?>
</div> 


</body>
</html>


