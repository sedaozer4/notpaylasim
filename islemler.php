<?php 
include 'panel/inc/ayar.php';
ob_start();
session_start();
if (isset($_POST['mesajGonder'])) {

	$backUrl = $_POST['backUrl'];

	$query = $conn->prepare("INSERT INTO iletisim_mesajlari SET

		ad = :ad,
		mail = :mail,
		tel = :tel,
		mesaj = :mesaj
		");


	$insert = $query->execute(array(
		"ad" => $_POST['ad'],
		"mail" => $_POST['mail'],
		"tel" => $_POST['tel'],
		"mesaj" => $_POST['mesaj']
	));


	if ($insert) {
		header("Location: $backUrl?durum=basarili");
	}else {

		header("Location: $backUrl?durum=basarisiz");
	}



}








if (isset($_POST['uyeOl'])) {

	$data = array();

	if ($_POST['uyeOl_kul_sifre'] == $_POST['uyeOl_kul_sifreTekrar']) {
		$data['sifreUyum'] = 1;
		
	} else { $data['sifreUyum'] = 0; header("location:index.php?durum=sifreUyusmuyor"); }


		##Böyle bir üye var mı?
	$kullanicisor=$conn->prepare("SELECT * FROM kullanicilar WHERE kul_eposta = :kul_eposta ");
	$kullanicisor->execute(array(
		'kul_eposta' => $_POST['uyeOl_kul_eposta']
	));

	$say=$kullanicisor->rowCount();
	if ($say>0) {
		$data['kulVarMi'] = 1;
		header("location: index.php?durum=kulVar");
	} else { $data['kulVarMi'] = 0; }


	if ($_FILES['kul_resim']['size']>0) { 
		$dosyaUzantisi = pathinfo($_FILES["kul_resim"]["name"], PATHINFO_EXTENSION);
		$data['dosyaYuklenmisMi'] = 1;

		if ($dosyaUzantisi == 'jpg' || $dosyaUzantisi == 'png') {
			$data['uzantiKontrol'] = 1;
			$uploads_dir = 'assets/uploads/profil';
			@$tmp_name = $_FILES['kul_resim']["tmp_name"];
			$name = $_FILES['kul_resim']["name"];
			$benzersizsayi1=rand(20000,32000);
			$benzersizsayi2=rand(20000,32000);
			$benzersizad=$benzersizsayi1.$benzersizsayi2;
			$imgYol=substr($uploads_dir, 0)."/".$benzersizad.$name;
			@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");

		} else { $imgYol = 'assets/uploads/profil/avatar.png'; }

	} else { $data['dosyaYuklenmisMi'] = 0;  $imgYol = 'assets/uploads/profil/avatar.png';}







	if ($data['sifreUyum'] && !$data['kulVarMi']) {
		$query = $conn->prepare("INSERT INTO kullanicilar SET		
			kul_adi = :kul_adi,
			kul_eposta = :kul_eposta,
			kul_sifre = :kul_sifre,
			kul_resim = :kul_resim,
			kul_il_kodu = :kul_il_kodu,
			kul_bolge_id = :kul_bolge_id
			");


		$insert = $query->execute(array(
			"kul_adi" => $_POST['uyeOl_kul_adi'],
			"kul_eposta" => $_POST['uyeOl_kul_eposta'],
			"kul_sifre" => $_POST['uyeOl_kul_sifre'],
			"kul_resim" => $imgYol,
			"kul_il_kodu" => $_POST['uyeOl_kul_il_kodu'],
			"kul_bolge_id" => $_POST['uyeOl_kul_bolge_id']

		));


		if ($insert) {

			$_SESSION['kul_id'] = $conn->lastInsertId();
			$_SESSION['kul_giris'] = 'true';

			header("Location: index.php?durum=yeniUye");
		}else {

			header("Location: slider-ayar.php?durum=basarisiz");
			}//Ekleme kontrol else bitişi


		}




		print_r($data);






}//Post Kontrol bitişi






if (isset($_POST['girisYap'])) {


	##Böyle bir üye var mı?
	$kullanicisor=$conn->prepare("SELECT * FROM kullanicilar WHERE kul_eposta = :kul_eposta AND kul_sifre = :kul_sifre ");
	$kullanicisor->execute(array(
		'kul_eposta' => $_POST['girisYap_kul_eposta'],
		'kul_sifre' => $_POST['girisYap_sifre']
	));

	$say=$kullanicisor->rowCount();


	if ($say > 0) {
		$kul_eposta = $_POST['girisYap_kul_eposta'];
		$kulVeri = $conn->query("SELECT * FROM kullanicilar WHERE kul_eposta = '$kul_eposta'")->fetch(PDO::FETCH_ASSOC);

		$_SESSION['kul_id'] = $kulVeri['kul_id'];
		$_SESSION['kul_giris'] = 'true';
		header("Location: index.php?durum=giris");
	} else {
		header("Location: index.php?durum=girisBasarisiz");
	}
	


}






if (isset($_POST['profilGuncelle'])) {

	$islemiYap = true;

	##E-Mail Kontrol
	$kullanicisor=$conn->prepare("SELECT * FROM kullanicilar WHERE kul_eposta = :kul_eposta");
	$kullanicisor->execute(array(
		'kul_eposta' => $_POST['kul_eposta']
	));

	$say=$kullanicisor->rowCount();

	$kul_id = $_POST['kul_id'];
	$veriKul = $conn->query("SELECT * FROM kullanicilar WHERE kul_id = $kul_id")->fetch(PDO::FETCH_ASSOC);
	
	print_r($veriKul);


	if ($say>0) {

		if ($veriKul['kul_eposta']==$_POST['kul_eposta']) {
			$islemiYap = true;
		} else 	{ $islemiYap = false; header("location: profil?durum=kulVar"); }
		
	}


	if ($islemiYap) {

		$query = $conn->prepare("UPDATE kullanicilar SET		
			kul_adi = :kul_adi,
			kul_eposta = :kul_eposta,
			kul_il_kodu = :kul_il_kodu,
			kul_bolge_id = :kul_bolge_id
			WHERE kul_id = :kul_id
			");


		$update = $query->execute(array(
			"kul_adi" => $_POST['kul_adi'],
			"kul_eposta" => $_POST['kul_eposta'],
			"kul_bolge_id" => $_POST['kul_bolge_id'],
			"kul_il_kodu" => $_POST['kul_il_kodu'],
			"kul_id" => $_POST['kul_id']
		));




		if ($_FILES['kul_resim']['size']>0) { 
			$dosyaUzantisi = pathinfo($_FILES["kul_resim"]["name"], PATHINFO_EXTENSION);


			if ($dosyaUzantisi == 'jpg' || $dosyaUzantisi == 'png') {

				$uploads_dir = 'assets/uploads/profil';
				@$tmp_name = $_FILES['kul_resim']["tmp_name"];
				$name = $_FILES['kul_resim']["name"];
				$benzersizsayi1=rand(20000,32000);
				$benzersizsayi2=rand(20000,32000);
				$benzersizad=$benzersizsayi1.$benzersizsayi2;
				$imgYol=substr($uploads_dir, 0)."/".$benzersizad.$name;
				@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");


				$query = $conn->prepare("UPDATE kullanicilar SET		
					kul_resim = :kul_resim
					WHERE kul_id = :kul_id
					");

				$update = $query->execute(array(
					"kul_resim" => $imgYol,
					"kul_id" => $_POST['kul_id']
				));



			} else { header("location:profil?durum=basarisiz"); }


		}

		if ($update) {
			
			header("location: profil?durum=guncelleme");
		} else {
			
			header("location: profil?durum=basarisiz");
		}







	}






}












if (isset($_POST['sifreGuncelle'])) {
	$kul_id = $_POST['kul_id'];
	$veriKul = $conn->query("SELECT * FROM kullanicilar WHERE kul_id = $kul_id")->fetch(PDO::FETCH_ASSOC);
	
	if ($_POST['yeniSifre'] == $_POST['yeniSifreTekrar']) {
		$sifreUyusması = true;
	} else { $sifreUyusması = false; header ("location: profil?durum=sifreUyusmuyor");}



	if ($_POST['eskiSifre'] == $veriKul['kul_sifre']) {
		$eskiSifreKontrol = true;
	} else { $eskiSifreKontrol = false; header("location: profil?durum=sifreYanlis");}


	if ($eskiSifreKontrol && $sifreUyusması) {
		
		$query = $conn->prepare("UPDATE kullanicilar SET
			kul_sifre = :kul_sifre
			WHERE kul_id = :kul_id
			");
		$update = $query->execute(array(
			"kul_sifre" => $_POST['yeniSifre'],
			"kul_id" => $_POST['kul_id']
		));
		if ($update) {
			header("location: profil?durum=sifreBasarili");
		}else { header("location: profil?durum=basarisiz"); }


	}



}






if (isset($_POST['firmaEkle'])) {


	$uploads_dir = 'assets/uploads/firma';
	@$tmp_name = $_FILES['img']["tmp_name"];
	$name = $_FILES['img']["name"];
	$benzersizsayi1=rand(20000,32000);
	$benzersizsayi2=rand(20000,32000);
	$benzersizad=$benzersizsayi1.$benzersizsayi2;
	$imgYol=substr($uploads_dir, 0)."/".$benzersizad.$name;
	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");



	$firmaEkleSql = $conn->prepare("INSERT INTO firmalar SET
		firma_adi = :firma_adi,
		firma_logo = :firma_logo");

	$update = $firmaEkleSql->execute(array(
		"firma_adi" => $_POST['firma_adi'],
		"firma_logo" => $imgYol,
	));

	if ($update){

		header("Location: firma-ekle.php?status=success"); 

	} else {

		header("Location: firma-ekle.php?status=error");

	}




}


?>