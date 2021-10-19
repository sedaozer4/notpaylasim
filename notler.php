<?php include 'header.php';
?>




<style>
.blog-card__content {
    padding: 15px;

}

.blog-card__content h3 {
    margin: 5px 0;
}

.checked {
  color: orange;
}

.yildizlar{
    padding: 0;
    margin-bottom: 5px;
}
.blog-card__image>a {
    background-color: #2559466b!important;
}

.blog-card__image>a::before, .blog-card__image>a::after {
    width: 0;
    height: 0;
}



.ozelLink {
    color: #255946;
    margin: 0;
}
.ozelLink:hover {
    color: #f7c35f;
}

</style>





<section class="service-two">
    <div class="service-two__bottom-curv"></div>
    <div class="container">
        <div class="block-title text-center">
            <div class="block-title__image"></div>
            <p>Çeşitler</p>
            <h3>Not Çeşitlerimiz</h3>
        </div>

        <div class="row">
            <div class="col-md-9 col-lg-9">
                <div class="row">

                    <?php 

                    $veriCek=$conn->prepare("SELECT * FROM notler,firmalar,not_kategorileri WHERE
                      notler.not_firma_id = firmalar.firma_id AND 
                      notler.not_kategori_id = not_kategorileri.not_kat_id
                      ");
                    $veriCek->execute();
                    while ($rownot=$veriCek->fetch(PDO::FETCH_ASSOC)) {

                        $not_id = $rownot["not_id"];
                        $ortalamaVeri = $conn->query("SELECT AVG(yildiz) as ort FROM `yorumlar` WHERE yorum_not_id = '$not_id'")->fetch(PDO::FETCH_ASSOC);

                        $ort =  $ortalamaVeri['ort'];


                        ?>




                        <div class="col-md-4 col-lg-4">
                            <div class="blog-card">
                                <div class="blog-card__image notGorsel">
                                    <img src="<?php echo $rownot['resim']; ?>">
                                    <a href="<?=seo('not-'.$rownot["not_adi"]).'-'.$rownot["not_id"]?>"></a>
                                </div>
                                <div class="blog-card__content text-center">
                                    <h3><?php echo $rownot['not_adi']; ?></h3>

                                    <h6><a class="ozelLink" href="<?=seo('not-'.$rownot["not_adi"]).'-'.$rownot["not_id"]?>">Firma: <?php echo $rownot['firma_adi']; ?></a></h6>


                                    <h6><a class="ozelLink" href="<?=seo('not-'.$rownot["not_adi"]).'-'.$rownot["not_id"]?>">Kategori: <?php echo $rownot['kategori_adi']; ?></a></h6>


                                    <div class="yildizlar">


                                        <?php 
                                        if ($ort>0) {

                                            for ($i=1; $i <= intval($ort) ; $i++) { 
                                                echo ' <span class="fa fa-star checked"></span>';
                                            }

                                            if ($ort > intval($ort)) {
                                                echo '<span class="fa fa-star-half "></span>';
                                            }
                                        } else 
                                        {
                                            for ($j=0; $j < 5 ; $j++) { 
                                             echo ' <span class="fa fa-star"></span>';
                                         }
                                     }


                                     ?>




                                 </div>



                                 <a href="<?=seo('not-'.$rownot["not_adi"]).'-'.$rownot["not_id"]?>" class="thm-btn btn-block text-center">
                                    <i class="fa fa-search"></i>&nbsp;  İncele</a>




                                </div>
                            </div>
                        </div>


                    <?php  } ?>





                </div>

            </div>

            <div class="col-md-3 col-lg-3">

                <div class="blog-sidebar">

                    <div class="blog-sidebar__posts">
                        <h3>Kategoriler</h3>
                        <ul>

                            <?php 

                            $veriCekCat=$conn->prepare("SELECT * FROM not_kategorileri ");
                            $veriCekCat->execute();
                            while ($rowCat=$veriCekCat->fetch(PDO::FETCH_ASSOC)) {
                                $not_kategori_id = $rowCat['not_kat_id'];
                                $cesitSay = $conn->query("SELECT count(*) AS say FROM notler WHERE not_kategori_id = '$not_kategori_id' ")->fetch(PDO::FETCH_ASSOC);
                               ?>
                               <li>
                                <img style="height:78px;width:78px;object-fit: cover;" src="<?php echo $rowCat['kategori_resim']; ?>" alt="">
                                <span><i class="far fa-pencil-alt"></i> <?php echo $cesitSay['say']; ?> Çeşit
                                </span>
                                <h4><a href="<?=seo('kategori-'.$rowCat["kategori_adi"]).'-'.$rowCat["not_kat_id"]?>"><?php echo $rowCat['kategori_adi']; ?></a></h4>
                            </li>

                        <?php } ?>


                    </ul>
                </div>


            </div>

        </div>

    </div>


</div>
</section>








<?php include 'footer.php'; ?>