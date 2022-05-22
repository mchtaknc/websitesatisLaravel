@extends('front.layouts.page')

@section('content')
<div id="header" class="homepagetwostyle d-flex mx-auto flex-column not-index-header">
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
        <h5><span class="blok-on-phon">Hakkımızda</span></h5>
        <p>2018 Yılından Beri Sektörün İçindeyiz</p>

        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb not-index-breadcrumb-header justify-content-center">
                    <li class="breadcrumb-item"><a href="#">Anaysayfa</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Hakkımızda</li>
                </ol>
            </nav>
        </div>
    </main>
    <div class="mt-auto"></div>
</div>
<section class="padding-100-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center about-us-page-title">
                <h2 class="about-us-page-title-sub-title">We are an independent <br>strategic advertising agency.</h2>
                <p class="about-us-page-title-text"> is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
                    printer took a galley of type and scrambled it to make a type specimen book.</p>
            </div>
        </div>

    </div>
</section>


<section class="padding-40-0-100">
    <div class="container">
        <div class="row">
            <div class="col-md-6 row">
                <div class="col-md-6">
                    <div class="main-service-box mt-20 text-left">
                        <i class="fab fa-amazon-pay grandient-blue-text-color font-size-33"></i>
                        <a href="#">
                            <h4> Responsive </h4>
                        </a>
                        <p>Integer purus ipsum, auctor vitae posuere et, consectetur ac leo. Pellentesque sit amet risus
                            sagittis, fermentum ligula.</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="main-service-box mt-20 text-left">
                        <i class="fas fa-bug grandient-red-text-color font-size-33"></i>
                        <a href="#">
                            <h4> Responsive </h4>
                        </a>
                        <p>Integer purus ipsum, auctor vitae posuere et, consectetur ac leo. Pellentesque sit amet risus
                            sagittis, fermentum ligula.</p>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="main-service-box mt-20 text-left">
                        <i class="fas fa-database grandient-green-text-color font-size-33"></i>
                        <a href="#">
                            <h4> Responsive </h4>
                        </a>
                        <p>Integer purus ipsum, auctor vitae posuere et, consectetur ac leo. Pellentesque sit amet risus
                            sagittis, fermentum ligula.</p>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="main-service-box mt-20 text-left">
                        <i class="fab fa-expeditedssl grandient-yellow-text-color font-size-33"></i>
                        <a href="#">
                            <h4> Responsive </h4>
                        </a>
                        <p>Integer purus ipsum, auctor vitae posuere et, consectetur ac leo. Pellentesque sit amet risus
                            sagittis, fermentum ligula.</p>
                    </div>
                </div>

            </div>

            <div class="col-md-6 text-right no-display-phone">
                <div class="image-with-outer-border">
                    <img src="{{ asset('assets/front/img/demo/team.jpeg') }}" alt="" />
                </div>
            </div>
        </div>
    </div>
</section>

<section class="padding-40-0-100 gradient-bb-white">
    <div class="container">
        <h5 class="title-left-bold">Neden Bizi Seçmelisiniz ? <span>is simply dummy text of the printing and typesetting
                industry.<br> Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </span></h5>

        <div class="row mr-tp-70">
            <div class="col-md-3">
                <div class="container-features-about-us">
                    <div class="features-about-us-number">
                        <div class="bulb-bllue-number">1</div>
                    </div>
                    <div class="features-about-us-text">
                        <h5>Optimize Edilmiş Sistemler</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit placerat, porttitor tristique sem
                            luctus pharetra est sit amet nunc pulvinar ante dolor.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="container-features-about-us">
                    <div class="features-about-us-number">
                        <div class="bulb-bllue-number">2</div>
                    </div>
                    <div class="features-about-us-text">
                        <h5>Uygun Fiyat<br></h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit placerat, porttitor tristique sem
                            luctus pharetra est sit amet nunc pulvinar ante dolor.</p>
                    </div>
                </div>
            </div>


            <div class="col-md-3">
                <div class="container-features-about-us">
                    <div class="features-about-us-number">
                        <div class="bulb-bllue-number">3</div>
                    </div>
                    <div class="features-about-us-text">
                        <h5>Hızlı Destek</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit placerat, porttitor tristique sem
                            luctus pharetra est sit amet nunc pulvinar ante dolor.</p>
                    </div>
                </div>
            </div>


            <div class="col-md-3">
                <div class="container-features-about-us">
                    <div class="features-about-us-number">
                        <div class="bulb-bllue-number">4</div>
                    </div>
                    <div class="features-about-us-text">
                        <h5>Güvenilirlik</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit placerat, porttitor tristique sem
                            luctus pharetra est sit amet nunc pulvinar ante dolor.</p>
                    </div>
                </div>
            </div>


        </div>
    </div>
</section>
@endsection