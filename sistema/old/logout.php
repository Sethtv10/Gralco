<?PHP
	session_start();
	unset($_SESSION['usera']);
	unset($_SESSION['password']);
	$_SESSION = array();
	session_destroy();
	$sessionPath = session_get_cookie_params(); 
	setcookie(session_name(), "", 0, $sessionPath["path"], $sessionPath["domain"]);
	header("Location: index.php");
?>

