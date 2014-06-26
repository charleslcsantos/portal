<?php 
$name = $_POST['cr_nome'];
$email = $_POST['cr_email']; 
$to = "adm.mbsolutions@gmail.com";
$from = "PortalMB - Novo Currículo Enviado<$email>";
$subject = "Currículo enviado - PortalMB";
$filename = $_FILES['cr_pdf']['name'];

if(($name != "") && ($email != "") && ($filename != "")){
	$attachment = chunk_split(base64_encode(file_get_contents($_FILES['cr_pdf']['tmp_name'])));
	//O boundary é algo como um ID. O codigo que estiver dentro do bloco --$boundary é um tipo de conteudo diferente
	$boundary =md5(date('r', time())); 
	$dados = "
	Foi enviado um novo curriculo através do PortalMB

	Dados do remetente:
	Nome: $name
	Email: $email
	Currículo: $filename";
	$message = "

	--$boundary
	Content-Type: multipart/mixed; boundary=\"--$boundary\"

	--$boundary
	Content-Type: application/pdf; name=\"$filename\" 
	Content-Transfer-Encoding: base64 

	$attachment
	--$boundary--";

	$headers = "From: ".$from."\r\n"
	      ."MIME-Version: 1.0\r\n"
	      ."Content-Type: multipart/mixed; boundary=\"".$boundary."\"\r\n\r\n"
	      ."This is a multi-part message in MIME format.\r\n" 
	      ."--".$boundary."\r\n"
	      //Espaço reservado para o texto que aparecerá no corpo do email
	      ."Content-Type: text/plain; charset= utf-8"
	      ." ".$dados."\r\n"
	      ."--".$boundary."\r\n"
	    //Espaço reservado para o anexo
	      ."--".$boundary."--"; 

	if(mail($to, $subject, $message, $headers)){
		echo("<script type='text/JavaScript'>
			alert('Sua mensagem foi enviada! Agradecemos seu contato.');
			document.location.href='index.html';	
			</script> ");
	}
	else {
		echo("<script type='text/JavaScript'>
			alert('Ocorreu um erro ao tentar enviar a mensagem Tente novamente mais tarde.');
			document.location.href='index.html';	
			</script> ");
	}
}else {
	echo("<script type='text/JavaScript'>
		alert('Preencha os campos obrigatórios (*).');
		document.location.href='index.html';	
		</script> ");
}
?>