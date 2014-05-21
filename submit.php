<?php 
$nome=$_POST[nome]; 
$email=$_POST[email]; 
$telefone=$_POST[telefone];
$mensagem=$_POST[mensagem];
mail("charleslcsantos@gmail.com","Mensagem recebida PortalMB","
Foi enviada uma mensagem pelo PortalMB. Segue abaixo os dados do remetente:
Nome: $nome
Email: $email
Telefone: $telefone
Mensagem: $mensagem","FROM:$nome<$email>");

if(($nome=="") || ($mensagem) || ($email)){
	echo("<script type='text/JavaScript'>
	alert('Preencha os campos obrigatórios!.');
	document.location.href='contato.html';	
	</script> ");	
}else{
	echo("<script type='text/JavaScript'>
		alert('Sua mensagem foi enviada! Agradecemos seu contato.');
		document.location.href='contato.html';	
		</script> ");	
}
?>