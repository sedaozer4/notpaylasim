

<footer class="site-footer">

  <img src="assets/images/icons/footer-bg-icon-1.png" class="site-footer__shape-1" alt="">

  <img src="assets/images/icons/footer-bg-icon-2.png" class="site-footer__shape-2" alt="">

  <div class="container">

    <div class="row">

      <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">

        <div class="footer-widget">

          <a  href="anasayfa" class="footer-widget__Logo">

            <img style="background-color: white;padding: 15px; border-radius: 5px;" src="<?php echo $veri['logo']; ?>" width="153" alt="">

          </a>


          <br>

          <div class="mc-form__response"></div>

          <div class="footer__social">

            <a href="<?php echo $veri['fb']; ?>" class="fab fa-facebook-square"></a>

            <a href="<?php echo $veri['twitter']; ?>" class="fab fa-twitter"></a>

            <a href="<?php echo $veri['instagram']; ?>" class="fab fa-instagram"></a>

          </div>

        </div>

      </div>

      <div class="col-sm-12 col-md-6 col-lg-6 col-xl-2">

        <div class="footer-widget footer-widget__links-widget">

          <h3 class="footer-widget__title">Sayfalar</h3>

          <ul class="list-unstyled footer-widget__links">





            <li>

              <a href="hakkimizda">Hakkımızda</a>

            </li>



            <li>

              <a href="notler">Notlar</a>

            </li>





            <li>

              <a href="haberler">Haberler</a>

            </li>





            <li>

              <a href="iletisim">İletişim</a>

            </li>











          </ul>

        </div>

      </div>

      <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">

        <div class="footer-widget">

          <h3 class="footer-widget__title">Son Haberler</h3>

          <ul class="list-unstyled footer-widget__post">



            <?php 

            $veriCek=$conn->prepare("SELECT * FROM haberler LIMIT 2");

            $veriCek->execute();

            while ($rowHaberFooter=$veriCek->fetch(PDO::FETCH_ASSOC)) { ?>



              <li>

                <img style="height: 100px!important;width: 100px!important;object-fit: cover;" src="<?php echo $rowHaberFooter['resim']; ?>" alt="">

                <div class="footer-widget__post-content">

                  <span><?php echo $rowHaberFooter['tarih']; ?></span>

                  <h4><a href="<?=seo('haber-'.$rowHaberFooter["baslik"]).'-'.$rowHaberFooter["id"]?>"><?php echo $rowHaberFooter['baslik']; ?></a></h4>

                </div>

              </li>



            <?php } ?>



          </ul>

        </div>

      </div>

      <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">

        <h3 class="footer-widget__title">İletişim</h3>

        <ul class="list-unstyled footer-widget__contact">

          <li>

            <i class="agrikon-icon-telephone"></i>

            <a href="tel:<?php echo $veri['tel']; ?>"><?php echo $veri['tel']; ?></a>

          </li>

          <li>

            <i class="agrikon-icon-email"></i>

            <a href="mailto:<?php echo $veri['mail']; ?>"><?php echo $veri['mail']; ?></a>

          </li>

          <li>

            <i class="agrikon-icon-pin"></i>

            <a href="iletisim"><?php echo $veri['adres']; ?></a>

          </li>

        </ul>

      </div>

    </div>

  </div>

</footer>

<div class="bottom-footer">

  <div class="container">

    <p><?php echo $veri['copy']; ?></p>



  </div>

</div>

</div>

<div class="mobile-nav__wrapper">

  <div class="mobile-nav__overlay mobile-nav__toggler"></div>



  <div class="mobile-nav__content">

    <span class="mobile-nav__close mobile-nav__toggler"><i class="far fa-times"></i></span>

    <div class="logo-box">

      <a href="anasayfa" aria-label="logo image"><img style="background-color: white;padding: 15px; border-radius: 5px;" src="<?php echo $veri['logo']; ?>" width="155" alt="" /></a>

    </div>



    <div class="mobile-nav__container"></div>



    <ul class="mobile-nav__contact list-unstyled">

      <li>

        <i class="agrikon-icon-email"></i>

        <a href="mailto:<?php echo $veri['mail']; ?>"><?php echo $veri['mail']; ?></a>

      </li>

      <li>

        <i class="agrikon-icon-telephone"></i>

        <a href="tel:<?php echo $veri['tel']; ?>"><?php echo $veri['tel']; ?></a>

      </li>

    </ul>

    <div class="mobile-nav__top">



      <div class="mobile-nav__social">

        <a href="<?php echo $veri['twitter']; ?>" aria-label="twitter"><i class="fab fa-twitter"></i></a>

        <a href="<?php echo $veri['fb']; ?>" aria-label="facebook"><i class="fab fa-facebook-square"></i></a>

        <a href="<?php echo $veri['instagram']; ?>" aria-label="instagram"><i class="fab fa-instagram"></i></a>

      </div>

    </div>

  </div>



