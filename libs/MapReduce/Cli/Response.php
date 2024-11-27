<?php
namespace MapReduce\Cli;


/**
* Object represents result of executing `hadoop fs` commands
*
*/
class Response implements \MapReduce\IResponse
{
    /** @var string Command which produced this response */
    public $command = '';
    /** @var int Command execution exit code */
    public $exitCode = 0;
    /** @var string STDOUT of executed command */
    public $stdout = '';
    /** @var string STDERR of executed command */
    public $stderr = '';
    /** @var \MapReduce\Exception Cached exception instance */
    protected $exception = null;


    /**
    * Check if command failed to execute
    *
    */
    public function hasError ()
    {
        return (bool)$this->stderr;
    }//function hasError()


    /**
    * Get exception depending on contents of $this->stderr
    *
    * @return null|\MapReduce\Exception
    */
    public function getException ()
    {
        //exception instance already created
        if ($this->exception)
        {
            return $this->exception;
        }

        //no errors
        if (!$this->hasError())
        {
            return null;
        }
        $this->exception = null;

        //just a notice
        if (
               stripos($this->stderr, ' NOTICE ') !== false
            || stripos($this->stderr, ' INFO ') !== false
        )
        {
            return null;
        }

        if (stripos($this->stderr, 'permission denied') !== false)
        {
            $this->exception = new \MapReduce\Exception\PermissionException($this->stderr, false);
        }
        elseif (stripos($this->stderr, 'file exists') !== false)
        {
            $this->exception = new \MapReduce\Exception\AlreadyExistsException($this->stderr, false);
        }
        elseif (stripos($this->stderr, 'no such file or directory') !== false)
        {
            $this->exception = new \MapReduce\Exception\NotFoundException($this->stderr, false);
        }
        elseif (stripos($this->stderr, 'directory is not empty') !== false)
        {
            $this->exception = new \MapReduce\Exception\NotEmptyException($this->stderr, false);
        }
        elseif (stripos($this->stderr, 'is not a directory') !== false)
        {
            $this->exception = new \MapReduce\Exception\IllegalArgumentException($this->stderr, false);
        }
        elseif (stripos($this->stderr, 'non-super user cannot') !== false)
        {
            $this->exception = new \MapReduce\Exception\PermissionException($this->stderr, false);
        }

        if (!$this->exception)
        {
            $this->exception = new \MapReduce\Exception($this->stderr, false);
        }

        return $this->exception;
    }//function getException()


}//class Response
