<?php 
include '../panel/inc/ayar.php';

if ($_POST['yorum_kul_id']== '0') {
	echo 'giris';
} else {



	$ekleSql = $conn->prepare("INSERT INTO yorumlar SET
		yorum_kul_id = :yorum_kul_id,
		yorum_not_id = :yorum_not_id,
		yorum = :yorum,
		yildiz = :yildiz");

	$insert = $ekleSql->execute(array(
		"yorum_kul_id" => $_POST['yorum_kul_id'],
		"yorum_not_id" => $_POST['yorum_not_id'],
		"yorum" => $_POST['yorum'],
		"yildiz" => $_POST['rating']
	));

	if ($insert){

		echo 'ok';

	} else {

		echo 'notok';

	}


}

?>