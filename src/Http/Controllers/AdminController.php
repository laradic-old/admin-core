<?php namespace Laradic\Admin\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;


class AdminController extends Controller
{

    protected $app;


    public function __construct(Application $app)
    {
        $app->make('clockwork')->getTimeline()->addEvent('sdf', 'sdf', time(), time() * 1.1);
        $this->middleware('sentry.auth');
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {

        return view('home');
    }
}
