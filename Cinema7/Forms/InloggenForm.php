<!--
	Opdracht PM07 STAP 1: Inlogsysteem
	Omschrijving: Maak het formulier met 2 velden en de link naar de pagina registreren in html code
-->

<h1>Inloggen</h1>
	<?php 
	// echo '<br />'.$Message.'<br />';?>
	<form name="InlogFormulier" action="" method="post">
		<label for="Inlognaam">Gebruikersnaam:</label>
		<input type="text" id="Inlognaam" name="Inlognaam" />
		<br />
		<label for="Wachtwoord">Wachtwoord:</label>
		<input type="password" id="Wachtwoord" name="Wachtwoord" />
		<br />		
		<input type="submit" name="Inloggen" value="Inloggen" />
	</form>
	<br />
	Heeft u nog geen Account? Registreer dan <a href="index.php?PaginaNr=5">Hier</a>. 
