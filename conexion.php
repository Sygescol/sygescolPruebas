<?php
function conectarse($hostname_sygescol, $username_sygescol, $password_sygescol){	
	if(!($link=mysql_connect($hostname_sygescol,$username_sygescol,$password_sygescol)))
	{
		echo "Error conectando a la base de datos.";
		exit();
	}
	return $link;
}
?>