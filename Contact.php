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
 		$this->setFromEmail($this->limparEspacos($this->fromEmail));
 		$this->setToEmail($this->limparEspacos($this->toEmail));
 		if($this->validarEmail($this->fromEmail) &&
 			$this->validarEmail($this->toEmail)){

	 	   $this->data_envio = date('d/m/Y');
		   $this->hora_envio = date('H:i:s');
		   $this->nome = $this->limparMensagem($this->nome);
		   $this->assunto = $this->limparMensagem($this->assunto);
		   $this->mensagemTexto = $this->limparMensagem($this->mensagemTexto);

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
		}else{
			echo "<script>alert('Email Invalido');</script>";
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

 	public function limparMensagem($string){
 		$string = preg_replace('/[`^~\'"]/', null, iconv('UTF-8' , 'ASCII//TRANSLIT',
		$string));
		$string = strtolower($string);
		$string = str_replace("  ", " ", $string);
		$string = str_replace("---","-", $string);
		$string = str_replace("(","-", $string);
		$string = str_replace(")","-", $string);
		$string = str_replace(".","-", $string);
		$string = str_replace("&","-", $string);
		$string = str_replace("%","-", $string);
		$string = str_replace("|","-", $string);
		$string = str_replace("=","-", $string);
		$string = str_replace("#","-", $string);
		$string = str_replace("/","-", $string);
		$string = str_replace("+","-", $string);
		$string = str_replace("_","-", $string);
		$string = str_replace("*","-", $string);
		$string = str_replace("$","-", $string);
		$string = str_replace("@","-", $string);
		$string  = trim($string);
	return $string;
	}

	//fonte:http://blog.thiagobelem.net/quanto-cobrar-por-um-site
	public function validarEmail($email){
		$conta = '/^[a-zA-Z0-9\._-]+?@';
		$domino = '[a-zA-Z0-9_-]+?\.';
		$gTLD = '[a-zA-Z]{2,6}'; //.com; .coop; .gov; .museum; etc.
		$ccTLD = '((\.[a-zA-Z]{2,4}){0,1})$/'; //.br; .us; .scot; etc.
		$pattern = $conta.$domino.$gTLD.$ccTLD;
		if (preg_match($pattern, $email)){
			return true;
		}else{
			return false;
		}
	}

	public function limparEspacos($string){
		return trim($string);
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