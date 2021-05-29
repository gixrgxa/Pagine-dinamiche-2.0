<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <title>Smart Airport</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/jumbotron/">
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="jumbotron.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-primary text-white">
      <a class="navbar-brand" href="https://smartairport.altervista.org/index.html">Smart Airport</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="signup.php">Registrazione</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main">
      <div class="jumbotron">
        <div class="container">

		<?php
		//Creazione oggetto mysqli per realizzare la connessione
		$con = new mysqli("localhost","root","","my_smartairport");
		if (mysqli_connect_errno()) {
		   echo("Connessione non effettuata: ".mysqli_connect_error()."<BR>");
		   exit();
		}

		if (isset($_POST['username'])){
		//sql
		$username=$_POST['username'];
		$password=$_POST['password'];
		$username=mysqli_real_escape_string($con , $username);
		$password=mysqli_real_escape_string($con , $password);
		$sql='Select * from REGISTRAZIONE WHERE username="'.$username.'"';
		$risUser = $con->query($sql) or die ("Query fallita!");
        var_dump($username, $password);

        //se username e password sono giuste fa tutte le istruzioni dentro le parentesi
        if($risUser){
          $array=mysql_fetch_array($risUser);
          $pass=$array[password];
       	  if($password==$pass){
            echo "ok";
            }else  echo"password errata";
         }else echo"utente non registrato";

		}







        /*
        if(!$risUser){
        echo"<div class='alert alert-danger' role='alert'>  Accesso non riuscito! </div>";
        }else{
        //accesso risucito
        echo"<div class='alert alert-success' role='alert'>Accesso riuscito!</div>";
        //titolo
        echo"<h2 id='titolo' class='tphp'>Tabella informazioni</h2>";

		//Query che mostra le informazioni riguardanti il passeggero
		$sql = 'Select VISITA.codFiscale, VISITA.patologia, VISITA.pressioneA, VISITA.temperatura, VISITA.frequenzaC 	from VISITA, PAZIENTE	where (PAZIENTE.codFiscale=VISITA.codFiscale and VISITA.codFiscale ="'.$username.'") group by VISITA.codFiscale, VISITA.dataEora, VISITA.patologia, VISITA.pressioneA, VISITA.temperatura, VISITA.frequenzaC';

		//Esecuzione query che restituisce $ris
		$ris = $con->query($sql) or die ("Query fallita!");

		//Genero tabella di visualizzazione
		echo "<table class='table table-primary table-striped';><tr><td>Codice fiscale</td><Td>Patologia</td><Td>Temperatura</td><Td>Frequenza cardiaca</td><td>Pressione arteriosa</td></tr>";

		//Ciclo foreach legge gli elementi del resultset $ris
		foreach($ris as $riga)
		{
		echo "<tr><td>".$riga["codFiscale"];
		echo "<td>".$riga["patologia"];
		echo "<td>".$riga["temperatura"];
		echo "<td>".$riga["frequenzaC"];
		echo "<td>".$riga["pressioneA"];
		}
  }
*/

		//rilascio connessione
		$con->close();
	}
		?>
        </div>
      </div>
      </main>
    <footer class="container">
      <p>&copy;Smart Airport 2020/2021</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  </body>
</html>
