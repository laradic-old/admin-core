<?php namespace Laradic\Admin\Http\Controllers;

use Event;
use Illuminate\Pagination\Paginator;
use Input;
use Laradic\Admin\Attributes\Attribute;
use Redirect;
use Sentinel\Controllers\UserController as BaseController;
use Sentry;
use View;

class UserController extends BaseController
{

    protected function getGroups()
    {
        $groups      = $this->groupRepository->all();
        $perPage     = 15;
        $currentPage = Input::get('group_page') - 1;
        $pagedData   = array_slice($groups, $currentPage * $perPage, $perPage);
        $groups      = new Paginator($pagedData, $perPage, $currentPage, [
            'pageName' => 'group_page'
        ]);

        return $groups;
    }

    protected function getUsers()
    {
        $users       = $this->userRepository->all();
        $perPage     = 15;
        $currentPage = Input::get('users_page') - 1;
        $pagedData   = array_slice($users, $currentPage * $perPage, $perPage);
        $users       = new Paginator($pagedData, $perPage, $currentPage, [
            'pageName' => 'users_page'
        ]);

        return $users;
    }

    /**
     * Display a paginated index of all current users, with throttle data
     *
     * @return View
     */
    public function index()
    {
        $id = Sentry::getUser()->getId();
        $repo = app('Sentinel\Repositories\User\SentinelUserRepositoryInterface');
        $this->userRepository->getUser()->update([
            'id' => $id,
            'website' => 'asdf'
        ]);

        return View::make('laradic/admin::users.index')->with(['users' => $this->getUsers(), 'groups' => $this->getGroups()]);
    }


    /**
     * Show the "Create new User" form
     *
     * @return View
     */
    public function create()
    {
        return View::make('laradic/admin::users.create');
    }


    /**
     * Show the profile of a specific user account
     *
     * @param $id
     *
     * @return View
     */
    public function show($hash)
    {
        // Decode the hashid
        $id = $this->hashids->decode($hash)[0];

        // Get the user
        $user = $this->userRepository->retrieveById($id);

        return View::make('laradic/admin::users.show')->with(['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $hash
     *
     * @return Redirect
     */
    public function edit($hash)
    {
        // Decode the hashid
        $id = $this->hashids->decode($hash)[0];

        // Get the user
        $user = $this->userRepository->retrieveById($id);

        // Get all available groups
        $groups = $this->groupRepository->all();

        return View::make('laradic/admin::users.edit')->with([
            'user'   => $user,
            'groups' => $groups
        ]);
    }
}


