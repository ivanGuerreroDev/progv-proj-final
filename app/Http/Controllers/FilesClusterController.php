<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class FilesClusterController extends Controller
{
    public function list(Request $request): View
    {
        return view('filesCluster.list', [
            'user' => $request->user(),
            'files' => []
        ]);
    }
}
