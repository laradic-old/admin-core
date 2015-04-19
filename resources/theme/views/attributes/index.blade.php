@extends('laradic/admin::layouts.default')


@section('page-title')
    Attributes
@stop


{{-- Content --}}
@section('content')

    <div class="row">
        <div class="col-md-6">
            @partial('theme::partials.box')
                @block('icon-class', 'fa fa-puzzle-piece')
                @block('title', 'Attributes')
                @block('actions')
                    <a class='btn btn-primary' href="{{ route('sentinel.users.create') }}">Create Attribute</a>
                @endblock
                @block('section-class', 'box-table')
                @block('body')
                    {{-- Debugger::dump($attributes) --}}
                    <table class="table table-hover table-condensed table-striped table-light">
                        <thead>
                        <tr>
                            <th width="20">ID</th>
                            <th>Slug</th>
                            <th>Label</th>
                            <th>Field type</th>
                            <th>Enabled</th>
                            <th width="300" class="text-right">Options</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($attributes as $attribute)
                                <tr>
                                    <td>{{ $attribute->id }}</td>
                                    <td>{{ $attribute->slug }}</td>
                                    <td>{{ $attribute->label }}</td>
                                    <td>{{ $attribute->field_type }}</td>
                                    <td>{{ (bool) $attribute->enabled == true ? 'Enabled' : 'Disabled' }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endblock
            @endpartial
        </div>
        <div class="col-md-6">
            @partial('theme::partials.box')
                @block('icon-class', 'fa fa-pencil')
                @block('title', 'Form preview')
                @block('actions')
                    <a class='btn btn-primary' href="{{ route('sentinel.users.create') }}">Create Attribute</a>
                @endblock
                @block('section-class', 'box-form')
                @block('body')
                    <form class="form-horizontal form-bordered" role="form">
                        <div class="form-group">
                          <label for="test-text" class="col-sm-3 control-label">Email</label>
                          <div class="col-sm-9">
                              {!! $fieldTypes->make('text')->setName('test-text')->render() !!}
                          </div>
                        </div>
                    </form>
                @endblock
            @endpartial
        </div>

    </div>


@stop
