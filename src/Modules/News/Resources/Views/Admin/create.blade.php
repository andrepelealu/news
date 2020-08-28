@extends('Admins::Admin.layouts.dashboard')

@section('moduleTitle')
    Create {{ config('news.name', 'News') }}
@stop

@section('content')

    <div class="module-header">
        <div class="row align-middle">
            <div class="small-12 columns">
                <p class="module-title"> Create {{ config('news.name', 'News') }} </p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="small-12 columns">
            {!! Form::open(['route' => 'mc-admin.' . config('news.slug', 'news') . '.store']) !!}
            @include('News::Admin.form', ['submit' => 'Create Article'])
            {!! Form::close() !!}
        </div>
    </div>

@stop

@section('scripts')
    @parent
    <script>
        $(function () {
            $("#title").stringToSlug({
                getPut: '#slug',
                setEvents: 'keyup'
            });
            $('.datepicker').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: 'DD/MM/YYYY'
                }
            });
        });
    </script>
@stop
