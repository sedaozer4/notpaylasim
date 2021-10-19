<?php include 'header.php'; ?>
<section class="page-header">
	<div class="page-header__bg" style="background-image: url(assets/images/backgrounds/page-header-bg-1-1.jpg);"></div>

	<div class="container">
		<ul class="thm-breadcrumb list-unstyled">
			<li><a href="anasayfa">Anasayfa</a></li>
			<li>/</li>
			<li><span>İletişim</span></li>
		</ul>
		<h2>İletişim</h2>
	</div>
</section>
<section class="contact-one">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-6 col-xl-4">
				<div class="contact-one__content">
					<div class="block-title">
						<div class="block-title__image"></div>
						<p>İletişim</p>
						<h3>İletişime Geçin</h3>
					</div>
					<div class="contact-one__summery">
						<p>Bize ulaşmak için formu doldurabilirsiniz.

						</p>
					</div>
					<div class="contact-one__social">
						<a href="<?php echo $veri['fb']; ?>" class="fab fa-facebook-square"></a>
						<a href="<?php echo $veri['twitter']; ?>" class="fab fa-twitter"></a>
						<a href="<?php echo $veri['instagram']; ?>" class="fab fa-instagram"></a>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-6 col-xl-8">
				<form action="islemler.php" method="POST" class="contact-one__form">
					 <input type="hidden" name="backUrl" value="iletisim">

					<div class="row">
                        <div class="col-lg-6">
                            <input type="text" name="ad" placeholder="Adınız Soyadınız">
                        </div>
                        <div class="col-lg-6">
                            <input type="text" name="mail" placeholder="Email Adresiniz">
                        </div>
                        <div class="col-lg-12">
                            <input type="text" name="tel" placeholder="Telefon Numaranız">
                        </div>
                        <div class="col-lg-12">
                            <textarea name="mesaj" placeholder="Mesajınız"></textarea>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" name="mesajGonder" class="thm-btn">Mesajımı Gönder</button>
                        </div>
                    </div>
				</form>
			</div>
		</div>
	</div>
</section>
<section class="contact-infos">
	<div class="container">
		<div class="inner-container wow fadeInUp" data-wow-duration="1500ms">
			<div class="row no-gutters">
				<div class="col-sm-12 col-md-12 col-lg-4">
					<div class="contact-infos__single">
						<h3>Telefon</h3>
						<p> <i class="fa fa-phone" ></i> <?php echo $veri['tel']; ?></p>
					</div>
				</div>
				<div class="col-sm-12 col-md-12 col-lg-4">
					<div class="contact-infos__single">
						<h3>Adres</h3>
						<p> <i class="fa fa-home" ></i> <?php echo $veri['adres']; ?></p>
					</div>
				</div>
				<div class="col-sm-12 col-md-12 col-lg-4">
					<div class="contact-infos__single">
						<h3>Email</h3>
						<p><a href="mailto:<?php echo $veri['mail']; ?>">
							<i class="fa fa-envolve" ></i>
							<?php echo $veri['mail']; ?></a> <br>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<div class="google-map__home-two">
	<?php echo $veri['google_maps']; ?>
</div>

<?php include 'footer.php'; ?>