
<?php

try {

	include '../panel/inc/ayar.php';
	$id = $_POST['id'];
	$sonuc = $conn->exec("DELETE FROM yorumlar WHERE yorum_id = '$id'");

	if ($sonuc > 0) {
		echo "ok";
	} else {
		

	}

} catch (PDOException $e) {
	die($e->getMessage());
}

$conn = null;

?>