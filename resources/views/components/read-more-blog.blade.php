<div>
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
    @endif
</div>
