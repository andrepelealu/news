@extends('Admins::Admin.layouts.dashboard')

@section('moduleTitle')
    {{ config('news.name', 'News') }}
@stop

@section('content')

    <div class="module-header">
        <div class="row align-middle">
            <div class="small-12 large-6 columns">
                <p class="module-title">{{ config('news.name', 'News') }}</p>
            </div>
            <div class="small-12 large-6 columns">
                <ul class="button-list">
                    <li>
                        <a href="{{ route('mc-admin.' . config('news.slug', 'news') . '.create') }}" class="button warning">Create {{ config('news.name', 'News') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('mc-admin.' . config('newscategories.slug', 'newscategories') . '.index') }}" class="button primary">Manage Categories</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="small-12 columns">
            <div class="table-block">
                <div class="table-block-header">
                    @include('News::Admin.sub-menu')
                </div>
                <div class="table-block-content">
                    <table class="data-table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Last Updated</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ($articles->count() > 0)
                            @foreach ($articles as $article)
                                <tr>
                                    <td data-label="Title">
                                        @if($article->trashed())
                                            {{ $article->present()->getTitle }}
                                        @else
                                            <a href="{{ route('mc-admin.' . config('news.slug', 'news') . '.edit', $article->id) }}">{{ $article->present()->getTitle }}</a>
                                        @endif
                                    </td>
                                    <td data-label="Status">{!! $article->present()->getPublishedLabel !!}</td>
                                    <td data-label="Last Updated">
                                        <span class="secondary">
                                            {{ $article->present()->getUpdatedAt }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($article->trashed())
                                            <a href="{{ route('mc-admin.' . config('news.slug', 'news') . '.confirm-restore', $article->id) }}" class="icon-button trigger-reveal success"><i class="far fa-sync-alt"></i></a>
                                        @else
                                            <a href="{{ route('mc-admin.' . config('news.slug', 'news') . '.edit', $article->id) }}" class="icon-button info"><i class="far fa-edit"></i></a>
                                            <a href="{{ route('mc-admin.' . config('news.slug', 'news') . '.confirm-delete', $article->id) }}" class="icon-button trigger-reveal alert"><i class="far fa-trash-alt"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="no-results">
                                <td colspan="5" class="text-center">There are no {{ $filter }} {{ config('news.name', 'news') }} available.</td>
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
            @include('Admins::Admin.partials.pagination', ['paginator' => $articles->appends(request()->except('pages'))])
        </div>
    </div>

@stop
@section('scripts')
    @parent
    <script>
        $('#news').select2({
            placeholder: 'Search {{ config('news.slug', 'news')}}..',
            minimumInputLength: 2,
            cache: true,
            language: {
                noResults: function () {
                    return 'No results';
                }
            },
            ajax: {
                url: '{{ route('mc-admin.' . config('news.slug', 'news') . '.search') }}',
                dataType: 'json',
                method: 'post',
                delay: 200,
                data: function (params) {
                    var query = {
                        terms: params.term,
                        type: 'public',
                        _token: '{{ csrf_token() }}'
                    };
                    return query;
                },
                processResults: function (data, params) {
                    return {
                        results: $.map(data, function (obj) {
                            return {id: obj.id, text: obj.value};
                        })
                    };
                }
            }
        });
        $('#news').on('select2:select', function (e) {
            var data = e.params.data;
            window.location = '/mc-admin/{{ route('mc-admin.' . config('news.slug', 'news') . '.search') }}/' + data.id + '/edit';
        });
    </script>
@stop