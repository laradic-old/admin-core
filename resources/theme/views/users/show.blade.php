@extends('laradic-admin/core::layouts.default')


@section('page-title')
    User profile
@stop

{{-- Content --}}
@section('content')

    @if(($user->email == Sentry::getUser()->email))
        @set('editAction', route('sentinel.profile.edit'))
    @else
        @set('editAction', route('sentinel.profile.edit', [$user->hash]))
    @endif

	<h4>Account Profile</h4>

  	<div class="row">
        <div class="col-md-6">
            @partial('theme::partials.box')
                @block('icon-class', 'fa fa-users')
                @block('title', 'Account Profile')
                @block('actions')
                    <button class="btn btn-primary" onClick="location.href='{{ $editAction }}'">Edit Profile</button>
                @endblock
                @block('body')
                    <div class="row">
                         <div class="col-md-8">
                            @if ($user->first_name)
                                         <p><strong>First Name:</strong> {{ $user->first_name }} </p>
                                     @endif
                                     @if ($user->last_name)
                                         <p><strong>Last Name:</strong> {{ $user->last_name }} </p>
                                     @endif
                                     <p><strong>Email:</strong> {{ $user->email }}</p>

                        </div>
                        <div class="col-md-4">
                            <p><em>Account created: {{ $user->created_at }}</em></p>
                            <p><em>Last Updated: {{ $user->updated_at }}</em></p>
                        </div>
                    </div>
                @endblock
            @endpartial
        </div>
	    <div class="col-md-6">
                    @set('userGroups', $user->getGroups())
            @partial('theme::partials.box')
                @block('icon-class', 'fa fa-users')
                @block('title', 'Group Memberships')
                @block('body')
                    <ul>
                        @if (count($userGroups) >= 1)
                            @foreach ($userGroups as $group)
                                <li>{{ $group['name'] }}</li>
                            @endforeach
                        @else
                            <li>No Group Memberships.</li>
                        @endif
                    </ul>
                @endblock
            @endpartial
        </div>
	</div>

@stop
