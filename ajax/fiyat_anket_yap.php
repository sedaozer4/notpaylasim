<?php 
include '../panel/inc/ayar.php';



$f_anket_kul_id = $_POST['f_anket_kul_id'];
$f_anket_not_id = $_POST['f_anket_not_id'];
$sonuc = $conn->exec("DELETE FROM fiyat_anket WHERE f_anket_not_id = '$f_anket_not_id' AND
	f_anket_kul_id = '$f_anket_kul_id'");

if ($sonuc > 0) {
	echo "sildi";
} else {
}



$ekleSql = $conn->prepare("INSERT INTO fiyat_anket SET
	f_anket_kul_id = :f_anket_kul_id,
	f_anket_not_id = :f_anket_not_id,
	f_anket_puan = :f_anket_puan");

$insert = $ekleSql->execute(array(
	"f_anket_kul_id" => $_POST['f_anket_kul_id'],
	"f_anket_not_id" => $_POST['f_anket_not_id'],
	"f_anket_puan" => $_POST['f_anket_puan']
));

if ($insert){
	echo 'ok';

} else {
	echo 'notok';
}


?>