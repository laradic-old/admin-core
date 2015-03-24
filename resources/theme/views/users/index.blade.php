@extends('laradic/admin::layouts.default')


@section('page-title')
    Users & groups
@stop

{{-- Content --}}
@section('content')

    <div class="row">
        <div class="col-md-6">
            @partial('theme::partials.box')
                @block('icon-class', 'fa fa-users')
                @block('title', 'Users')
                @block('actions')
                    <a class='btn btn-primary' href="{{ route('sentinel.users.create') }}">Create User</a>
                @endblock
                @block('section-class', 'box-table')
                @block('body')
                    <table class="table table-hover table-condensed table-striped table-light">
                        <thead>
                        <tr>
                            <th>User</th>
                            <th>Status</th>
                            <th width="300" class="text-right">Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td><a href="{{ route('sentinel.users.show', [$user->hash]) }}">{{ $user->email }}</a></td>
                                <td>{{ $user->status }} </td>
                                <td class="text-right">
                                    <div class="btn-group btn-group-xs">
                                        <button class="btn btn-default" type="button" onClick="location.href='{{ route('sentinel.users.edit', array($user->hash)) }}'">Edit</button>
                                        @if ($user->status != 'Suspended')
                                            <button class="btn btn-default" type="button" onClick="location.href='{{ route('sentinel.users.suspend', array($user->hash)) }}'">Suspend</button>
                                        @else
                                            <button class="btn btn-default" type="button" onClick="location.href='{{ route('sentinel.users.unsuspend', array($user->hash)) }}'">Un-Suspend</button>
                                        @endif
                                        @if ($user->status != 'Banned')
                                            <button class="btn btn-default" type="button" onClick="location.href='{{ route('sentinel.users.ban', array($user->hash)) }}'">Ban</button>
                                        @else
                                            <button class="btn btn-default" type="button" onClick="location.href='{{ route('sentinel.users.unban', array($user->hash)) }}'">Un-Ban</button>
                                        @endif
                                        <button class="btn btn-default action_confirm" href="{{ route('sentinel.users.destroy', array($user->hash)) }}" data-token="{{ Session::getToken() }}" data-method="delete">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endblock
            @endpartial
        </div>
        <div class="col-md-6">
            @partial('theme::partials.box')
                @block('icon-class', 'fa fa-users')
                @block('title', 'Groups')
                @block('actions')
                    <a class='btn btn-primary' href="{{ route('sentinel.groups.create') }}">Create Group</a>
                @endblock
                @block('section-class', 'box-table')
                @block('body')
                    <table class="table table-hover table-condensed table-striped table-light">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Permissions</th>
                            <th width="200" class="text-right">Options</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($groups as $group)
                                <tr>
                                    <td><a href="{{ route('sentinel.groups.show', $group->hash) }}">{{ $group->name }}</a></td>
                                    <td>
                                        @set('permissions', $group->getPermissions())
                                        @set('keys', array_keys($permissions))
                                        @set('last_key', end($keys))
                                        @foreach ($permissions as $key => $value)
                                            {{ ucfirst($key) . ($key == $last_key ? '' : ', ') }}
                                        @endforeach
                                    </td>
                                    <td class="text-right">
                                        <div class="btn-group btn-group-xs">
                                            <button class="btn btn-default" onClick="location.href='{{ route('sentinel.groups.edit', [$group->hash]) }}'">Edit</button>
                                            <button data-toggle="confirmation" class="btn btn-default  {{ ($group->name == 'Admins') ? 'disabled' : '' }}" type="button" data-token="{{ csrf_token() }}" data-method="delete" href="{{ route('sentinel.groups.destroy', [$group->hash]) }}">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endblock
            @endpartial
        </div>
    </div>


@stop
