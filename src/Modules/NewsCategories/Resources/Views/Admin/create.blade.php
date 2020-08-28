@extends('Admins::Admin.layouts.dashboard')

@section('moduleTitle')
    Create {{ config('news.name', 'News') }} Category
@stop

@section('content')

    <div class="module-header">
        <div class="row align-middle">
            <div class="small-12 columns">
                <p class="module-title"> Create {{ config('news.name', 'News') }} Category </p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="small-12 columns">
            {!! Form::open(['route' => 'mc-admin.' . config('newscategories.slug', 'newscategories') . '.store']) !!}
                @include('NewsCategories::Admin.form', ['submit' => 'Create Category'])
            {!! Form::close() !!}
        </div>
    </div>

@stop