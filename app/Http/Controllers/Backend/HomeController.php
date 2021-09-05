<?php


namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use App\Repositories\ReportRepository;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
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
        return view('backend.home.index');
    }
}
