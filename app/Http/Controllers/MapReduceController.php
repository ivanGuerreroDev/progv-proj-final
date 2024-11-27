<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MapReduce\Cli as CliMapReduce;
use Hdfs\Cli as CliHdfs;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\Decision;

class MapReduceController extends Controller
{
    public function index(Request $request): View
    {
        return view('dataDebugger.index');
    }

    public function executeMapReduceApp(Request $request): JsonResponse
    {
        $inputHdfsFile = $request->input('inputHdfsFile');
        // validate if inputHdfsFile exists and is not empty
        if (empty($inputHdfsFile)) {
            return response()->json([
                "errors" => ["inputHdfsFile" => "inputHdfsFile is required"]
            ]);
        }
        $mapreduce = new CliMapReduce();
        $mapreduceAppPath = "C:\\Users\\rogue\\Documentos\\proyectos\\Universidad\\hadoop-mapreduce-apps\\build\\libs\\hadoop-apps-0.1.0.jar";
        $classesToExecute = [
            [
                "name" => "org.ivan.mapreduce.RemoveFirstColumn.Driver",
                "output" => "/tmp/outputCarpetilla"
            ],
            [
                "name" => "org.ivan.mapreduce.DepurarAudienciaColumn.DepurarAudienciaDriver",
                "output" => "/tmp/outputDepurarAudiencia"
            ],
            [
                "name" => "org.ivan.mapreduce.DepurarFechas.DepurarFechasDriver",
                "output" => "/tmp/outputDepurarFechas"
            ]
        ];
        $args = [];
        $errors = [];
        $results = [];
        foreach ($classesToExecute as $class) {
            $response = $mapreduce->execJarApplication($mapreduceAppPath, $class["name"], $inputHdfsFile, $class["output"], $args);
            if($response->hasError()){
                $exception = $response->getException();
                if($exception != null){
                    $errors[$class["name"]] = $exception;
                }
            } else {
                $results[$class["name"]] = $response->stdout;
            }
        }
        $hdfs = new CliHdfs();
        // get last output from hdfs to local laravel storage/public folder with timestamp
        $pathToSaveOutput = storage_path('app\\public');
        $filename = "output-".now()->timestamp.".csv";
        $hdfs->getFile("/tmp/outputDepurarFechas/part-r-00000", $pathToSaveOutput . "\\".$filename);
        $hdfs->rename("/tmp/outputDepurarFechas/part-r-00000", "/tmp/".$filename);
        // removeRecursive outputs folders
        $hdfs->deleteRecursive("/tmp/outputCarpetilla");
        $hdfs->deleteRecursive("/tmp/outputDepurarAudiencia");
        $hdfs->deleteRecursive("/tmp/outputDepurarFechas");
        $publicUrl = asset('storage');

        return response()->json([
            "errors" => $errors,
            "results" => $results,
            "output" => "/tmp/".$filename,
        ]);

    }

    public function saveMapReduceOutput(Request $request)
    {
        $output = $request->input('outputHdfsFile');
        $hdfs = new CliHdfs();
        $tmpFileName = 'output-'.now()->timestamp.'.csv';
        $tmpPath = storage_path('app\\temp\\'.$tmpFileName);
        $hdfs->getFile($output, $tmpPath);
        $file = fopen($tmpPath, 'r');
        $header = fgetcsv($file, enclosure: '');
        while (($row = fgetcsv($file, enclosure: '')) !== false) {
            $decision = new Decision();
            $decision->fill(array_combine($header, $row));
            $decision->save();
        }
        fclose($file);
        return redirect()->route('dashboard');
    }


}
