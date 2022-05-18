<?php
/*
	Opdracht PM04 STAP 3: Verwacht in de bioscoop
	Omschrijving: Voer een query uit middels een prepared statement
*/
// $parameters= array(':Status'=>'Verwacht'); 
$sth= $pdo->prepare("SELECT * FROM films WHERE Status = 'Verwacht'"); 
$sth->execute(); 


/*
	Opdracht PM04 STAP 4: Verwacht in de bioscoop
	Omschrijving: Zorg er voor dat het result van de query netjes op het scherm wordt getoond.
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
	"</td></tr>"; 

}
echo "</table>";

?>

verwacht