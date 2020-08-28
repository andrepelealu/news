@extends('Admins::Admin.layouts.dashboard')

@section('moduleTitle')
   Update {{ config('news.name', 'News') }} Category
@stop

@section('content')

    <div class="module-header">
        <div class="row align-middle">
            <div class="small-12 columns">
                <p class="module-title">  Update {{ config('news.name', 'News') }} Category </p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="small-12 columns">
            {!! Form::model($newscategory, ['route' => ['mc-admin.' . config('newscategories.slug', 'newscategories') . '.update', $newscategory->id], 'method' => 'PUT']) !!}
                @include('NewsCategories::Admin.form', ['submit' => 'Save Category'])
            {!! Form::close() !!}
         </div>
    </div>

@stop