@extends('Pages::Frontend.layouts.default')

@section('metaTitle', $article->present()->getMetaTitle)
@section('metaDescription', $article->present()->getMetaDescription)
@section('metaCanonical', $article->present()->getMetaCanonical)

@section('content')

    <div class="header-container">
        <div class="row">
            <div class="small-12 columns">
                <h1>{{ $article->present()->getTitle }}</h1>
                <p>Posted: <span>{{ $article->published_date->format('d/m/Y') }}</span></p>
                @if($article->categories->count() > 0)
                    <p>Categories: <span>{{ implode(', ', $article->categories->pluck('name')->toArray()) }}</span></p>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="small-12 columns">
            <div id="news-article-container">
                {!! $article->present()->getContent !!}

                <div class="row">
                    <div class="small-12 large-6 columns">
                        <p>
                            <a href="{{ route(config('news.slug', 'news') . '.index') }}" class="return-button"><i class="fa fa-caret-left"></i>Return</a>
                        </p>
                    </div>
                    <div class="small-12 large-6 columns">
                        <div id="social-share-buttons">
                            <ul>
                                <li>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" id="facebook-button" class="js-social-share"><i class="fa fa-facebook-f"></i> Share</a>
                                </li>
                                <li>
                                    <a href="https://www.twitter.com/intent/tweet/?text=&url={{ url()->current() }}&via={{ $sitesettings->twitter_handle }}" id="twitter-button" class="js-social-share"><i class="fa fa-twitter"></i>Tweet</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="small-12 columns">
            <div class="previous-articles-container">
                <div class="row">
                    <div class="small-12 medium-6 large-12 columns">
                        @if($previousArticles->count() > 0)
                            <h3>Read more in the news</h3>
                            @each('News::Frontend.partials.single-article', $previousArticles, 'article')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('scripts')
    @parent
    <script>
        function windowPopup(url, width, height) {
            var left = (screen.width / 2) - (width / 2), top = (screen.height / 2) - (height / 2);
            window.open(url, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,width=" + width + ",height=" + height + ",top=" + top + ",left=" + left);
        }

        $(".js-social-share").on("click", function (e) {
            e.preventDefault();
            windowPopup($(this).attr("href"), 500, 300);
        });

        var jsSocialShares = document.querySelectorAll(".js-social-share");
        if (jsSocialShares) {
            [].forEach.call(jsSocialShares, function (anchor) {
                anchor.addEventListener("click", function (e) {
                    e.preventDefault();
                    windowPopup(this.href, 500, 300);
                });
            });
        }
    </script>
    <script>
        (function() {
            var data = {
            {
                "@context": "http://schema.org/",
                "@type": "BlogPosting",
                "articleBody": "{!! $article->present()->getContent !!}",
                "wordCount": "{{ str_word_count($article->present()->getContent) }}",
                "about": "{{ $article->present()->getSummary }}",
                "author": "{{ $article->author->present()->getFullName }}",
                "dateCreated": "{{ $article->created_at->toDateString() }}",
                "datePublished": "{{ $article->published_date->toDateString() }}",
                "headline": "{{ $article->present()->getTitle }}",
                "isAccessibleForFree": "true",
                "isFamilyFriendly": "true",
                "thumbnailUrl": "{{ frontendcdn($article->feature_image) }}"
            }
        }
            var script = document.createElement('script');
            script.type = "application/ld+json";
            script.innerHTML = JSON.stringify(data);
            document.getElementsByTagName('head')[0].appendChild(script);
        })(document);
    </script>
@stop
