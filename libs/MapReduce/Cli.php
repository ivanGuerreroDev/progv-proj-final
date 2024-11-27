<?php
namespace MapReduce;



/**
* MapReduce client implementation using CLI tool `hadoop jar`
*
*/
class Cli extends MapReduceAbstract
{
    /** @var \MapReduce\Cli\HadoopWrapper `hadoop jar` wrapper */
    protected $cli = null;


    /**
    * Constructor
    *
    * @param null|\Hdfs\FilesystemWrapper $localfs Wrapper for standart php filesystem functions
    * @param null|\Hdfs\Cli\HadoopWrapper $hadoopCli Wrapper for `hadoop fs` command
    */
    public function __construct (Cli\HadoopWrapper $hadoopCli = null, FilesystemWrapper $localfs = null)
    {
        $this->localfs = ($localfs ?: new FilesystemWrapper());
        $this->cli     = ($hadoopCli ?: new Cli\HadoopWrapper());
    }//function __construct()


    /**
    * Change wrapper for 'hadoop fs' command
    *
    * @param \Hdfs\Cli\HadoopWrapper $localfs
    */
    public function setHadoopWrapper (Cli\HadoopWrapper $cli)
    {
        $this->cli = $cli;
    }//function setHadoopWrapper()


    public function execJarApplication ($jarPath, $mainClass, $inputHdfFile, $outputHdfFile)
    {
        return $this->cli->exec($jarPath, $mainClass, $inputHdfFile, $outputHdfFile);
    }//function execJarApplication()




}//class Cli
