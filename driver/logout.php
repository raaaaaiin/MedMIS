<?php
	session_start();
	
	
	session_destroy();
	header('location:../management/index.php');