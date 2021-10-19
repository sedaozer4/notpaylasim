<?php include 'header.php';

$veriHakkimizda = $conn->query('SELECT * FROM hakkimizda')->fetch(PDO::FETCH_ASSOC);
 ?>

<section class="page-header">
	<div class="page-header__bg" style="background-image: url(assets/images/backgrounds/page-header-bg-1-1.jpg);"></div>

	<div class="container">
		<ul class="thm-breadcrumb list-unstyled">
			<li><a href="anasayfa">Anasayfa</a></li>
			<li>/</li>
			<li><span>Hakkımızda</span></li>
		</ul>
		<h2>Hakkımızda</h2>
	</div>
</section>
<section class="project-details">
	<div class="container">

		<h2>Hakkımızda</h2>
		<p><?php echo $veriHakkimizda['hakkimizda']; ?></p>

		<div class="bottom-content">
			<div class="row">
				<div class="col-lg-6">
					<h3>Vizyonumuz</h3>
					<p><?php echo $veriHakkimizda['vizyon']; ?></p>
					
				</div>
				<div class="col-lg-6">
					<h3>Vizyonumuz</h3>
					<p><?php echo $veriHakkimizda['misyon']; ?></p>
					
				</div>
			</div>
		</div>
	</div>
</section>



<?php include 'footer.php'; ?>