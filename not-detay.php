<?php 

if ($_GET['not_id']) {
	include 'header.php'; 

	$not_id = $_GET['not_id'];

	$notVeri = $conn->query('
		SELECT * FROM notler,firmalar,not_kategorileri WHERE
		notler.not_firma_id = firmalar.firma_id AND 
		notler.not_kategori_id = not_kategorileri.not_kat_id AND
		not_id  = ' . $_GET['not_id'] )->fetch(PDO::FETCH_ASSOC);

	$notYorumSay = $conn->query("SELECT count(*) as say FROM yorumlar WHERE onay = '1' AND yorum_not_id = '$not_id'")->fetch(PDO::FETCH_ASSOC);



	if (isset($_SESSION["kul_giris"])) 
	{

		$kulAnketVeri = $conn->query("SELECT * FROM anketler WHERE anket_kul_id = '$kul_id' AND anket_not_id = '$not_id'")->fetch(PDO::FETCH_ASSOC);
		$kulBolgeAnketVeri = $conn->query("SELECT * FROM bolge_anket WHERE bolge_anket_kul_id = '$kul_id' AND bolge_anket_not_id = '$not_id'")->fetch(PDO::FETCH_ASSOC);
	}




} else
{
	header("location:notler");
}
?>

<style>

.yesilYazi {
	color:#28a745!important;
}

.checked {
	color: orange;
}


.emoji .fa{
	font-size: 36px;
	color: grey;
}

.emoji {
	display: flex;
	width: 100%;
}

.emoji .flex-item {
	margin: 0px 15px;
	flex: 1;
	text-align: center;
}

.progress {
	height: 8px!important;
}
.fiyatDegeri {
	margin-top: 35px;
}
.fiyatDegeri h6 {
	margin-bottom: 15px;
}

.fiyatDegeri p {
	margin-bottom: 0;
}

.fiyatDegeri-item {
	padding: 0 0 15px 0;
	border-bottom: 1px solid #ccc;
}



.bolge {
	display: flex;
	width: 100%;
}

.bolge .flex-item {
	margin: 0px 15px;
	flex: 1;
	text-align: center;
	font-size: 11px;
}

.owl-carousel .owl-item img {
	object-fit: cover;
}

</style>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">




<div class="pd-wrap">
	<div class="container">
		<div class="heading-section">
			<h2><?php echo $notVeri['not_adi']; ?></h2>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div id="slider" class="owl-carousel product-slider">

					<div class="item">
						<img src="<?php echo $notVeri['resim']; ?>" />
					</div>




					<?php 

					$veriCek=$conn->prepare("SELECT * FROM not_galeri WHERE not_id = '$not_id'
						");
					$veriCek->execute();
					while ($rowGaleri=$veriCek->fetch(PDO::FETCH_ASSOC)) {  ?>


						<div class="item">
							<img src="<?php echo $rowGaleri['resim']; ?>" />
						</div>

					<?php } ?>
				</div>


				<div id="thumb" class="owl-carousel product-thumb">


					<div class="item">
						<img src="<?php echo $notVeri['resim']; ?>" />
					</div>




					<?php 

					$veriCek=$conn->prepare("SELECT * FROM not_galeri WHERE not_id = '$not_id'
						");
					$veriCek->execute();
					while ($rowGaleri=$veriCek->fetch(PDO::FETCH_ASSOC)) {  ?>


						<div class="item">
							<img src="<?php echo $rowGaleri['resim']; ?>" />
						</div>

					<?php } ?>


				</div>


			</div>
			<div class="col-md-6">
				<div class="product-dtl">
					<div class="product-info">
						<div class="product-name"><?php echo $notVeri['not_adi']; ?></div>
						<div class="reviews-counter">
							<span><?php echo $notYorumSay['say']; ?> Yorum Yapıldı.</span>
						</div>
						<div class="product-price-discount"><span>Firma Adı: <?php echo $notVeri['firma_adi']; ?></span></div>
						<div class="product-price-discount"><span>Kategori Adı: <?php echo $notVeri['kategori_adi']; ?></span></div>
					</div>
					<p><?php echo $notVeri['not_aciklama']; ?></p>


					



				</div>

				<?php 




				$toplamAnket = $conn->query("SELECT count(*) AS say FROM anketler WHERE anket_not_id = '$not_id' ")->fetch(PDO::FETCH_ASSOC);


				$toplamAnketMemnun = $conn->query("SELECT count(*) AS say FROM anketler WHERE anket_not_id = '$not_id' 
					AND anket_puan = '3'
					")->fetch(PDO::FETCH_ASSOC);


				$toplamAnketOrta = $conn->query("SELECT count(*) AS say FROM anketler WHERE anket_not_id = '$not_id'
					AND anket_puan = '2' ")->fetch(PDO::FETCH_ASSOC);


				$toplamAnketBegenmemek = $conn->query("SELECT count(*) AS say FROM anketler WHERE anket_not_id = '$not_id'
					AND anket_puan = '1' ")->fetch(PDO::FETCH_ASSOC);



				$toplam= $toplamAnket['say'];

				@$anketMemnunYuzde=floor(($toplamAnketMemnun['say']/ $toplam)*100);
				@$anketOrtaYuzde=floor(($toplamAnketOrta['say']/ $toplam)*100);
				@$anketBegenmemekYuzde=floor(($toplamAnketBegenmemek['say']/ $toplam)*100);


				?>
				<!-- Emoji Alanı Başlangıç-->
				<div class="emoji ">

					<div  class="flex-item">
						<button value="3" id="btnSevmek" class="btn btn-default btnAnket">
							<i  class="fa fa-grin-hearts <?php if($kulAnketVeri['anket_puan']=='3') echo 'yesilYazi'; ?> "></i>
						</button>
						<label class="w-100 pointer"  for="btnSevmek">Memnun Kaldım (<?php echo $toplamAnketMemnun['say']; ?>)</label>
						<div class="progress">
							<div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $anketMemnunYuzde; ?>%" aria-valuenow="<?php echo $anketMemnunYuzde; ?>" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>


					<div class="flex-item">
						<button value="2" id="btnOrta" class="btn btn-default btnAnket">
							<i class="fa fa-smile <?php if($kulAnketVeri['anket_puan']=='2') echo 'yesilYazi'; ?> "></i>
						</button>
						<label class="w-100 pointer" for="btnOrta">Orta (<?php echo $toplamAnketOrta['say']; ?>)</label>

						<div class="progress">
							<div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $anketOrtaYuzde; ?>%" aria-valuenow="<?php echo $anketOrtaYuzde; ?>" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>



					<div class="flex-item">
						<button value="1" id="btnBegenmemek" class="btn btn-default btnAnket">
							<i class="fa fa-frown <?php if($kulAnketVeri['anket_puan']=='1') echo 'yesilYazi'; ?> "></i>
						</button>
						<label class="w-100 pointer"  for="btnBegenmemek">Memnun olmadım (<?php echo $toplamAnketBegenmemek['say']; ?>)</label>

						<div class="progress">
							<div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $anketBegenmemekYuzde; ?>%" aria-valuenow="<?php echo $anketBegenmemekYuzde; ?>" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>

				</div>


				<div class="col-md-12 mt-3">
					<?php $oranHesapla = $conn->query("SELECT avg(anket_puan) AS ort FROM anketler WHERE anket_not_id = '$not_id' ")->fetch(PDO::FETCH_ASSOC); ?>
					
					<?php  echo $notVeri['not_adi']. ' ' . $toplamAnket['say'] . ' Oy ile 3 üzerinden : ' . $oranHesapla['ort']; ?>
				</div>

				<!-- Emoji Alanı Bitiş-->





				<!-- Fiyat Değeri Başlangıç-->
				<div class="fiyatDegeri">
					<?php 
				$toplamFiyatAnket = $conn->query("SELECT count(*) AS say FROM fiyat_anket WHERE f_anket_not_id = '$not_id' ")->fetch(PDO::FETCH_ASSOC);



				$toplamFiyatAnketCok = $conn->query("SELECT count(*) AS say FROM fiyat_anket WHERE f_anket_not_id = '$not_id'
				AND f_anket_puan = '3' ")->fetch(PDO::FETCH_ASSOC);



				$toplamFiyatAnketOrta = $conn->query("SELECT count(*) AS say FROM fiyat_anket WHERE f_anket_not_id = '$not_id' 
					AND f_anket_puan = '2' ")->fetch(PDO::FETCH_ASSOC);



				$toplamFiyatAnketUygun = $conn->query("SELECT count(*) AS say FROM fiyat_anket WHERE f_anket_not_id = '$not_id'
				AND f_anket_puan = '1'  ")->fetch(PDO::FETCH_ASSOC);




				@$toplamFiyatAnketCokYuzde = floor(($toplamFiyatAnketCok['say']/ $toplamFiyatAnket['say'])*100);

				@$toplamFiyatAnketOrtaYuzde = floor(($toplamFiyatAnketOrta['say']/ $toplamFiyatAnket['say'])*100);

				@$toplamFiyatAnketUygunYuzde = floor(($toplamFiyatAnketUygun['say']/ $toplamFiyatAnket['say'])*100);

				 ?>

					<div class="col-md-12"><h6>Fiyat Değeri (<?php echo $toplamFiyatAnket['say']; ?>)</h6>
						<label class="text-center w-100" id="fiyat-degeri-label" style="margin-bottom: 0!important;">Uygun Fiyat</label>
					</div>
					<div class="row">
						<div class="col-md-10">
							<input type="range" id="fiyat-degeri-range" name="fiyat_degeri" class="form-control" step="1" min="1" max="3" value="1">
						</div>
						<div class="col-md-2">
							<button id="oylaBtn" class="btn btn-primary btn-sm"> <i class="fa fa-vote-yea"></i> Oyla</button>
						</div>
					</div>

					<div class="fiyatDegeri-item">
						<p>Çok Pahalı (<?php echo $toplamFiyatAnketCok['say']; ?>)</p>
						<div class="progress">
							<div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $toplamFiyatAnketCokYuzde; ?>%" aria-valuenow="<?php echo $toplamFiyatAnketCokYuzde; ?>" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>


					<div class="fiyatDegeri-item">
						<p>Orta Fiyat (<?php echo $toplamFiyatAnketOrta['say']; ?>)</p>
						<div class="progress">
							<div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $toplamFiyatAnketOrtaYuzde; ?>%" aria-valuenow="<?php echo $toplamFiyatAnketOrtaYuzde; ?>" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>



					<div class="fiyatDegeri-item">
						<p>Uygun Fiyat (<?php echo $toplamFiyatAnketUygun['say']; ?>)</p>
						<div class="progress">
							<div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $toplamFiyatAnketUygunYuzde; ?>%" aria-valuenow="<?php echo $toplamFiyatAnketUygunYuzde; ?>" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>


				</div>

				<!-- Fiyat Değeri Bitiş-->




			</div>
		</div>



		<!-- Bölge Başlangıç -->

		<div class="row ">
			<div class="col-md-12 mt-3">
				<h3>Bölgeler</h3></div>
				<?php 

				$toplamBolgeAnket = $conn->query("SELECT count(*) AS say FROM bolge_anket WHERE bolge_anket_not_id = '$not_id'")->fetch(PDO::FETCH_ASSOC);


				$veriCek=$conn->prepare("SELECT * FROM bolgeler");
				$veriCek->execute();
				while ($rowBolge=$veriCek->fetch(PDO::FETCH_ASSOC)) {
					$anket_bolge_id = $rowBolge['bolge_id'];

					$bolgeAnketSay = $conn->query("SELECT count(*) AS say FROM bolge_anket WHERE bolge_anket_not_id = '$not_id'
						AND anket_bolge_id = '$anket_bolge_id' ")->fetch(PDO::FETCH_ASSOC);



					@$bolgeAnketYuzde=floor(( $bolgeAnketSay['say'] / $toplamBolgeAnket['say'])*100);


					?>


					<div class="col-md-3 mb-3">
						<label data-puan="<?php echo $rowBolge['bolge_id']; ?>" class="w-100 pointer text-center btnBolgeAnket 
							<?php if($kulBolgeAnketVeri['anket_bolge_id']== $rowBolge['bolge_id']) echo 'yesilYazi'; ?> " ><?php echo $rowBolge['bolge_adi']; ?> (<?php echo $bolgeAnketSay['say']; ?>)</label>
							<div class="progress">
								<div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $bolgeAnketYuzde; ?>%" aria-valuenow="<?php echo $bolgeAnketYuzde; ?>" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>

					<?php } ?>








				</div>

				<!-- Bölge Bitiş-->


				<div class="product-info-tabs">
					<ul class="nav nav-tabs" id="myTab" role="tablist">

						<li class="nav-item">
							<a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Yorumlar (<?php echo $notYorumSay['say']; ?>)</a>
						</li>
					</ul>
					<div class="tab-content" id="myTabContent">

						<div class="tab-pane fade active show" id="review" role="tabpanel" aria-labelledby="review-tab">

							<div class="blog-comment">

								<h2><?php echo $notYorumSay['say']; ?> Yorum</h2>



								<?php 

								$veriCekYorum=$conn->prepare("SELECT * FROM yorumlar,kullanicilar WHERE 
									onay = '1' AND yorumlar.yorum_not_id = '$not_id' AND yorumlar.yorum_kul_id = kullanicilar.kul_id ");
								$veriCekYorum->execute();
								while ($rowYorum=$veriCekYorum->fetch(PDO::FETCH_ASSOC)) {  ?>



									<div class="blog-comment__box">
										<div class="blog-comment__image">
											<img src="<?php echo $rowYorum['kul_resim']; ?>" alt="">
										</div>
										<div class="blog-comment__content">
											<h3><?php echo $rowYorum['kul_adi']; ?></h3>
											<p><?php echo strip_tags($rowYorum['yorum']); ?></p>

											<?php if ($rowYorum['kul_id'] == $kul_id) {?>

												<button islem="yorumSil" value="<?php echo $rowYorum['yorum_id']; ?>"  class=" btn-danger btn btn-yorum-sil btn-sm">
													<i class="fa fa-trash"></i> Yorumu Kaldır</button> 
												<?php } ?>





												<div class="yildizlar">


													<?php 
													$stars = $rowYorum['yildiz'];
													if ($stars>0) {

														for ($i=1; $i <= intval($stars) ; $i++) { 
															echo ' <span class="fa fa-star checked"></span>';
														}

														if ($stars > intval($stars)) {
															echo '<span class="fa fa-star-half checked "></span>';
														}
													} else 
													{
														for ($j=0; $j < 5 ; $j++) { 
															echo ' <span class="fa fa-star"></span>';
														}
													}


													?>




												</div>



											</div>
										</div>

									<?php } ?>


								</div>









								<form class="review-form" id="yorumGonderFrm">



									<input type="hidden" name="yorum_kul_id" value="<?php echo $kul_id; ?>">
									<input type="hidden" name="yorum_not_id" value="<?php echo $not_id; ?>">
									<div class="form-group">

										<div style="float: left;" class="rating mb-3"> 
											<input checked="" type="radio" name="rating" value="5" id="5">
											<label for="5">☆</label> 

											<input type="radio" name="rating" value="4" id="4">
											<label for="4">☆</label> 

											<input type="radio" name="rating" value="3" id="3">
											<label for="3">☆</label> 

											<input type="radio" name="rating" value="2" id="2">
											<label for="2">☆</label> 

											<input type="radio" name="rating" value="1" id="1">
											<label for="1">☆</label>

										</div>


										<label class="w-100">Yorumunuz</label>

										<textarea id="yorumTxtArea" name="yorum" class="form-control" rows="5"></textarea>
									</div>

									<button name="yorumGonder" class="round-black-btn">Yorumu Gönder</button>
								</form>
							</div>
						</div>
					</div>


				</div>
			</div>








			<?php include 'footer.php'; ?>

			<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

			<script>
				$(document).ready(function() {
					var slider = $("#slider");
					var thumb = $("#thumb");
		    var slidesPerPage = 4; //globaly define number of elements per page
		    var syncedSecondary = true;
		    slider.owlCarousel({
		    	items: 1,
		    	slideSpeed: 2000,
		    	nav: false,
		    	autoplay: false, 
		    	dots: false,
		    	loop: true,
		    	responsiveRefreshRate: 200
		    }).on('changed.owl.carousel', syncPosition);
		    thumb
		    .on('initialized.owl.carousel', function() {
		    	thumb.find(".owl-item").eq(0).addClass("current");
		    })
		    .owlCarousel({
		    	items: slidesPerPage,
		    	dots: false,
		    	nav: true,
		    	item: 4,
		    	smartSpeed: 200,
		    	slideSpeed: 500,
		    	slideBy: slidesPerPage, 
		    	navText: ['<svg width="18px" height="18px" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>', '<svg width="25px" height="25px" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>'],
		    	responsiveRefreshRate: 100
		    }).on('changed.owl.carousel', syncPosition2);
		    function syncPosition(el) {
		    	var count = el.item.count - 1;
		    	var current = Math.round(el.item.index - (el.item.count / 2) - .5);
		    	if (current < 0) {
		    		current = count;
		    	}
		    	if (current > count) {
		    		current = 0;
		    	}
		    	thumb
		    	.find(".owl-item")
		    	.removeClass("current")
		    	.eq(current)
		    	.addClass("current");
		    	var onscreen = thumb.find('.owl-item.active').length - 1;
		    	var start = thumb.find('.owl-item.active').first().index();
		    	var end = thumb.find('.owl-item.active').last().index();
		    	if (current > end) {
		    		thumb.data('owl.carousel').to(current, 100, true);
		    	}
		    	if (current < start) {
		    		thumb.data('owl.carousel').to(current - onscreen, 100, true);
		    	}
		    }
		    function syncPosition2(el) {
		    	if (syncedSecondary) {
		    		var number = el.item.index;
		    		slider.data('owl.carousel').to(number, 100, true);
		    	}
		    }
		    thumb.on("click", ".owl-item", function(e) {
		    	e.preventDefault();
		    	var number = $(this).index();
		    	slider.data('owl.carousel').to(number, 300, true);
		    });


		    $(".qtyminus").on("click",function(){
		    	var now = $(".qty").val();
		    	if ($.isNumeric(now)){
		    		if (parseInt(now) -1> 0)
		    			{ now--;}
		    		$(".qty").val(now);
		    	}
		    })            
		    $(".qtyplus").on("click",function(){
		    	var now = $(".qty").val();
		    	if ($.isNumeric(now)){
		    		$(".qty").val(parseInt(now)+1);
		    	}
		    });
		});

	</script>


	<script >
		var deger = 1;
		var degerText = '';
		$('#fiyat-degeri-range').on("change",function(){
			deger = $(this).val();
			if (deger==1) {
				degerText = 'Uygun Fiyat';				
			} else if (deger == 2) {
				degerText = 'Orta Fiyat';
			} else if (deger == 3)
			{
				degerText = 'Çok Pahalı';
			}
			$('#fiyat-degeri-label').text(degerText);

		});
	</script>




	<script>

		$(document).ready(function () {
			$("#yorumGonderFrm").submit(function (event) {
				var formData = $(this).serialize();

				$.ajax({
					type: "POST",
					url: "ajax/yorum_ekle.php",
					data: formData
				}).done(function (data) {

					if (data=='giris') {
						Toast.fire({
							icon: 'error',
							title: 'Yorum yapabilmek için giriş yapmalısınız'
						});	

						$('#girisYapModal').modal('show');

					} else {
						console.log(data);

						Toast.fire({
							icon: 'success',
							title: 'Yorumunuz başarılı bir şekilde kaydedildi moderatör tarafından onaylanınca yayınlanacaktır.'
						});	

						$('#yorumTxtArea').val('');

					}


				});

				event.preventDefault();


			});
		});

	</script>




	<script src="sweetalert.min.js"></script>
	<script type="text/javascript">

		$(".btn-yorum-sil").click(function(e) {


			swal({
				title: "Silme İşlemi",
				text: "Silinen yorumlar geri alınmaz silmek istediğinize emin misiniz?",
				icon: "warning",
				buttons: true,
				dangerMode: true,
				buttons: ["Hayır Silme", "Evet Sil!"],

			})
			.then((willDelete) => {
				if (willDelete) {

					e.preventDefault();
					$.ajax({
						type: "POST",
						url: "ajax/yorum_sil.php",
						data: { 
							islem: $(this).attr("islem"),
            id: $(this).val(), // < note use of 'this' here
        },
        success: function(result) {
        	swal("Silme İşlemi Başarılı", {
        		icon: "success",
        	}).then((result) => {

        		location.reload();

        	});



        },
        error: function(result) {
        	swal("Hata Silinmedi.", {
        		icon: "success",
        	});
        }
    });



				} else {
					swal("Silme İşlemi İptal Edildi.", {
						icon: "error",
					});
				}
			});


		});



	</script> 




	<script>
		var kul_id = <?php echo $kul_id; ?>;
		var not_id = <?php echo $not_id; ?>;
		$('.btnAnket').click(function(e){




			if (kul_id == 0) {
				

				Toast.fire({
					icon: 'error',
					title: 'Anket yapabilmek için giriş yapmalısınız'
				});	

				$('#girisYapModal').modal('show');


			}else {



				swal({
					title: "Anket İşlemi",
					text: "Bu derecelendirmeye oy vermek istediğinize emin misiniz?",
					icon: "info",
					buttons: true,
					dangerMode: true,
					buttons: ["Hayır", "Evet!"],

				})
				.then((willDelete) => {
					if (willDelete) {
						e.preventDefault();
						$.ajax({
							type: "POST",
							url: "ajax/anket_yap.php",
							data: { 
								anket_kul_id: kul_id,
								anket_not_id: not_id,
								anket_puan: $(this).val(),
							},
							success: function(result) {

								console.log(result);

								swal("Anketiniz Başarıyla Kaydedildi", {
									icon: "success",
								}).then((result) => {

									location.reload();

								});



							},
							error: function(result) {
								swal("Hata.", {
									icon: "error",
								});
							}
						});



					} else {
						swal("Anket İşlemi Edildi.", {
							icon: "error",
						});
					}
				});

			}//Giriş kontrol else



		});
	</script>






	<script>
		var kul_id = <?php echo $kul_id; ?>;
		var not_id = <?php echo $not_id; ?>;
		$('.btnBolgeAnket').click(function(e){




			if (kul_id == 0) {
				

				Toast.fire({
					icon: 'error',
					title: 'Anket yapabilmek için giriş yapmalısınız'
				});	

				$('#girisYapModal').modal('show');


			}else {



				swal({
					title: "Anket İşlemi",
					text: "Bu derecelendirmeye oy vermek istediğinize emin misiniz?",
					icon: "info",
					buttons: true,
					dangerMode: true,
					buttons: ["Hayır", "Evet!"],

				})
				.then((willDelete) => {
					if (willDelete) {
						e.preventDefault();
						$.ajax({
							type: "POST",
							url: "ajax/bolge_anket_yap.php",
							data: { 
								bolge_anket_kul_id: kul_id,
								bolge_anket_not_id: not_id,
								anket_bolge_id: $(this).data('puan'),
							},
							success: function(result) {

								console.log(result);

								swal("Anketiniz Başarıyla Kaydedildi", {
									icon: "success",
								}).then((result) => {

									location.reload();

								});



							},
							error: function(result) {
								swal("Hata.", {
									icon: "error",
								});
							}
						});



					} else {
						swal("Anket İşlemi Edildi.", {
							icon: "error",
						});
					}
				});

			}//Giriş kontrol else



		});
	</script>





	<script>
		var kul_id = <?php echo $kul_id; ?>;
		var not_id = <?php echo $not_id; ?>;
		$('#oylaBtn').click(function(e){




			if (kul_id == 0) {
				

				Toast.fire({
					icon: 'error',
					title: 'Anket yapabilmek için giriş yapmalısınız'
				});	

				$('#girisYapModal').modal('show');


			}else {



				swal({
					title: "Anket İşlemi",
					text: "Bu derecelendirmeye oy vermek istediğinize emin misiniz?",
					icon: "info",
					buttons: true,
					dangerMode: true,
					buttons: ["Hayır", "Evet!"],

				})
				.then((willDelete) => {
					if (willDelete) {
						e.preventDefault();
						$.ajax({
							type: "POST",
							url: "ajax/fiyat_anket_yap.php",
							data: { 
								f_anket_kul_id: kul_id,
								f_anket_not_id: not_id,
								f_anket_puan: $('#fiyat-degeri-range').val(),
							},
							success: function(result) {

								console.log(result);

								swal("Anketiniz Başarıyla Kaydedildi", {
									icon: "success",
								}).then((result) => {

									location.reload();

								});



							},
							error: function(result) {
								swal("Hata.", {
									icon: "error",
								});
							}
						});



					} else {
						swal("Anket İşlemi Edildi.", {
							icon: "error",
						});
					}
				});

			}//Giriş kontrol else



		});
	</script>