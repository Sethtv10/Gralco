window.onload = function() {
	$("autonombre").className="autocomplete";	
	new Ajax.Autocompleter("txtNombre", "autonombre", "ajax/nombre.php",{delay: 0.25,paramName:"caracteres"});
	new Ajax.Autocompleter("txtpoliza", "autopoliza", "ajax/poliza.php",{delay: 0.25,paramName:"caracteres"});
}