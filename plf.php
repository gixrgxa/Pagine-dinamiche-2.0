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

    <title>Smart Airport - Compilazione PLF</title>
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
    //Se campo form non attivo (postback) mostra form
    if (empty($_POST['submit'])) {
       echo "<form action='".$_SERVER['PHP_SELF']."' method='POST' style='margin-right: 35%;margin-left: 35%;'>";
       //id PLF
       echo "<div class='mb-3'>";
       echo "<label for='idPlf' class='form-label'>id PLF</label>";
       echo "<input type='text' class='form-control' id='idPlf' name='idPlf' placeholder='(es. 01, 02, ecc.)'>";
       echo "</div>";
      //codice carta d'identità
       echo "<div class='mb-3'>";
       echo "<label for='cId' class='form-label'>Codice carta d'identità</label>";
       echo "<input type='text' class='form-control' id='cId' name='cId' placeholder='(es. cId0, cId1, ecc.)'>";
       echo "</div>";
       //indirizzo temporaneo
      echo "<div class='mb-3'>";
      echo "<label for='indirizzoTemp' class='form-label'>Indirizzo temporaneo</label>";
      echo "<input type='text' class='form-control' id='indirizzoTemp'  name='indirizzoTemp' placeholder='Via/Piazza...'>";
      echo "</div>";
      //alloggio precedente
      echo "<div class='mb-3'>";
      echo "<label for='alloggioPrec' class='form-label'>Alloggio Precedente</label>";
      echo "<input type='text' class='form-control' id='alloggioPrec' name='alloggioPrec' placeholder='Via/Piazza...'>";
      echo "</div>";
      //Recapito di emergenza
      echo "<div class='mb-3'>";
      echo "<label for='date' class='form-label'>Recapito di emergenza</label>";
      echo "<input type='tel' class='form-control' id='recEmergenza' name='recEmergenza' placeholder='Recapito di emergenza'>";
      echo "</div>";

       //greenPass
        echo "<div class='mb-3'>
        <label for='greenPass' class='form-label'>Sei in possesso del green Pass?</label><br>
        <div class='form-check form-check-inline'>
        <input class='form-check-input' type='radio' name='greenPass' id='greenPass1' value='1'>
        <label class='form-check-label' for='inlineRadio1'>Sì</label>
        </div>
        <div class='form-check form-check-inline'>
        <input class='form-check-input' type='radio' name='greenPass' id='greenPass2' value='0'>
        <label class='form-check-label' for='inlineRadio2'>No</label>
        </div>
        </div>";
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
		   $idPlf=$_POST['idPlf'];
		   $cId=$_POST['cId'];
		   $indirizzoTemp=$_POST['indirizzoTemp'];
		   $alloggioPrec=$_POST['alloggioPrec'];
		   $recEmergenza=$_POST['recEmergenza'];
      $greenPass=$_POST['greenPass'];
           var_dump($greenPass);
         //Query insert tabella registrazione
         $sql= "INSERT INTO PLF(idPlf, cId, greenPass, indirizzoTemp, alloggioPrec, recEmergenza)
           VALUES ('".$idPlf."', '".$cId."', '".$greenPass."', '".$indirizzoTemp."', '".$alloggioPrec."','".$recEmergenza."')";
         //Esecuzione query che restituisce $ris
         $ris = $con->query($sql) or die ("Query fallita!");
         /*
         if($greenPass=='0'){
         echo"<div class='alert alert-success' role='alert'>
          <h4 class='alert-heading'>Ben fatto!</h4>
          <p>Non essendo in possesso del Green Pass drovrai recarti nell'ala dedicata ai tamponi 2 ore prima del tuo volo.</p>
          <hr>
          <p class='mb-0'>Buona fortuna e buon viaggio!</p>
        </div>";
         }else{
          echo"<div class='alert alert-success' role='alert'>
          <h4 class='alert-heading'>Ben fatto!</h4>
          Compilazione completata con successo! Ora puoi effettuare il  <a href='login.php' class='alert-link'>login</a>
                    <hr>
          <p class='mb-0'>Buona fortuna e buon viaggio!</p>
        </div>";
		}
        */
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
