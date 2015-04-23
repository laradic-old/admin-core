@extends('theme::layout')

@section('site-name')
    Admin
@stop
@section('page-header.breadcrumbs')
    {!! Breadcrumbs::renderIfExists() !!}
@stop
@section('notifications')
    @parent
    @include('laradic/admin::partials.alerts')
@stop
@section('header-menu')
    @navigation('admin', 'theme::navigation.header-left')
    @navigation('admin-right', 'theme::navigation.header-right')
@stop


@section('footer-copyright')
    Laradic Admin &copy; {{ date("Y") }} <a href="http://radic.mit-license.org">Robin Radic</a> - <a href="http://radic.mit-license.org">MIT License</a>
@stop


@section('scripts.init')
    @parent
    <script>
        (function(){
            var packadic = (window.packadic = window.packadic || {});
            packadic.mergeConfig({
                requireJS: {
                    paths  : {
                        'laradic/admin': '{{ Asset::url('laradic/admin::') }}'
                    }
                }
            });
        }.call());
    </script>
@stop
