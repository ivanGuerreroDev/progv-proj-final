<?php

namespace MapReduce;


/**
 * Abstract class for MapReduce utility implementations
 *
 */
abstract class MapReduceAbstract
{
    /** @var \MapReduce\FilesystemWrapper Wrapper for standart php filesystem functions */
    protected $localfs = null;
}//abstract MapReduceAbstract
