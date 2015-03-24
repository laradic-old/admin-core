<?php namespace Laradic\Admin\Http\Controllers;

use Vinkla\Hashids\HashidsManager;
use Sentinel\Controllers\RegistrationController as BaseController;
use Sentinel\FormRequests\RegisterRequest;
use Sentinel\FormRequests\EmailRequest;
use Sentinel\FormRequests\ResetPasswordRequest;
use Sentinel\Repositories\Group\SentinelGroupRepositoryInterface;
use Sentinel\Repositories\User\SentinelUserRepositoryInterface;
use Sentinel\Traits\SentinelRedirectionTrait;
use Sentinel\Traits\SentinelViewfinderTrait;
use Sentry, View, Input, Event, Redirect, Session, Config;


class RegistrationController extends BaseController
{


    /**
     * Show the registration form, if registration is allowed
     *
     * @return Response
     */
    public function registration()
    {
        // Is this user already signed in? If so redirect to the post login route
        if (Sentry::check()) {
            return $this->redirectTo('session_store');
        }

        //If registration is currently disabled, show a message and redirect home.
        if ( ! config('sentinel.registration', false)) {
            return $this->redirectTo(['route' => 'home'], ['error' => trans('Sentinel::users.inactive_reg')]);
        }

        // All clear - show the registration form.
        return View::make('laradic/admin::users.register');
    }


    /**
     * Show the 'Resend Activation' form
     *
     * @return View
     */
    function resendActivationForm()
    {
        return View::make('laradic/admin::users.resend');
    }

    /**
     * Process resend activation request
     * @return Response
     */
    public function resendActivation(EmailRequest $request)
    {
        // Resend the activation email
        $result = $this->userRepository->resend(['email' => e(Input::get('email'))]);

        // It worked!  Use config to determine where we should go.
        return $this->redirectViaResponse('registration_resend', $result);
    }

    /**
     * Display the "Forgot Password" form
     *
     * @return \Illuminate\View\View
     */
    public function forgotPasswordForm()
    {
        return View::make('laradic/admin::users.forgot');
    }



    /**
     * A user is attempting to reset their password
     *
     * @param $id
     * @param $code
     *
     * @return Redirect|View
     */
    public function passwordResetForm($hash, $code)
    {
        // Decode the hashid
        $id = $this->hashids->decode($hash)[0];

        // Validate Reset Code
        $result = $this->userRepository->validateResetCode($id, $code);

        if (! $result->isSuccessful())
        {
            return $this->redirectViaResponse('registration_reset_invalid', $result);
        }

        return View::make('laradic/admin::users.reset')->with([
            'hash' => $hash,
            'code' => $code
        ]);
    }



}


