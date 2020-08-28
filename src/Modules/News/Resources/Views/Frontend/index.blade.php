@extends('Pages::Frontend.layouts.default')

@section('metaTitle', $page->present()->getMetaTitle)
@section('metaDescription', $page->present()->getMetaDescription)
@section('metaCanonical', $page->present()->getMetaCanonical)

@section('content')

    <div class="header-container">
        <div class="row">
            <div class="small-12 large-8 columns">
                <h1>{{ $page->present()->getTitle }}</h1>
                <h2>{{ $page->present()->getSubtitle }}</h2>
                <p>{{ $pagecontent->introduction }}</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="small-12 large-9 columns">
            {!! $pagecontent->content !!}
            <div id="news-articles-container">
                <div class="row small-up-1 medium-up-2">
                    @each('News::Frontend.partials.single-article', $articles, 'article')
                </div>
                @include('Pages::Frontend.partials.pagination', ['paginator' => $articles->appends(request()->except('pages'))])
            </div>
        </div>
        <div class="small-12 large-3 columns">
            @include('News::Frontend.partials.sidebar')
        </div>
    </div>

@stop
