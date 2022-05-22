@extends('front.layouts.page')

@section('content')
<div id="header" class="homepagetwostyle d-flex mx-auto flex-column">
    <div class="search-header-block">
        <form id="pitursrach-header" name="formsearch" method="get" action="404.html">
            <input name="s" id="search" type="text" class="text" value="" placeholder="Arama">
            <button type="submit" class="submit"><span class="fa fa-search"></span></button>
            <a class="closesrch-her-block np-dsp-block">
                <span class="first-stright"></span>
                <span class="second-stright"></span>
            </a>
        </form>
    </div>
    <div class="header-animation">
        <div id="particles-bg"></div>
        <div class="video-bg-nuhost-header">
            <div id="video_cover"></div>
            <video autoplay muted loop>
                <source src="{{ asset('assets/front/media/coodiv-vid.mp4') }}" type="video/mp4"></video>
            <span class="video-bg-nuhost-header-bg"></span>
        </div>
        <span class="courve-gb-hdr-top"></span>

    </div>
    @include('front.layouts.partials.nav')
    <main class="inner cover header-heeadline-title mb-auto">
        <div class="owl-carousel owl-theme main-header-slider">
            <div class="item">
                <h5><span class="blok-on-phon">Kolay, Kapsamlı<br></span> <span
                        id="typed"></span></h5>
                <p>Web sitenizin hızlı, güvenli ve her zaman çalışır durumda olmasını sağlıyoruz</p>
                <a class="header-order-button-slid" href="#packages">Web Siteni Kur</a>
            </div>
        </div>
    </main>
    <div class="mt-auto"></div>
</div>
<section class="first-items-home">
    <!-- section services -->
    <div class="container">
        <div class="row justify-content-left">
            <div class="col-md-4 item-icons">
                <!-- free badge -->
                <i class="icon fa fa-life-ring" style="padding: 13px 0px;"></i><!-- service icon -->
                <h5>Profesyonel Destek Ekibi</h5><!-- service title -->
                <p>Deneyimli ekibimizle sınırsız destek</p><!-- service text -->
                <!-- <div class="badje-link-footer"><a href="#">Daha Fazlası <i class="far fa-arrow-alt-circle-right"></i> </a></div> -->
                <!-- service link -->
            </div>
            <div class="col-md-4 item-icons">
                <i class="icon flaticon-063-flashlight"></i><!-- service icon -->
                <h5>Ekonomik Kurumsal Stiteler</h5>
                <p>Benzersiz Yenilikte modern tasarımlar ile firmanızda fark yaratın</p><!-- service text -->
                <!-- <div class="badje-link-footer"><a href="#">Daha Fazlası <i class="far fa-arrow-alt-circle-right"></i> </a></div> -->
                <!-- service link -->
            </div>
            <div class="col-md-4 item-icons">
                <i class="icon flaticon-browser-31"></i><!-- service icon -->
                <h5>Kolay Sİte Düzenleme Editörü</h5><!-- service title -->
                <p>Teknik bilgi gerektirmeden, kolaylıkla sitenizi düzenleyebileceğiniz editörler ve daha fazası...</p>
                <!-- service text -->
                <!-- <div class="badje-link-footer"><a href="#">Daha Fazlası <i class="far fa-arrow-alt-circle-right"></i> </a></div> -->
                <!-- service link -->
            </div>
        </div><!-- end row -->
    </div><!-- end container -->
</section>
<section class="second-items-home" id="packages">
    <div class="container">
        <div class="tittle-simple-one">
            <h5>En iyi fiyatlandırma planınızı seçin</h5>
        </div>
        <div class="mr-tp-70 mr-bt-50">
            <div class="row justify-content-start">
                @php
                $i = 0;
                @endphp
                @foreach ($packages as $package)
                @php
                $i++;
                @endphp
                <div class="col-md-4">
                    <!-- tree steps hosting plan -->
                    <div class="tree-steps-hosting-plans @if($i == 1)first @elseif($i == 2) second @else third @endif">
                        {{-- <span class="tree-steps-hosting-plans-best"></span> --}}
                        <div class="tree-steps-hosting-plans-header">
                            <i class="fas fa-fire tree-steps-hosting-plans-icon"></i>
                            <h5 class="tree-steps-hosting-plans-title">{{$package->name}}
                                <small>{{$package->description}}</small></h5>
                            <span class="tree-steps-hosting-plans-price yearly">
                                <b class="yearly">{{number_format($package->price)}} TL<small>/Yıl</small></b>
                            </span>
                        </div>
                        <div id="second-plan-hosting-steps-content" class="tree-steps-hosting-plans-body">
                            <div class="loader-tree-steps-hosting-plans-body">
                                <i class="fas fa-circle-notch rotate360icon"></i>
                            </div>
                            <ul class="tree-steps-hosting-plans-list">
                                @foreach (json_decode($package->specifications,1) as $item)
                                <li class="{{$item['status']}}">{{$item['value']}}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="tree-steps-hosting-plans-footer text-center">
                            <a href="{{ route('product.form', $package->id) }}"
                                class="tree-steps-hosting-plans-footer-btn first-step-hosting">
                                <span class="first-step-hosting-text">
                                    <small>SATIN AL</small>
                                    <i class="fas fa-angle-right"></i>
                                </span>
                            </a>
                            <a href="{{ route('themes', ['paket' => $package->id]) }}"
                                class="tree-steps-hosting-plans-footer-btn first-step-hosting">
                                <span class="first-step-hosting-text">
                                    <small>İNCELE</small>
                                    <i class="fas fa-angle-right"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div><!-- end container -->
