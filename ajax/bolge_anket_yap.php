<?php 
include '../panel/inc/ayar.php';



$bolge_anket_kul_id = $_POST['bolge_anket_kul_id'];
$bolge_anket_not_id = $_POST['bolge_anket_not_id'];
$sonuc = $conn->exec("DELETE FROM bolge_anket WHERE bolge_anket_not_id = '$bolge_anket_not_id' AND
	bolge_anket_kul_id = '$bolge_anket_kul_id'");

if ($sonuc > 0) {
	echo "sildi";
} else {
}



$ekleSql = $conn->prepare("INSERT INTO bolge_anket SET
	bolge_anket_kul_id = :bolge_anket_kul_id,
	bolge_anket_not_id = :bolge_anket_not_id,
	anket_bolge_id = :anket_bolge_id");

$insert = $ekleSql->execute(array(
	"bolge_anket_kul_id" => $_POST['bolge_anket_kul_id'],
	"bolge_anket_not_id" => $_POST['bolge_anket_not_id'],
	"anket_bolge_id" => $_POST['anket_bolge_id']
));

if ($insert){
	echo 'ok';

} else {
	echo 'notok';
}


?>