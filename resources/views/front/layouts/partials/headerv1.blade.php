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
        <a class="support-header-ring" href="#"><img src="img/svgs/support.svg" alt="" /> <span>support team</span></a>
    </div>
    @include('front.layouts.partials.nav')

    <main class="inner cover header-heeadline-title mb-auto">
        <h5><span class="blok-on-phon">About Us</span></h5>
        <p>We are in the business since 2018</p>
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb not-index-breadcrumb-header justify-content-center">
                    <li class="breadcrumb-item"><a href="#">Homepage</a></li>
                    <li class="breadcrumb-item"><a href="#">company</a></li>
                    <li class="breadcrumb-item active" aria-current="page">about us</li>
                </ol>
            </nav>
        </div>
    </main>
    <div class="mt-auto"></div>
</div>