function creaAjax()
	{
		var objetoAjax=false;
		try {
			objetoAjax=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e){
			try {
				objetoAjax=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(E){
				objetoAjax=false;
			}
		}
		if(!objetoAjax && typeof XMLHttpRequest!='undefined')
		{
			objetoAjax=new XMLHttpRequest();
		}
		return objetoAjax;
	}
	
function procesaAjax(ajax,capa)
{
	var capaContenedora=document.getElementById(capa);
	if (ajax.readyState==1)
	  {
			capaContenedora.innerHTML="Cargando...";
	  }
	else if (ajax.readyState==4)
	  {
				//capaContenedora.value=ajax.responseText;
				capaContenedora.innerHTML=ajax.responseText;
	  }
}

function buscapol(url,capa,valores,metodo)
{
	var ajax=creaAjax();
	
	if (metodo.toUpperCase()=='POST')
	  {
			ajax.open('POST', url, true);
			ajax.onreadystatechange=function()
			{
				procesaAjax(ajax,capa);	
			}
			ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			ajax.send(valores);
			return;
	  }
	if (metodo.toUpperCase()=='GET')
	 {
		ajax.open('GET', url ,true);
		ajax.onreadystatechange=function()
		{
			procesaAjax(ajax,capa);	
		}
		ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		ajax.send(null);
		return;
	 }
}