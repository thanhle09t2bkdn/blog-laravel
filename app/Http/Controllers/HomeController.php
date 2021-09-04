<?php


namespace App\Http\Controllers;


use App\Repositories\ReportRepository;
use App\Repositories\UserRepository;
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
        return view('home.index');
    }
}
