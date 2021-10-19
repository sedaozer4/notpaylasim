<?php include 'header.php';
?>


<section style="padding-bottom: 150px;" class="main-slider">
    <div class="swiper-container thm-swiper__slider" data-swiper-options='{
        "slidesPerView": 1,
        "loop": true,
        "effect": "fade",
        "autoplay": {
            "delay": 5000
        },
        "navigation": {
            "nextEl": "#main-slider__swiper-button-next",
            "prevEl": "#main-slider__swiper-button-prev"
        }
    }'>
    <div class="swiper-wrapper">



        <?php 
        $veriCek=$conn->prepare("SELECT * FROM slider");
        $veriCek->execute();
        while ($rowSlider=$veriCek->fetch(PDO::FETCH_ASSOC)) { ?>


            <div class="swiper-slide">
                <div class="image-layer" style="background-image: url(<?php echo $rowSlider['resim']; ?>);">
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-xl-7 col-lg-7">
                            <h2><span>Fırat </span> <br>
                            Üniversitesi</h2>
                            <a href="iletisim" class=" thm-btn">İletişime Geç</a>

                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>



    </div>

    <div class="main-slider__nav">
        <div class="swiper-button-prev" id="main-slider__swiper-button-next"><i class="agrikon-icon-left-arrow"></i>
        </div>
        <div class="swiper-button-next" id="main-slider__swiper-button-prev"><i class="agrikon-icon-right-arrow"></i></div>
    </div>
</div>
</section>








<section class="gray-boxed-wrapper home-one__boxed">
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
                $veriCek=$conn->prepare("SELECT * FROM haberler LIMIT 3");
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
    <div class="blog-home__slogan">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="blog-home__slogan-main">
                        <i class="agrikon-icon-farm"></i>
                        <div class="blog-home__slogan-content">
                            <h3>Kısaca Hakkımızda</h3>
                            <p><?php 

                            $veriKisaca = $conn->query('SELECT *  FROM hakkimizda')->fetch(PDO::FETCH_ASSOC);
                            echo $veriKisaca['hakkimizda'];
                        ?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="blog-home__slogan-image">
                    <img src="assets/images/resources/blog-cta-1.png" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<section class="contact-two">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-5">
                <div class="contact-two__image">
                    <div class="contact-two__image-bubble-1"></div>
                    <div class="contact-two__image-bubble-2"></div>
                    <div class="contact-two__image-bubble-3"></div>
                    <img src="assets/images/resources/contact-1-1.jpg" class="img-fluid" alt="">
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                <div class="contact-two__content">
                    <div class="block-title">
                        <div class="block-title__image"></div>
                        <p>İletişim</p>
                        <h3>Bize Ulaşın</h3>
                    </div>
                    <div class="contact-two__summery">
                        <p>Bize ulaşmak için formu doldurabilirsiniz.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-4">
                <form method="POST" action="islemler.php"  class="contact-one__form ">
                    <input type="hidden" name="backUrl" value="anasayfa">
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="text" name="ad" placeholder="Adınız Soyadınız">
                        </div>
                        <div class="col-lg-12">
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


<?php include 'footer.php'; ?>