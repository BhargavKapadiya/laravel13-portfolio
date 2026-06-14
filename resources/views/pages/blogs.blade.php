@extends('layouts.app')

@section('title') Blog @endsection

@section('facebook_meta')
    <meta property="og:image" content="{{ Helper::assets('front-assets/images/LatestNews.jpg') }}" />
    <meta property="og:description" content="Check out the latest news from Eire Lottery. Read stories from our winners and also how you have helped amazing causes across Ireland." />
@endsection

@section('breadcrumb')
    <div class="row page-title align-items-center">
        <div class="col-sm-6 col-xl-6">
            <h4 class="mb-1 mt-0 font-weight-medium">Blog</h4>
        </div>
    </div>
@endsection

@section('content')
    <section class="news mt-2 mb-4">
        @if(isset($blogs) && !empty($blogs) && $blogs->count())
            <div class="row">
                @foreach ($blogs as $blog)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card card-shadow">
                            <img class="card-img" src="{{ $blog->image_url }}" alt="Image">
                            <div class="card-body py-4">
                                <h4 class="card-title text-left">{{ $blog->title }}</h4>
                                <p class="card-text text-left ellipsis-two-line">{!! strip_tags(substr($blog->description,0,200)) !!}</p>
                                <a href="{{ route('blogs', ['slug' => $blog->slug]) }}" class="text-primary">Read more</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div> {{ $blogs->onEachSide(1)->links() }}</div>
        @else
            <div class="no-items text-center">No blogs found</div>
        @endif
    </section>
    <div class="clearfix"></div>
@endsection
