<?php
@ob_start();
@session_start();
if (!isset($_SESSION["kul_giris"])) 

{
	header('location:index.php');
}
?>