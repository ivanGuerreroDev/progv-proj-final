<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Hdfs\Cli;

class FilesClusterController extends Controller
{
    public function list(Request $request): View
    {
        $hdfs = new Cli();
        $dir_arg = '/';
        $path_query = $request->query('path');
        if ($path_query) {
            $dir_arg = $path_query;
        }
        $action = $request->query('action');
        if($action == 'back'){
            $dir_arg = explode('/', $dir_arg);
            array_pop($dir_arg);
            $dir_arg = implode('/', $dir_arg);
        }
        $dir = $hdfs->readDir($dir_arg);

        $files = [];
        foreach ($dir as $file) {
            $fileArr = $file->toArray();
            $files[] = [
                'name' => $fileArr['name'],
                'size' => $fileArr['size'],
                'type' => $fileArr['type']
            ];
        }
        // return json response with files
        //return response()->json($files);
        return view('filesCluster.list', [
            'user' => $request->user(),
            'files' => []
        ]);
    }
}
