<?php
if(!function_exists('admin_url')){
    function admin_url($path, $extra = array(), $secure = false)
    {
        return app('url')->toAdmin($path, $extra, $secure);
    }
}


if ( ! function_exists('redirect'))
{
    /**
     * Get an instance of the redirector.
     *
     * @param  string|null  $to
     * @param  int     $status
     * @param  array   $headers
     * @param  bool    $secure
     * @return \Laradic\Admin\Routing\AdminRedirector|\Illuminate\Http\RedirectResponse
     */
    function redirect($to = null, $status = 302, $headers = array(), $secure = null)
    {
        if (is_null($to)) return app('redirect');

        return app('redirect')->to($to, $status, $headers, $secure);
    }
}
