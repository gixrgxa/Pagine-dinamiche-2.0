<?php
//Creazione oggetto mysqli per realizzare la connessione
$con = new mysqli("localhost","root","","simulazione esame");
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
//$username="coaosnk";
//	$password=array("guiltless","graceful","grandiose","grateful","godly","gamy","glistening","glamorous","grubby","giant","gaudy","grumpy","gifted","grey","gainful","gruesome","gleaming","gusty","green");
$sql='Select codFiscale from paziente WHERE codFiscale="'.$username.'"';
//var_dump($username);
//var_dump($sql);
//query per ottenere il codice fiscale
$risUser = $con->query($sql) or die ("Query fallita!");
/*
//riga con  tutti i codici fiscali
while($row=$risUser->fetch_assoc()){
  $codFiscale=$row['codFiscale'];
  var_dump(($codFiscale));
}
if($username == $codFiscale){
 header('Location:pagVisualPazienti.php');
}else{
     header('Location:loginPaziente.php');
}*/

//Definizione stringa contenente comando SQL
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

//rilascio connessione
$con->close();
}
?>
