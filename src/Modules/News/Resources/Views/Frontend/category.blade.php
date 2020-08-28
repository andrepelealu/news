@extends('Pages::Frontend.layouts.default')

@section('metaTitle', $category->present()->getMetaTitle)
@section('metaDescription', $category->present()->getMetaDescription)
@section('metaCanonical', $category->present()->getMetCanonical)

@section('content')

    <div class="header-container">
        <div class="row">
            <div class="small-12 columns">
                <h1>{{ $category->present()->getName }}</h1>
                <h2>{{ $category->present()->getSubtitle }}</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="small-12 large-9 columns">
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
