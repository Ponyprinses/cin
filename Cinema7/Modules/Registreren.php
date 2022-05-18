<?php
//init fields
$FirstName = $LastName = $Adres = $ZipCode = $City = $TelNr = $Email = $Username = 	$Password = $RetypePassword = NULL;

//init error fields
$FnameErr = $LnameErr = $ZipErr = $CityErr = $TelErr = $MailErr = $UserErr = $PassErr = $RePassErr = NULL;

if(isset($_POST['Registreren']))
{
	$CheckOnErrors = NULL; // hulpvariabele voor het valideren van het formulier
	
	/*
	Opdracht PM08 STAP 2: registreren
	Omschrijving: Lees alle gegevens uit het formulier uit middels de POST methode
	*/



	//BEGIN CONTROLES
	/*
	Opdracht PM08 STAP 3: registreren
	Omschrijving: Zorg er voor dat de gegevens worden gevalideerd op de eisen uit de opdracht. Gebruik de hulpvariabele $CheckOnErrors om later te kunnen controleren of er een fout is gevonden. Deze variabele zet je dus op true wanneer je een validatie fout tegenkomt. Voor het valideren kun je gebruik maken van de validatie functies in het bestand functies.php
	*/

	//controleer het voornaam veld
	if(is_minlength($_POST["FirstName"], 2)||is_Char_Only($_POST["FirstName"])){
		$CheckOnErrors = false;
		$FnameErr= NULL; 
	}
	else{
		$CheckOnErrors = true;
		$FnameErr= "Voornaam is te kort of bevat vreemde tekens";
	}

	//controleer het achternaam veld
	if(is_minlength($_POST["LastName"], 2)||is_Char_Only($_POST["LastName"])){
		$CheckOnErrors = false;
		$LnameErr= NULL; 
	}
	else{
		$CheckOnErrors = true;
		$LnameErr= "Achternaam is te kort of bevat vreemde tekens"; 
	}
	//controleer het postcode veld	
	if(is_NL_PostalCode($_POST["ZipCode"])){
		$CheckOnErrors = false;
		$ZipErr= NULL; 
	}
	else{
		$CheckOnErrors = true;
		$ZipErr= "Voer een geldige postcode in."; 
	}

	//controleer het plaats veld
	if(is_Char_Only($_POST["City"])){
		$CheckOnErrors = false;
		$CityErr= NULL; 
	}
	else{
		$CheckOnErrors = true;
		$CityErr= "Plaatsnaam bevat vreemde tekens. "; 
	}
	//controleer het telnr veld
	if(is_NL_Telnr($_POST["TelNr"])){
		$CheckOnErrors = false;
		$TelErr= NULL; 
	}
	else{
		$CheckOnErrors = true;
		$TelErr= "Voer een geldig telefoon nummer in. "; 
	}
	
	//controleer het email veld
	
	if(is_email($_POST["Email"])){
		$CheckOnErrors = false;
		$MailErr=NULL; 
	}
	else{
		$CheckOnErrors = true;
		$MailErr= "Voer een geldige e-mail in. ";
	}

	//controleer het username veld
	if(is_Username_Unique($_POST["Username"], ConnectDB())){
		$CheckOnErrors = false;
		$UserErr= NULL; 
	}
	else{
		$CheckOnErrors = true;
		$UserErr= "Gebruikersnaam bestaat al. ";
	}
	//controleer het paswoord veld
	if(is_minlength($_POST["Password"], 6 )){
		$CheckOnErrors = false;
		$PassErr= NULL; 
	}
	else{
		$CheckOnErrors = true;
		$PassErr= "Wachtwoord is niet lang genoeg"; 
	}
	
	//controleer het retype paswoord veld
	if($_POST["Password"]==$_POST["RetypePassword"]){
		$CheckOnErrors = false;
		$RePassErr= NULL; 
	}
	else{
		$CheckOnErrors = true;
		$RePassErr= "Wachtwoorden komen niet overeen. "; 
	}
	
	//EINDE CONTROLES


	/*
	Opdracht PM08 STAP 4: registreren
	Omschrijving: Controleer hier of er een fout is gevonden middels de CheckOnErrors variabele. Zo ja, dan ziet de gerbuiker opnieuw het formulier; zo nee, dan gaan we de gegevens in de database toevoegen.
	*/
	if($CheckOnErrors= true) //aanvullen
	{
	RedirectNaarPagina(4, 5);
	// echo $Errormss; 
	

	}
	else
	{
		//formulier is succesvol gevalideerd

		//maak unieke salt
		$Salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));

		//hash het paswoord met de Salt
		$Password = hash('sha512', $Password . $Salt);

		/*
		Opdracht PM08 STAP 5: registreren
		Omschrijving: Maak een prepared statement waarmee de gegevens van de gebruiker in de database worden toegevoegd. LET OP: Level moet 1 zijn! 
		*/
		$parameters = array(':Voornaam' => $_POST["FirstName"],
						':Achternaam' => $_POST["LastName"],
						':Adres' => $_POST["Adres"],
						':Postcode' => $_POST["ZipCode"],
						':Plaats' => $_POST["City"],
						':TelefoonNr' => $_POST["TelNr"],
						':Email' => $_POST["Email"],
						':Inlognaam' => $_POST["Username"],
						':Salt' => $Salt,
						':Wachtwoord' => $Password,
						':Level' => 1 );

		$sth = $pdo->prepare('INSERT INTO klanten (Voornaam, Achternaam, Adres, Postcode, Plaats, TelefoonNr, Email, Inlognaam , Salt, Wachtwoord, Level) VALUES (:Voornaam, :Achternaam, :Adres, :Postcode, :Plaats, :TelefoonNr, :Email, :Inlognaam , :Salt, :Wachtwoord, :Level)');
		$sth->execute($parameters);

		/*
		Opdracht PM08 STAP 6: registreren
		Omschrijving: Tot slot geef je de gebruiker de melding dat zijn gegevens zijn toegevoegd.
		*/
		RedirectNaarPagina(4, 4);
		echo "Uw gegevens zijn opgeslagen. "; 
		
	}
}
else
{
	require('./Forms/RegistrerenForm.php');
}
?>