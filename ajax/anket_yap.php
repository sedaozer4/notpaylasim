<?php 
include '../panel/inc/ayar.php';



	$anket_kul_id = $_POST['anket_kul_id'];
	$anket_not_id = $_POST['anket_not_id'];
	$sonuc = $conn->exec("DELETE FROM anketler WHERE anket_not_id = '$anket_not_id' AND
		anket_kul_id = '$anket_kul_id'");

	if ($sonuc > 0) {
		echo "sildi";
	} else {
		

	}









$ekleSql = $conn->prepare("INSERT INTO anketler SET
	anket_kul_id = :anket_kul_id,
	anket_not_id = :anket_not_id,
	anket_puan = :anket_puan");

$insert = $ekleSql->execute(array(
	"anket_kul_id" => $_POST['anket_kul_id'],
	"anket_not_id" => $_POST['anket_not_id'],
	"anket_puan" => $_POST['anket_puan']
));

if ($insert){

	echo 'ok';

} else {

	echo 'notok';

}


?>