<?php
@ob_start();
@session_start();
function seo($s) {
    $tr = array('ş','Ş','ı','I','İ','ğ','Ğ','ü','Ü','ö','Ö','Ç','ç','(',')','/',' ',',','?');
    $eng = array('s','s','i','i','i','g','g','u','u','o','o','c','c','','','-','-','','');
    $s = str_replace($tr,$eng,$s);
    $s = strtolower($s);
    $s = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $s);
    $s = preg_replace('/\s+/', '-', $s);
    $s = preg_replace('|-+|', '-', $s);
    $s = preg_replace('/#/', '', $s);
    $s = str_replace('\'', '-', $s);
    $s = str_replace('.', '', $s);
    $s = str_replace('!', '', $s);
    $s = str_replace('&', 've', $s);
    $s = trim($s, '-');
    return $s;
}

include 'panel/inc/ayar.php';

$veri = $conn->query('SELECT * FROM site_ayar')->fetch(PDO::FETCH_ASSOC);


if (isset($_SESSION["kul_giris"])) 
{
    $giris = true;
    $kul_id = $_SESSION['kul_id'];
    $kulVeri = $conn->query("SELECT * FROM kullanicilar WHERE kul_id = $kul_id")->fetch(PDO::FETCH_ASSOC);



} else {
    $giris = false;
    $kul_id = '0';
}
?>
<!DOCTYPE html>
<html lang="tr">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $veri['title']; ?></title>


    <link rel="icon" href="<?php echo $veri['favicon']; ?>" type="image/x-icon" />




    <meta name="description" content="<?php echo $veri['meta_description']; ?>">

    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Handlee&amp;family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/swiper.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/odometer.min.css">
    <link rel="stylesheet" href="assets/css/jarallax.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="assets/css/agrikon-icons.css">
    <link rel="stylesheet" href="assets/css/nouislider.min.css">
    <link rel="stylesheet" href="assets/css/nouislider.pips.css">

    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="custom.css">
</head>
<body>
    <div class="preloader">
        <img class="preloader__image" width="55" src="assets/images/loader.png" alt="">

        </div>
              </div>
          </div>
          <nav class="main-menu">
            <div class="container">
                <div class="logo-box">
                    <a href="anasayfa" aria-label="logo image"><img src="<?php echo $veri['logo']; ?>" height="153" alt=""></a>
                    <span class="fa fa-bars mobile-nav__toggler"></span>
                </div>
                <ul class="main-menu__list">
                    <li class="current">
                        <a href="anasayfa">Anasayfa</a>

                    </li>


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


                    <?php if (!$giris){ ?>
                        <li class="dropdown "><a href="#">Üye OL / Giriş Yap</a>
                            <ul>
                                <li class="">
                                    <a href="#uyeOlModal" data-toggle="modal" > <i class="fa fa-user-plus"> <span style="font-family: var(--thm-font);font-weight: normal;">Üye Ol</span></i></a>

                                </li>
                                <li> <a href="#girisYapModal" data-toggle="modal" > <i class="fa fa-lock"> <span style="font-family: var(--thm-font);font-weight: normal;">Giriş Yap</span></i> </a>
                                </li>
                            </ul>
                        </li>

                    <?php } ?>




                </ul>

                <div class="main-header__info">


                    <a href="tel:<?php echo $veri['tel']; ?>" class="main-header__info-phone">
                        <i class="agrikon-icon-phone-call"></i>
                        <span class="main-header__info-phone-content">
                            <span class="main-header__info-phone-text">Telefon</span>
                            <span class="main-header__info-phone-title"><?php echo $veri['tel']; ?></span>
                        </span>
                    </a>
                </div>
            </div>
        </nav>

    </header>
    <div class="stricky-header stricked-menu main-menu">
        <div class="sticky-header__content"></div>
    </div>
