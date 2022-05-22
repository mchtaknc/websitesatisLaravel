<div id="header" class="homepagetwostyle d-flex mx-auto flex-column not-index-headerv2" style="height: 609px;">
    <div class="header-animation">
        <div id="particles-bg"><canvas class="particles-js-canvas-el" width="1903" height="140"
                style="width: 100%; height: 100%;"></canvas></div>
        <div class="video-bg-nuhost-header">
            <div id="video_cover"></div>
            <video autoplay="" muted="" loop="" style="width: 1903px; height: 1070px;">
                <source src="{{ asset('assets/front/media/coodiv-vid.mp4') }}" type="video/mp4"></video>
            <span class="video-bg-nuhost-header-bg"></span>
        </div>
    </div>
    @include('front.layouts.partials.nav')
</div>