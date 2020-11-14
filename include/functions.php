<?php 

function account_exists() : array {
	return [
		'id' => 2,
		'password' => '12345678'

	];
}


function account_informations() : array {
	return [];
}	



function email_free() : bool {
	//return false;
	return true;
}

function mail_html( string $subject, string $message){

	$headers = "From: Toto <info@gmail.com>" ."\r\n".
               "MIME-Version: 1.0" . "\r\n" .
               "Content-type: text/html; charset=UTF-8" . "\r\n";


   	mail( $_POST['email'], $subject, $message, $headers);            
} 


function password_ok() : bool {
	return true;
}



function password_save( string $password = ''){
	$newpassword = $_POST['newpassword'] ?? $password;			//?? veut dire 'sinon'

	if(isset($_POST['email'])){
		//gestion pour l'oubli de mot de passe
	}
	else {
		//gestion pour changement de mot de passe
	}

}



