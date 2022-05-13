// JavaScript Document

function validaFormulario( formulario ) 
{
	if(formulario.todasNotas.value == 1)
	{
		alert('Falta definir notas en alguno de los periodos, favor revisar para poder ingresar datos');  
		return false;
	}
	return true;
}