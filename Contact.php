<?php
 class Contact{
 	private $nome;
	private $fromEmail;
	private $toEmail;
	private $assunto;
	private $mensagemTexto;
	private $data_envio;
	private $hora_envio;
	private $mensagemFinal;

 	public function __construct($nome,$fromEmail,$toEmail,
 		$assunto,$mensagemTexto){
 		$this->nome = $nome;
 		$this->fromEmail = $fromEmail;
 		$this->toEmail = $toEmail;
 		$this->assunto = $assunto;
 		$this->mensagemTexto = $mensagemTexto;

 	}

 	public  function enviar(){
 	   $this->data_envio = date('d/m/Y');
	   $this->hora_envio = date('H:i:s');
	   $this->prepararMensagem();

	   $headers  = "MIME-Version: 1.0 \n";
	   $headers .= "Content-type: text/html; charset=iso-8859-1\n";
       $headers .= "From: ". $this->getNome()." <". $this->getFromEmail().">";
	   $enviaremail = @mail( $this->getToEmail(),
	   		$this->getAssunto(),
	   		$this->getMensagemFinal(), $headers);

	   if($enviaremail){
			echo "<script>alert('Email enviado com Sucesso');</script>";
			return TRUE;

  		} else {
			echo "ERRO AO ENVIAR E-MAIL!";
			return FALSE;
		}

 	}

 	public function prepararMensagem(){
 		$this->setMensagemFinal("
			<p><strong>Nome: </strong>". $this->getNome()."</p></br>
			<p><strong>Email: </strong>". $this->getFromEmail()."</p> </br>
			<p><strong>Assunto: </strong>". $this->getAssunto()."</p></br>
			<p><strong>Mensagem: </strong>". $this->getMensagemTexto()."</p></br>
			<p><strong>Data de envio: </strong>". $this->data_envio ."</p></br>
			<p><strong>Hora da envio: </strong>". $this->hora_envio."</p> </br>");
 	}

 	public function setNome($nome){
 		$this->nome = $nome;
	}

 	public function getNome(){
 		return $this->nome;
 	}

 	public function setFromEmail($fromEmail){
 		$this->fromEmail = $fromEmail;
 	}

 	public function getFromEmail(){
 		return $this->fromEmail;
 	}

 	public function setToEmail($toEmail){
 		$this->toEmail = $toEmail;
 	}

 	public function getToEmail(){
 		return $this->toEmail;
 	}

 	public function setAssunto($assunto){
 		$this->assunto = $assunto;
 	}

 	public function getAssunto(){
 		return $this->assunto;
 	}

 	public function setMensagemTexto($mensagemTexto){
 		$this->mensagemTexto = $mensagemTexto;
 	}

 	public function getMensagemTexto(){
 		return $this->mensagemTexto;
 	}

 	public function setMensagemFinal($mensagemFinal){
 		$this->mensagemFinal = $mensagemFinal;
 	}

 	public function getMensagemFinal(){
 		return $this->mensagemFinal;
 	}



 }