<?php
	//If page is being accessed by HTTPS, then redirect user to check.php
	//This will happen only in cases when user is already authorized, and manually enters https://eidtstiis.pmlp.gov.lv/ url in browser's address bar.

	if ($_SERVER['HTTPS'] == "on") {
		header("Location: /check.php");
		exit;
	} 
?>


