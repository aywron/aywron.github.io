<?php
	session_start();
	session_destroy();
	header('location: http://localhost/home1.html');
?>