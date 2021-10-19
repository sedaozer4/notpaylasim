<?php include 'header.php'; ?>







<section class="gray-boxed-wrapper home-one__boxed mt-3">
    <img src="assets/images/icons/home-1-blog-bg.png" alt="" class="home-one__boxed-bg">
    <div class="blog-home-two blog-home-one">
        <div class="container">
            <div class="row top-row">
                <div class="col-lg-6">
                    <div class="block-title">
                        <div class="block-title__image"></div>
                        <p>Haberler</p>
                        <h3>Tüm Haberler</h3>
                    </div>
                </div>
                
            </div>
            <div class="row">


                <?php 
                $veriCek=$conn->prepare("SELECT * FROM haberler");
                $veriCek->execute();
                while ($rowHaber=$veriCek->fetch(PDO::FETCH_ASSOC)) { ?>



                    <div class="col-md-12 col-lg-4">
                        <div class="blog-card">
                            <div class="blog-card__image">
                                <img src="<?php echo $rowHaber['resim']; ?>">
                                <a href="<?=seo('haber-'.$rowHaber["baslik"]).'-'.$rowHaber["id"]?>"></a>
                            </div>
                            <div class="blog-card__content">
                                <div class="blog-card__meta">
                                    <a href="<?=seo('haber-'.$rowHaber["baslik"]).'-'.$rowHaber["id"]?>"><i class="far fa-user-circle"></i> Yönetici</a>

                                    <a href="<?=seo('haber-'.$rowHaber["baslik"]).'-'.$rowHaber["id"]?>"><i class="far fa-calendar"></i> <?php echo $rowHaber['tarih']; ?></a>

                                </div>
                                <h3><a href="<?=seo('haber-'.$rowHaber["baslik"]).'-'.$rowHaber["id"]?>"><?php echo $rowHaber['baslik']; ?></a></h3>
                                <a href="<?=seo('haber-'.$rowHaber["baslik"]).'-'.$rowHaber["id"]?>" class="thm-btn">Haberi Oku</a>
                            </div>
                        </div>
                    </div>

                <?php } ?>

            </div>
            <hr />
        </div>
    </div>
    
</section>




<?php include 'footer.php'; ?>