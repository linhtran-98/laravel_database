<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function __construct()
    {
        $pending = DB::table('products')->where('status', 'pending')->count();
        $approve = DB::table('products')->where('status', 'approve')->count();
        $reject = DB::table('products')->where('status', 'reject')->count();
        View::share(['pending' => $pending, 'approve' => $approve, 'reject' => $reject]);
    }
}
