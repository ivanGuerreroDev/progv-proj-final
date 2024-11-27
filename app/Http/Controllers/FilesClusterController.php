<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Support\Facades\Storage;

use Hdfs\Cli;

class FilesClusterController extends Controller
{
    public function list(Request $request): View
    {
        $hdfs = new Cli();
        $dir_arg = '/tmp';
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
            'route' => $dir_arg,
            'files' => $files
        ]);
    }

    public function download(Request $request): BinaryFileResponse
    {
        $hdfs = new Cli();
        // create temporal directory with php for save the file from hdfs and send it to the user
        $temp_dir = storage_path('app\temp');
        $file = $request->input('file');
        $path = $request->input('path');
        $hdfs->getFile($path.'\\'.$file, $temp_dir.'\\'.$file);
        $file_path = $temp_dir . '/' . $file;

        return response()->download($file_path)->deleteFileAfterSend(true);
    }

    public function delete(Request $request)
    {
        $hdfs = new Cli();
        $file = $request->query('file');
        $path = $request->query('path');
        $hdfs->deleteRecursive( $path . '/' . $file);
        return redirect()->route('filesCluster', ['path' => $path]);
    }

    public function upload(Request $request)
    {
        $hdfs = new Cli();
        // multipart form data request with file
        $file = $request->file('file');
        $path = $request->input('path');
        // save file in temporal directory laravel.
        $temp_dir = storage_path('app\temp');
        $file->move($temp_dir, $file->getClientOriginalName());
        // upload file to hdfs
        $hdfs->putFile( $temp_dir . '\\' . $file->getClientOriginalName(), $path . '/' . $file->getClientOriginalName());
        return redirect()->route('filesCluster', ['path' => $path]);
    }
}
