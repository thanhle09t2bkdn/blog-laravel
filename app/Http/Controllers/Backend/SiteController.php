<?php


namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;

class SiteController extends Controller
{

    /**
     * Constructor.
     *
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable|void
     */
    public function index()
    {
        return view('backend.sites.index');
    }
}
