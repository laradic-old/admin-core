@extends('laradic/admin::layouts.default')


@section('page-title')
    Attributes
@stop

{{-- Content --}}
@section('content')

    <div class="row">
        <div class="col-md-12">
            @partial('theme::partials.box')
                @block('icon-class', 'fa fa-puzzle-piece')
                @block('title', 'Attributes')
                @block('actions')
                    <a class='btn btn-primary' href="{{ route('sentinel.users.create') }}">Create Attribute</a>
                @endblock
                @block('section-class', 'box-table')
                @block('body')
                    <table class="table table-hover table-condensed table-striped table-light">
                        <thead>
                        <tr>
                            <th>Attribute</th>
                            <th>Status</th>
                            <th width="300" class="text-right">Options</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                @endblock
            @endpartial
        </div>

    </div>


@stop
