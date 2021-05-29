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
            <a class="nav-link" href="php/signup.php">Registrazione</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="php/login.php">Login</a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main">

      <div class="jumbotron">
        <div class="container">
          <?php
    //Se campo form non attivo (postback) mostra form
    if (empty($_POST['submit'])) {
       echo "<form action='".$_SERVER['PHP_SELF']."' method='POST'>";
       //username
       echo "<div class='mb-3'>";
       echo "<label for='username' class='form-label'>Username</label>";
       echo "<input type='username' class='form-control' id='username' placeholder='Scegli il tuo username'>";
       echo "</div>";
       //password
       echo "<div class='mb-3'>";
       echo "<label for='password' class='form-label'>Password</label>";
       echo "<input type='password' class='form-control' id='password' placeholder='Scegli la tua password'>";
       echo "</div>";
       //nome
      echo "<div class='mb-3'>";
      echo "<label for='nome' class='form-label'>Nome</label>";
      echo "<input type='text' class='form-control' id='nome' placeholder='Nome'>";
      echo "</div>";
      //cognome
      echo "<div class='mb-3'>";
      echo "<label for='cognome' class='form-label'>Cognome</label>";
      echo "<input type='text' class='form-control' id='cognome' placeholder='Cognome'>";
      echo "</div>";
      //data di nascita
      echo "<div class='mb-3'>";
      echo "<label for='date' class='form-label'>Data di nascita</label>";
      echo "<input type='date' class='form-control' id='dataNascita' placeholder='Data di nascita'>";
      echo "</div>";
       //codice carta d'identità
       echo "<div class='mb-3'>";
       echo "<label for='cId' class='form-label'>Codice carta d'identità</label>";
       echo "<input type='text' class='form-control' id='cId' placeholder='Digita il codice della tua carta d'identità  (es. cId0)'>";
       echo "</div>";

       //invia i dati
       echo "<button type='submit' value='Inserimento' name ='submit' class='btn btn-primary'>Conferma</button>";
       echo "</div></form>";
    } else {
   //Connessione a MySQL
   $con = new mysqli("localhost","root","","my_smartairport");
   if (mysqli_connect_errno()) {
      echo("Connessione non effettuata: ".mysqli_connect_error()."<br>");
      exit();
   }
		   $username=$_POST['username'];
		   $password=$_POST['password'];
		   $nome=$_POST['nome'];
		   $cognome=$_POST['cognome'];
		   $dataNascita=$_POST['dataNascita'];
		   $cId=$_POST['cId'];
   //Query insert tabella registrazione
   $sql= "INSERT INTO REGISTRAZIONE(username, password, cId)
	 VALUES('".$username."', '".$password."', '".$cId."')";
   //Esecuzione query che restituisce $ris
   $ris = $con->query($sql) or die ("Query fallita!");
	//Query insert tabella passeggero
   $sql= "INSERT INTO PASSEGGERO(cId, nome, cognome, dataNascita)
	 VALUES('".$cId."', '".$nome."', '".$cognome."', '".$dataNascita."')";
   //Esecuzione query che restituisce $ris
   $ris = $con->query($sql) or die ("Query fallita!");
    echo "<div class='alert alert-success' role='alert'> Registrazione effettuata con successo! Ora puoi fare il<a href='login.php' class='alert-link'>login</a></div>";

   //Rilascio connessione
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
