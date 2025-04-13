<?php

class CopyDirectoryException extends Exception
{
    public function __construct()
    {
        parent::__construct('It\'s only possible to copy a single file, not a directory');
    }
}