</section>
<section class="form-contact-home-section home-content">
    <div class="container">
        <div class="row justify-content-center py-md-5">
            <div class="col-md-5">
                <img class="img-fluid" src="{{asset('assets/front/img/3adim-min.png')}}">
            </div>
            <div class="col-md-7 text-tab-content-algo">
                <div class="text-absoo">
                    <h5>Web Sitenizi Çok Fazla Vakit Harcamadan Oluşturun</h5><!-- title -->
                    <p>Size uygun paketlerimizden birini seçerek işlemlerinizi tamamlayabilir ve site panelinin kullanım
                        kolaylığı sayesinde sitenizi hızlıca yayına hazır hale getirebilirisiniz.</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center py-md-5">
            <div class="col-md-7 text-tab-content-algo">
                <div class="text-absoo">
                    <h5>Tüm Ekranlara %100 Duyarlı Tasarımlar</h5><!-- title -->
                    <p>Bilgisayar, tablet, telefon vb. tüm ekranlara duyarlı, pratik ve hızlı tasarımlar sayesinde sitenize her cihazdan kolay kullanım.</p><!-- text -->
                </div>
            </div>
            <div class="col-md-5">
                <img src="{{asset('assets/front/img/mobiluyumluluk-min.png')}}" class="img-fluid">
            </div>
        </div>
        <div class="row justify-content-center py-md-5">
            <div class="col-md-5">
                <img class="img-fluid" src="{{asset('assets/front/img/detek-min.png')}}">
            </div>
            <div class="col-md-7 text-tab-content-algo">
                <div class="text-absoo">
                    <h5>Seo Ayarları</h5><!-- title -->
                    <p>Web sitenizin Google ve diğer arama motorlarında üst sıralarda yer alabilmesi için gerekli ayarlar düzenlenmiş olarak teslim edilir. Ayrıca Facebook, Twitter meta etiketleri sayesinde aramalarda daha iyi bir sonuç alabilirsiniz.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="form-contact-home-section">
    <!-- start contact us section -->
    <div class="container">
        <!-- start container -->
        <div class="row justify-content-center">
            <!-- start row -->
            <form class="col-md-8 row justify-content-center form-contain-home" id="ajax-contact" method="post"
                action="mailer.php">
                <!-- start form -->
                <h5 style="width: 100%;">Detaylı Bilgi Almak İçin<span>Hemen İletişime Geçin</span></h5><!-- title -->

                <div id="form-messages"></div><!-- form message -->

                <div class="col-md-6">
                    <!-- start col -->
                    <div class="field input-field">
                        <input class="form-contain-home-input" type="text" id="name" name="name" required><!-- input -->
                        <span class="input-group-prepend">Ad-Soyad</span><!-- label -->
                    </div>
                    <div class="field input-field">
                        <input class="form-contain-home-input" type="text" id="name" name="name" required><!-- input -->
                        <span class="input-group-prepend">Telefon</span><!-- label -->
                    </div>
                </div><!-- end col -->

                <div class="col-md-6">
                    <!-- start col -->
                    <div class="field input-field">
                        <input class="form-contain-home-input" type="email" id="email" name="email" required>
                        <!-- input -->
                        <span class="input-group-prepend">E-Posta</span><!-- label -->
                    </div>
                    <div class="field input-field">
                        <input class="form-contain-home-input" type="text" id="name" name="name" required><!-- input -->
                        <span class="input-group-prepend">Konu</span><!-- label -->
                    </div>
                </div><!-- end col -->

                <div class="col-md-12">
                    <!-- start col -->
                    <div class="field input-field">
                        <textarea class="form-contain-home-input" id="message" name="message" required></textarea>
                        <!-- textarea -->
                        <span class="input-group-prepend">Mesaj</span><!-- label -->
                    </div>
                </div><!-- end col -->

                <div class="btn-holder-contect">
                    <button type="submit">Gönder</button><!-- submit button -->
                </div>
            </form><!-- end form -->

        </div><!-- end container -->
    </div><!-- end container -->
</section>
@endsection
