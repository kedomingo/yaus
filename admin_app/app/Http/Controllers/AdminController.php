<?php
declare(strict_types=1);

namespace App\Http\Controllers;

class AdminController extends Controller {

    public function getDashboard()
    {
        return view('admin.dashboard');
    }

}