</div>







<a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="fa fa-angle-up"></i></a>





<script src="assets/js/jquery-3.5.1.min.js"></script>

<script src="assets/js/bootstrap.bundle.min.js"></script>

<script src="assets/js/swiper.min.js"></script>

<script src="assets/js/jquery.ajaxchimp.min.js"></script>

<script src="assets/js/jquery.magnific-popup.min.js"></script>

<script src="assets/js/jquery.validate.min.js"></script>

<script src="assets/js/bootstrap-select.min.js"></script>

<script src="assets/js/wow.js"></script>

<script src="assets/js/odometer.min.js"></script>

<script src="assets/js/jquery.appear.min.js"></script>

<script src="assets/js/jarallax.min.js"></script>

<script src="assets/js/circle-progress.min.js"></script>

<script src="assets/js/wNumb.min.js"></script>

<script src="assets/js/nouislider.min.js"></script>



<script src="assets/js/theme.js"></script>







<script src="sweetalert2.min.js"></script>

<link rel="stylesheet" href="sweetalert2.min.css">







<script type="text/javascript">

  const Toast = Swal.mixin({

    toast: false,

    position: 'center',

    showConfirmButton: false,

    timer: 3000,

    timerProgressBar: true,



  })



</script>



<?php if (@$_GET['durum'] == "basarili") { ?>



  <script type="text/javascript">

   Toast.fire({

    icon: 'success',

    title: 'Mesajınız başarıyla alındı.'

  })



</script>



<?php } ?>















<?php if (@$_GET['durum'] == "yeniUye") { ?>



  <script type="text/javascript">

   Toast.fire({

    icon: 'success',

    title: 'Başarıyla üye olundu. Hoşgeldiniz,'

  })



</script>



<?php } ?>













<?php if (@$_GET['durum'] == "guncelleme") { ?>



  <script type="text/javascript">

   Toast.fire({

    icon: 'success',

    title: 'Profil başarıyla güncellendi.'

  })



</script>



<?php } ?>











<?php if (@$_GET['durum'] == "sifreBasarili") { ?>



  <script type="text/javascript">

   Toast.fire({

    icon: 'success',

    title: 'Şifreniz başarıyla değiştirildi.'

  })



</script>



<?php } ?>









<?php if (@$_GET['durum'] == "basarisiz") { ?>



  <script type="text/javascript">

    Toast.fire({

      icon: 'error',

      title: 'İşlem Başarısız'

    })



  </script>



<?php } ?>







<?php if (@$_GET['durum'] == "sifreYanlis") { ?>



  <script type="text/javascript">

    Toast.fire({

      icon: 'error',

      title: 'Yanlış Şifre Girdiniz.'

    })



  </script>



<?php } ?>







<?php if (@$_GET['durum'] == "kulVar") { ?>



  <script type="text/javascript">



    Toast.fire({

      icon: 'warning',

      title: 'Bu e-posta adresi kullanımda'

    })



  </script>



<?php } ?>





<?php if (@$_GET['durum'] == "sifreUyusmuyor") { ?>



  <script type="text/javascript">





    Toast.fire({

      icon: 'error',

      title: 'İşlem Başarısız, Şifreler uyuşmuyor'

    })



  </script>



<?php } ?>







<?php if (@$_GET['durum'] == "girisBasarisiz") { ?>



  <script type="text/javascript">



    Toast.fire({

      icon: 'error',

      title: 'Başarısız Giriş'

    })



    $('#girisYapModal').modal('show');





  </script>



<?php } ?>









<!-- Login Modal -->

