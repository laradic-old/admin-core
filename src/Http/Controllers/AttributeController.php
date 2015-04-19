<?php namespace Laradic\Admin\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Laradic\Admin\Attributes\Attribute;


class AttributeController extends Controller
{
    /**
     * Show the application dashboard to the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fieldTypes = app('laradic.admin.fieldtypes');
        $attributes = Attribute::all();
        return view('laradic/admin::attributes.index', compact('fieldTypes', 'attributes'));
    }
}
