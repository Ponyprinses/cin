<?php
/*
	Opdracht PM05 STAP 1: Reserveren
	Omschrijving: Voer een query uit middels een prepared statement
*/
$sth= $pdo->prepare("SELECT * FROM films WHERE Status = 'InBios'"); 
$sth->execute(); 



/*
	Opdracht PM05 STAP 2: Reserveren
	Omschrijving: Zorg er voor dat het result van de query netjes op het scherm wordt getoond. Zorg er voor dat er een knopje "reserveren" is waarmee je doorgestuurd wordt naar de reserveren pagina
*/
echo "<table> <tr> <th>Titel</th><th>Duur</th><th>Genre</th><th>Leeftijd</th><th>Type</th><th>Beschrijving</th><th></th><th>Prijs</th> </tr>"; 

while($row = $sth->fetch()){
	echo "<tr><td>" . htmlspecialchars($row['Titel']) . 
	"&nbsp; </td><td>" . htmlspecialchars($row['Duur']) . "min." . 
	"&nbsp; </td><td>" . htmlspecialchars($row['Genre']) . 
	"&nbsp; </td><td>" . htmlspecialchars($row['Leeftijd']) . 
	"&nbsp; </td><td>" . htmlspecialchars($row['Type']) .  
	"&nbsp; </td><td>" . htmlspecialchars($row['Beschrijving']) . 
	"&nbsp; </td><td><img src=Images/" . htmlspecialchars($row['Plaatje']) . ">" . 
	"&nbsp; </td><td>" . htmlspecialchars($row['Prijs']) . "$" . 
	"&nbsp; </td><td><a href='Data.Tijden.php?" . htmlspecialchars($row['FilmID']) . "' >Reserveer</a>" . 
	"</td></tr>"; 

}
echo "</table>";


?>

Reserveren