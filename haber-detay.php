<?php 

if ($_GET['haber_id']) {
	include 'header.php'; 

	$haberVeri = $conn->query('SELECT * FROM haberler where id = ' . $_GET['haber_id'] )->fetch(PDO::FETCH_ASSOC);

} else
{
	header("location:haberler.php");
}
?>
<section class="page-header">
	<div class="page-header__bg" style="background-image: url(assets/images/backgrounds/page-header-bg-1-1.jpg);"></div>

	<div class="container">
		<ul class="thm-breadcrumb list-unstyled">
			<li><a href="haberler">Haberler</a></li>
			<li>/</li>
			<li><span><?php echo $haberVeri['baslik']; ?>
		</span></li>
	</ul>
	<h2><?php echo $haberVeri['baslik']; ?>
</h2>
</div>
</section>
<section class="project-details">
	<div class="container">
		<div class="col-md-12 text-center" >
			<img src="<?php echo $haberVeri['resim']; ?>" class="img-fluid" alt="">
		</div>
		<ul class="list-unstyled project-details__list">
			<li>
				<span>Tarih:
				</span>
				<?php echo $haberVeri['tarih']; ?>
			</li>
			

		</ul>
		<h2><?php echo $haberVeri['baslik']; ?></h2>
		<p>
			<?php echo $haberVeri['text']; ?>

		</p>

	</div>
</section>




<?php include 'footer.php'; ?>