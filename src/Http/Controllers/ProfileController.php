<?php namespace Laradic\Admin\Http\Controllers;

use View;
use Sentinel\Controllers\ProfileController as BaseController;
use Sentinel\FormRequests\ChangePasswordRequest;
use Sentinel\FormRequests\UserUpdateRequest;
use Session, Input, Response, Redirect;
use Sentinel\Repositories\Group\SentinelGroupRepositoryInterface;
use Sentinel\Repositories\User\SentinelUserRepositoryInterface;
use Sentinel\Traits\SentinelRedirectionTrait;
use Sentinel\Traits\SentinelViewfinderTrait;

class ProfileController extends BaseController
{



    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show()
    {
        // Get the user
        $user = $this->userRepository->retrieveById(Session::get('userId'));

        return View::make('laradic/admin::users.show')->with(['user' => $user]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function edit()
    {
        // Get the user
        $user = $this->userRepository->retrieveById(Session::get('userId'));

        // Get all available groups
        $groups = $this->groupRepository->all();

        return View::make('laradic/admin::users.edit')->with([
            'user' => $user,
            'groups' => $groups
        ]);
    }





}
