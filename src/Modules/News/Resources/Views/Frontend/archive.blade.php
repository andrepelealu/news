@extends('Pages::Frontend.layouts.default')

@section('metaTitle', request()->route('month') . ' ' . request()->route('year') . ' ' . config('news.name', 'News') . ' Articles')
@section('metaDescription', 'Our articles from ' . request()->route('month') . ' ' . request()->route('year'))
@section('metaOther')
    <meta name="robots" content="noindex">
@stop

@section('content')

    <div class="header-container">
        <div class="row">
            <div class="small-12 medium-8 columns">
                <h1>{{ request()->route('month') }} {{ request()->route('year') }}</h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="small-12 large-9 columns">
            <div id="news-articles-container">
                <div class="row small-up-1 medium-up-2">
                    @each('News::Frontend.partials.single-article', $articles, 'article')
                </div>
            </div>
        </div>
        <div class="small-12 large-3 columns">
            @include('News::Frontend.partials.sidebar')
        </div>
    </div>

@stop
