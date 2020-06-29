<?php
	session_start();
	
	if(session_destroy()){
		header("Location: welcomepage.php");
	}
?>