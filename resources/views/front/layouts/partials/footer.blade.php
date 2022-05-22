<section class="footer-coodiv-thm pding-200">
    <!-- start footer section -->
    <div class="container">
        <!-- start container -->
        <div class="row justify-content-center">
            <!-- start row -->
            <div class="col-md-4">
                <!-- col -->
                <a class="footer-brand" href="#">
                    <img src="{{ asset('assets/front/img/header/logo.png') }}" alt="">
                </a>
                <a class="footer-contact-a-hm" href="tel:05444257679"><i class="fas fa-headphones"></i> 0544 425 76 79</a>
                <!-- phone nubmer -->
                <a class="footer-contact-a-hm" href="mailto:info@sitedeposu.com"><i class="fas fa-envelope"></i> info@sitedeposu.com</a> <!-- email -->
                <span class="footer-contact-a-hm"><i class="fas fa-map-marker-alt"></i> Büyükesat Mah. Koza 1 Cad. <br>Sev Apt. No:153/8 <br>Çankaya/ Ankara</span> <!-- address -->
            </div><!-- end col -->

            <div class="col-md-2 quiq-links-footer-mb-st">
                <!-- col -->
                <h5 class="footer-title-simple">Hızlı Bağlantılar</h5><!-- title -->
                <ul class="main-menu-footer-mn">
                    <li><a href="{{route('home')}}">Anasayfa</a></li><!-- link -->
                    <li><a href="#">Hakkımızda</a></li><!-- link -->
                    <li><a href="{{route('themes')}}">Temalar</a></li><!-- link -->
                    <li><a href="{{route('contact')}}">İletişim</a></li><!-- link -->
                </ul>
            </div><!-- end col -->

            <div class="col-md-2 quiq-links-footer-mb-st">
                <!-- col -->
                <h5 class="footer-title-simple">Kurumsal</h5><!-- title -->
                <ul class="main-menu-footer-mn">
                    <li><a href="#">Hakkımızda</a></li><!-- link -->
                    <li><a href="#">Banka Hesap Numaraları</a></li><!-- link -->
                    <li><a href="#">Mesafeli Satış Sözleşmesi</a></li><!-- link -->
                    <li><a href="#">Çerez Politikası</a></li><!-- link -->
                    <li><a href="#">Site Kullanım Koşulları</a></li><!-- link -->
                </ul>
            </div><!-- end col -->


            <div class="col-md-3 stay-in-tch-footer-mb-st">
                <!-- col -->
                <h5 class="footer-title-simple">İletişimde Kalın</h5><!-- title -->
                <form class="form-contain-home-subscribe">
                    <!-- subscribe form -->
                    <input type="email" id="email-subscribe" name="email-subscribe"
                        placeholder="lütfen eposta adresi girin." required>
                    <button type="submit"><i class="fas fa-paper-plane"></i></button>
                </form><!-- end subscribe form -->

                <div class="footer-social-links">
                    <!-- social icons -->
                    <a class="facebookcc" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="twittercc" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="instagramcc" href="#"><i class="fab fa-instagram"></i></a>
                </div><!-- end social icons -->
                <p class="copyright-footer-p">© {{ date('Y') }} Tüm Hakları Saklıdır.</p><!-- copyright text -->

            </div><!-- end col -->

        </div><!-- end row -->
    </div><!-- end container -->
</section>
