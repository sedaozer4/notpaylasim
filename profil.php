<?php
include 'giris-kontrol.php';
include 'header.php'; ?>


<style>
.profileImg{
	height: 100px;
	width: auto;
	border-radius: 50%;
	margin-bottom: 15px;
}


/* Style the tab */
.tab {
	overflow: hidden;
	border: 1px solid #ccc;
	background-color: #49a760;
	border-radius: 5px;
}

/* Style the buttons inside the tab */
.tab button {
	background-color: inherit;
	float: left;
	border: none;
	outline: none;
	cursor: pointer;
	padding: 14px 16px;
	transition: 0.3s;
	font-size: 17px;
	color: white;
}

/* Change background color of buttons on hover */
.tab button:hover {
	background-color: #f7c35f;
}

/* Create an active/current tablink class */
.tab button.active {
	background-color: #255946;
}

/* Style the tab content */
.tabcontent {
	display: none;

	border: 1px solid #ccc;
	border-top: none;
	animation: fadeEffect 0.9s; /* Fading effect takes 1 second */


}

/* Go from zero to full opacity */
@keyframes fadeEffect {
	from {opacity: 0;}
	to {opacity: 1;}
}


.contact-one__form {
	padding: 5px!important;
}


</style>



<section class="contact-one">
	<div class="container">
		<div class="row">



			<div class="tab w-100">
				<button class="tablinks active" onclick="openTabsOzel(event, 'profil')">Profili Düzenle</button>
				<button class="tablinks" onclick="openTabsOzel(event, 'sifre')">Şifre Değiştir</button>
			</div>





			<div style="display:block;" id="profil" class="tabcontent w-100">

				<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
					<form method="POST" class="contact-one__form" action="islemler.php" enctype="multipart/form-data">
						<div class="contact-one__content text-center">


							<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center mt-2">
								<img class="profileImg" src="<?php echo $kulVeri['kul_resim']; ?>">

							</div>


							<input type="hidden" name="kul_id" value="<?php echo $kulVeri['kul_id']; ?>">

							<h3>Profili Düzenle</h3>

							<div class="form-group text-left">
								<label>Profil Fotoğrafı</label>

								<button type="button" class="btn btn-dark form-control" onclick="document.getElementById('photo_upload').click()" id="photo_btn">Görsel Seç</button>

								<input type="file" name="kul_resim" id="photo_upload" accept="image/*" style="display:none;" >

							</div>


							<div class="form-group text-left">
								<label>Adınız Soyadınız</label>
								<input class="form-control" type="text" name="kul_adi" placeholder="Adınız Soyadınız" value="<?php echo $kulVeri['kul_adi']; ?>">
							</div>

							<div class="form-group text-left">
								<label>E-Posta Adresiniz</label>
								<input class="form-control" type="text" name="kul_eposta" placeholder="E-Posta Adresiniz"
								value="<?php echo $kulVeri['kul_eposta']; ?>"
								>
							</div>




							<div class="form-group text-left">


								<label for="kul_bolge_id">Bölge</label>
								<select name="kul_bolge_id" id="kul_bolge_id" class="form-control" required="">
									<?php 
									$veriCekBolge=$conn->prepare("SELECT * FROM bolgeler");
									$veriCekBolge->execute();
									while ($rowBolgeCek=$veriCekBolge->fetch(PDO::FETCH_ASSOC)) { ?>
										<option <?php if ($kulVeri['kul_bolge_id'] == $rowBolgeCek['bolge_id']) { echo 'selected'; } ?>
										 value="<?php echo $rowBolgeCek['bolge_id']; ?>"><?php echo $rowBolgeCek['bolge_adi']; ?></option>
									<?php } ?>
								</select>


							</div>




							<div class="form-group text-left">

								<label for="kul_il_kodu">Şehir</label>
								<select name="kul_il_kodu" id="kul_il_kodu" class="form-control" required="">
									<?php 
									$veriCekSehir=$conn->prepare("SELECT * FROM iller");
									$veriCekSehir->execute();
									while ($rowSehirCek=$veriCekSehir->fetch(PDO::FETCH_ASSOC)) { ?>
										<option <?php if ($kulVeri['kul_il_kodu'] == $rowSehirCek['il_kodu']) { echo 'selected'; } ?>
										value="<?php echo $rowSehirCek['il_kodu']; ?>"><?php echo $rowSehirCek['il_adi']; ?></option>
									<?php } ?>
								</select>

							</div>



							<button class="ozelBtn btn btn-block mt-3" type="submit" name="profilGuncelle">Profilimi Güncelle</button>
						</div>
					</form>
				</div>




			</div>



			<div id="sifre" class="tabcontent w-100">
				


				<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
					<form method="POST" class="contact-one__form" action="islemler.php">
						<div class="contact-one__content text-center">

							<input type="hidden" name="kul_id" value="<?php echo $kulVeri['kul_id']; ?>">

							<h3 class="mt-3 text-center">Şifre Değiştir</h3>
							<div class="form-group text-left">
								<label>Eski Şifreniz</label>
								<input required="" class="form-control" type="password" name="eskiSifre" placeholder="*****" value="">
							</div>

							<div class="row">
								<div class="col-md-6 col-lg-6">
									<div class="form-group text-left">
										<label>Yeni Şifreniz</label>
										<input required="" class="form-control" type="password" name="yeniSifre" placeholder="*****">
									</div>

								</div>

								<div class="col-md-6 col-lg-6 ">
									<div class="form-group text-left">
										<label>Yeni Şifreniz</label>
										<input required="" class="form-control" type="password" name="yeniSifreTekrar" placeholder="*****">
									</div>

								</div>
							</div>




							<button class="ozelBtn btn btn-block mt-3" type="submit" name="sifreGuncelle">Şifremi Güncelle</button>
						</div>
					</form>
				</div>


			</div>








		</div>
	</div>
</section>


<script>
	function openTabsOzel(evt, cityName) {
		var i, tabcontent, tablinks;
		tabcontent = document.getElementsByClassName("tabcontent");
		for (i = 0; i < tabcontent.length; i++) {
			tabcontent[i].style.display = "none";
		}
		tablinks = document.getElementsByClassName("tablinks");
		for (i = 0; i < tablinks.length; i++) {
			tablinks[i].className = tablinks[i].className.replace(" active", "");
		}
		document.getElementById(cityName).style.display = "block";
		evt.currentTarget.className += " active";
	}
</script>







<?php include 'footer.php'; ?>