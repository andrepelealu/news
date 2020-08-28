@extends('Admins::Admin.layouts.dashboard')

@section('moduleTitle')
    {{ config('news.name', 'News') }} Categories
@stop

@section('content')

    <div class="module-header">
        <div class="row align-middle">
            <div class="small-12 medium-6 columns">
                <p class="module-title"> {{ config('news.name', 'News') }} Categories</p>
            </div>
            <div class="small-12 medium-6 columns">
                <ul class="button-list">
                    <li>
                        <a href="{{ route('mc-admin.' . config('news.slug', 'news') . '.index') }}" class="button primary">Back to all  {{ config('news.name', 'News') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('mc-admin.' . config('newscategories.slug', 'newscategories') . '.create') }}" class="button warning"> Create  {{ config('news.name', 'News') }} Category</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="small-12 columns">
            <div class="table-block">
                <div class="table-block-header">
                    @include('NewsCategories::Admin.sub-menu')
                </div>
                <div class="table-block-content">
                    <table class="data-table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Url (Slug)</th>
                            <th>Last Updated</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ($newscategories->count() > 0)
                            @foreach ($newscategories as $newscategory)
                                <tr>
                                    <td data-label="Name">
                                        @if($newscategory->trashed())
                                            {{ $newscategory->present()->getName }}
                                        @else
                                            <a href="{{ route('mc-admin.' . config('newscategories.slug', 'newscategories') . '.edit', $newscategory->id) }}">    {{ $newscategory->present()->getName }}</a>
                                        @endif
                                    </td>
                                    <td data-label="Status">{!! $newscategory->present()->getPublishedLabel !!}</td>
                                    <td data-label="Slug">{{ $newscategory->present()->getSlug }}</td>
                                    <td data-label="Updated At"><span class="secondary">{{ $newscategory->present()->getUpdatedAt }}</span></td>
                                    <td>
                                        @if($newscategory->trashed())
                                            <a href="{{ route('mc-admin.' . config('newscategories.slug', 'newscategories') . '.confirm-restore', $newscategory->id) }}" class="icon-button trigger-reveal success"><i class="far fa-sync-alt"></i></a>
                                        @else
                                            <a href="{{ route('mc-admin.' . config('newscategories.slug', 'newscategories') . '.edit', $newscategory->id) }}" class="icon-button info"><i class="far fa-edit"></i></a>
                                            <a href="{{ route('mc-admin.' . config('newscategories.slug', 'newscategories') . '.confirm-delete', $newscategory->id) }}" class="icon-button trigger-reveal alert"><i class="far  fa-trash-alt"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="no-results">
                                <td colspan="5" class="text-center">There are no {{ $filter }} categories available.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="small-12 text-right columns">
            @include('Admins::Admin.partials.pagination', ['paginator' => $newscategories->appends(request()->except('pages'))])
        </div>
    </div>

@stop