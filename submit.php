<?php 
$nome= $_POST['nome']; 
$email= $_POST['email']; 
$telefone= $_POST['telefone'];
$assunto= $_POST['assunto'];
$mensagem= $_POST['mensagem'];

if(($nome=="") || ($mensagem=="") || ($email=="")){
	echo("<script type='text/JavaScript'>
	alert('Preencha os campos obrigatórios!.');
	document.location.href='index.html';	
	</script> ");	
}else{

	mail("adm.mbsolutions@gmail.com","Mensagem enviada via PortalMB","
			Assunto: $assunto \n
			Mensagem: $mensagem \n
			Esta mensagem foi enviada pelo PortalMB. Segue abaixo os dados do remetente:
			Nome: $nome <$email>
			Telefone: $telefone","FROM:PortalMB - Nova Mensagem<$email>");

	echo("<script type='text/JavaScript'>
		alert('Sua mensagem foi enviada! Agradecemos seu contato.');
		document.location.href='index.html';	
		</script> ");	
}
?>