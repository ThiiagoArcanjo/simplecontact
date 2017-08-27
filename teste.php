<?php
	include_once "Contact.php";
	$contact = new Contact("Nome","FromEmail@gmail.com", "toEmail@gmail.com", "Assunto ", " Mensagem ");
	if($contact->enviar()){
		echo "Email enviado";
	}else{
		echo "Falha ao Enviar";
	}
?>