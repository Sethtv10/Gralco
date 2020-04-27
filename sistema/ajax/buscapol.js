window.onload = function() {
	$("autopoliza").className="autocomplete";	
	new Ajax.Autocompleter("txtpoliza", "autopoliza", "../ajax/poliza.php",{delay: 0.25,paramName:"caracteres"});
}