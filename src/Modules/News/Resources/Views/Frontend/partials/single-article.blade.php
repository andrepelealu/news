<div class="single-article columns column-block">
    <a href="{{ $article->present()->getSlug }}">
        <div class="row">
            <div class="small-12 columns">
                <img src="{{ ImageResizer::fit($article->feature_image, 400, 255) }}" alt="">
            </div>
            <div class="small-12 columns">
                <h2>{{ $article->present()->getTitle }}</h2>
                <div class="details-container">
                    {{--<p>@if($article->categories->count() > 0)Categories: <span>{{ implode(', ', $article->categories->pluck('name')->toArray()) }}</span>@endif</p>--}}
                </div>
                <div class="article-summary">
                    {!! $article->summary !!}
                </div>
                <div class="details-container">
                    <p>
                        <span>Posted: {{ $article->published_date->format('d/m/Y') }}</span>
                    </p>
                </div>
            </div>
        </div>
    </a>
</div>
