<?php namespace Laradic\Admin\Http\Controllers;

use Illuminate\Pagination\Paginator;
use Input;
use Sentinel\Controllers\GroupController as BaseController;
use View;

class GroupController extends BaseController
{

    /**
     * Display a paginated list of all current groups
     *
     * @return View
     */
    public function index()
    {
        // Paginate the existing users
        $groups      = $this->groupRepository->all();
        $perPage     = 15;
        $currentPage = Input::get('page') - 1;
        $pagedData   = array_slice($groups, $currentPage * $perPage, $perPage);
        $groups      = new Paginator($pagedData, $perPage, $currentPage);

        return View::make('laradic/admin::groups.index')->with(['groups' => $groups]);
    }

    /**
     * Show the form for creating a group
     *
     * @return View
     */
    public function create()
    {
        return View::make('laradic/admin::groups.create');
    }


    /**
     * Display the specified group
     *
     * @return View
     */
    public function show($hash)
    {
        // Decode the hashid
        $id = $this->hashids->decode($hash)[0];

        // Pull the group from storage
        $group = $this->groupRepository->retrieveById($id);

        return View::make('laradic/admin::groups.show')->with(['group' => $group]);
    }

    /**
     * Show the form for editing the specified group.
     *
     * @return View
     */
    public function edit($hash)
    {
        // Decode the hashid
        $id = $this->hashids->decode($hash)[0];

        // Pull the group from storage
        $group = $this->groupRepository->retrieveById($id);

        return View::make('laradic/admin::groups.edit')->with([
            'group'       => $group,
            'permissions' => $group->getPermissions()
        ]);
    }
}
