@extends('front.layouts.page')

@section('content')
@include('front.layouts.partials.headerv2')
<section class="padding-60-0-100">
    <div class="container blog-container-page">
        <div class="row justify-content-left mr-tp-60">
            <aside class="col-md-3 blog-sidebar">
                <div class="question-area-answer-navs">
                    <div class="nuhost-filter-list-container min-height-auto">
                        <h5 class="font-weight-bold pb-2" style="border-bottom: 1px solid #ddd">Kategoriler</h5>
                        <ul id="nuhost-filter-list">
                            <li><a href="{{ route('themes') }}" @if($categoryName === '') class="active" @endif>Tümü <i class="fas fa-angle-right"></i></a></li>
                            @foreach ($categories as $category)
                                <li><a href="{{ route('themes', ['kategori' => $category->slug]) }}" @if($categoryName === $category->slug) class="active" @endif>{{$category->name}} <i class="fas fa-angle-right"></i></a></li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </aside>
            <div class="col-md-9">
                <div class="row">
                    @forelse ($themes as $theme)
                        <div class="col-md-4">
                            <div class="themes">
                                <figure>
                                    @if($theme->image->where('featured',1)->first() != '')
                                        <img src="{{asset('storage/themes/'.$theme->image->where('featured',1)->first()['name'])}}">
                                    @elseif($theme->image->where('featured',0)->first() != '')
                                        <img src="{{asset('storage/themes/'.$theme->image->first()['name'])}}">
                                    @else
                                        <img src="{{asset('assets/front/img/unnamed.png')}}">
                                    @endif
                                </figure>
                                <a href="{{ route('theme',$theme->id) }}" class="image"></a>
                                <h6>{{ $theme->name }}</h6>
                            </div>
                        </div>
                        @empty
                        <div class="col-md-12">
                            <h5>Tema bulunamadı</h5>
                        </div>
                    @endforelse
                </div>
                {{$themes->withQueryString()->links('front.layouts.partials.pagination')}}
                {{--
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center pagination-nuhost">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1"><i class="fas fa-angle-left"></i></a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#"><i class="fas fa-angle-right"></i></a>
                            </li>
                        </ul>
                    </nav>
                --}}
            </div>
        </div>
    </div>
</section>
@endsection