<div class="modal fade" id="girisYapModal">

  <div class="modal-dialog modal-dialog-centered" role="document">

    <div class="modal-content form-wrapper">

      <div class="close-box" data-dismiss="modal">

        <i class="fa fa-times fa-2x"></i>

      </div>

      <div class="container-fluid mt-5">

        <form action="islemler.php" method="POST" id="LoginForm">

          <div class="form-group text-center">

            <h4>Giriş Yap</h4>

            <h6>Bilgilerinizi Giriniz</h6>

          </div>





          <div class="form-group" style="position: relative;">

            <label for="girisYap_kul_eposta">Email</label>

            <input type="email" id="girisYap_kul_eposta" name="girisYap_kul_eposta" class="form-control mb-1" placeholder="info@info.com" required>

          </div>



          <div class="form-group pb-3" style="position: relative;">

            <label for="girisYap_sifre">Şifreniz</label>

            <input type="password" id="girisYap_sifre" name="girisYap_sifre" class="form-control mb-1" placeholder="*******************" required>

          </div>



          <div class="w-100">

            <button name="girisYap" type="submit" class="ozelBtn btn-block btn">Giriş Yap</button>

          </div>





        </form>

      </div>

    </div>

  </div>

</div>





<!-- Registeration Modal -->

<div class="modal fade" id="uyeOlModal">

  <div class="modal-dialog modal-dialog-centered" role="document">

    <div class="modal-content form-wrapper">

      <div class="close-box" data-dismiss="modal">

        <i class="fa fa-times fa-2x"></i>

      </div>

      <div class="container-fluid mt-4">

        <form action="islemler.php" method="POST" id="RegisterationForm" enctype="multipart/form-data">

          <div class="form-group text-center pb-2">

            <h4>Kayıt Ol</h4>

            <sup style="color: #b5c3be;">Sadece jpg ve png uzantılar kabul edilir.(Zorunlu Değildir.)</sup>

          </div>

          <div class="form-row">



            <div class="form-group col">

              <label for="uyeOl_kul_adi">Adınız Soyadınız</label>

              <input type="text" id="uyeOl_kul_adi" name="uyeOl_kul_adi" class="form-control" placeholder="Adınız Soyadınız" required>

            </div>



            <div class="form-group col" style="position:relative;">

              <label for='photo_upload' style="display:block">Fotoğraf 



              </label>



              <button type="button" class="btn btn-dark form-control" onclick="document.getElementById('photo_upload').click()" id="photo_btn">Görsel Seç</button>



              <input type="file" name="kul_resim" id="photo_upload" accept="image/*" style="display:none;" >

            </div>



          </div>







          <div class="form-row">



            <div class="form-group col">

              <label for="uyeOl_kul_bolge_id">Bölge</label>

              <select name="uyeOl_kul_bolge_id" id="uyeOl_kul_bolge_id" class="form-control" required="">

                <?php 

                $veriCekBolge=$conn->prepare("SELECT * FROM bolgeler");

                $veriCekBolge->execute();

                while ($rowBolgeCek=$veriCekBolge->fetch(PDO::FETCH_ASSOC)) { ?>

                 <option value="<?php echo $rowBolgeCek['bolge_id']; ?>"><?php echo $rowBolgeCek['bolge_adi']; ?></option>

                 <?php } ?>

               </select>

             </div>





             



             <div class="form-group col">

              <label for="uyeOl_kul_il_kodu">Şehir</label>

              <select name="uyeOl_kul_il_kodu" id="uyeOl_kul_il_kodu" class="form-control" required="">

                <?php 

                $veriCekSehir=$conn->prepare("SELECT * FROM iller");

                $veriCekSehir->execute();

                while ($rowSehirCek=$veriCekSehir->fetch(PDO::FETCH_ASSOC)) { ?>

                 <option value="<?php echo $rowSehirCek['il_kodu']; ?>"><?php echo $rowSehirCek['il_adi']; ?></option>

                 <?php } ?>

               </select>

             </div>





            



          </div>







          <div class="form-group" style="position:relative;">

            <label for="kul_eposta">Email</label>

            <input type="email" id="uyeOl_kul_eposta" name="uyeOl_kul_eposta" class="form-control mb-1" placeholder="E-Mail Adresiniz" required>





          </div>

          <div class="form-row mb-1">

            <div class="form-group col">

              <label for="uyeOl_kul_sifre">Şifreniz</label>

              <input type="password" id="uyeOl_kul_sifre" name="uyeOl_kul_sifre" class="form-control" placeholder="*******************" required>



            </div>

            <div class="form-group col">

              <label for="uyeOl_kul_sifreTekrar">Şifre Tekrar</label>

              <input type="password" id="uyeOl_kul_sifreTekrar" name="uyeOl_kul_sifreTekrar" class="form-control" placeholder="*******************" required>

            </div>

          </div>



          <div class="form-group">

            <button type="submit" name="uyeOl" class="btn ozelBtn form-control">Kayıt Ol</button>

          </div>

        </form>

      </div>

    </div>

  </div>

</div>





</body>







</html>