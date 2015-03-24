<?php
 /**
 * Part of the Radic packages.
 */
namespace Laradic\Admin\Auth;

use Cartalyst\Sentry\Throttling\UserBannedException;
use Cartalyst\Sentry\Throttling\UserSuspendedException;
use Cartalyst\Sentry\Users\LoginRequiredException;
use Cartalyst\Sentry\Users\PasswordRequiredException;
use Cartalyst\Sentry\Users\UserNotActivatedException;
use Cartalyst\Sentry\Users\UserNotFoundException;
use Cartalyst\Sentry\Users\WrongPasswordException;
use Illuminate\Support\MessageBag;
use Laradic\Admin\Http\Requests\AuthRequest;

/**
 * Class AuthenticatesAdmins
 *
 * @package     Auth
 * @author      Robin Radic
 * @license     MIT
 * @copyright   2011-2015, Robin Radic
 * @link        http://radic.mit-license.org
 */
trait AuthenticatesAdmins
{

    /**
     * @var \Cartalyst\Sentry\Sentry
     */
    protected $sentry;

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(AuthRequest $request)
    {
        $r = $request;
        $this->validate($request, [
            'email' => 'required|email', 'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        $errors = new MessageBag();
        try
        {
            $this->sentry->authenticate($credentials, $request->has('remember'));
        }
        catch (LoginRequiredException $e)
        {
            $errors->add('email', 'Login field is required.');
        }
        catch (PasswordRequiredException $e)
        {
            $errors->add('password', 'Password field is required.');
        }
        catch (WrongPasswordException $e)
        {
            $errors->add('password', 'Wrong password, try again.');
        }
        catch (UserNotFoundException $e)
        {
            $errors->add('user', 'User was not found.');
        }
        catch (UserNotActivatedException $e)
        {
            $errors->add('user', 'User is not activated.');
        }
        catch (UserSuspendedException $e)
        {
            $errors->add('user', 'User is suspended.');
        }
        catch (UserBannedException $e)
        {
            $errors->add('user', 'User is banned.');
        }

        if ($errors->isEmpty())
        {
            return redirect()->intended($this->redirectPath());
        }

        return redirect()->toAdmin($this->loginPath())
            ->withInput($request->only('email', 'remember'))
            ->withErrors($errors);
    }

    /**
     * Get the failed login message.
     *
     * @return string
     */
    protected function getFailedLoginMessage()
    {
        return 'These credentials do not match our records.';
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        $this->sentry->logout();

        return redirect('/');
    }

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (property_exists($this, 'redirectPath'))
        {
            return $this->redirectPath;
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }

    /**
     * Get the path to the login route.
     *
     * @return string
     */
    public function loginPath()
    {
        return property_exists($this, 'loginPath') ? $this->loginPath : '/auth/login';
    }

}
