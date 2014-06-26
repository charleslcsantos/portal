<?php 
$name = $_POST['cr_nome'];
$email = $_POST['cr_email']; 
$to = "recursoshumanos@portalmb.com.br";
$from = "PortalMB - Novo Currículo Enviado<$email>";
$subject = "Currículo enviado - PortalMB";
$filename = $_FILES['cr_pdf']['name'];

if(($name != "") && ($email != "") && ($filename != "")){
	$attachment = chunk_split(base64_encode(file_get_contents($_FILES['cr_pdf']['tmp_name'])));
	//O boundary é algo como um ID. O codigo que estiver dentro do bloco --$boundary é um tipo de conteudo diferente
	$boundary =md5(date('r', time())); 
	$message = "
	--_1_$boundary
	Content-Type: text/plain; boundary=\"_2_$boundary\" 
	Foi enviado um novo curriculo através do PortalMB
	Dados do remetente:
	Nome: $name
	Email: $email
	Currículo: $filename
	";

	$content = "
	--_1_$boundary
	Content-Type: application/pdf; name=\"$filename\" 
	Content-Transfer-Encoding: base64 
	Content-Disposition: attachment 

	$attachment
	--_1_$boundary--";

	$headers .= "From: ".$from."\r\n"
	      ."MIME-Version: 1.0\r\n"
	      ."Content-Type: multipart/mixed; boundary=\"".$boundary."\"\r\n\r\n"
	      ."This is a multi-part message in MIME format.\r\n" 
	      ."--".$boundary."\r\n"
	      //Espaço reservado para o texto que aparecerá no corpo do email
	      ."Content-Type: text/plain; charset= utf-8"
	      ."--".$boundary."\r\n"
	      ."Content-Type: application/pdf; name=\"".$filename."\"\r\n"
	      ."Content-Transfer-Encoding: base64\r\n"
	      ."Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n"
	      .$content."\r\n\r\n"
	      ."--".$boundary."--"; 

	$result = mail($to, $subject, $message, $headers);
	if($result){
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