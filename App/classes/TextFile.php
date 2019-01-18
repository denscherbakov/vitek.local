<?php

class TextFile
{
    protected $path;

	/**
	 * TextFile constructor.
	 * @param $path
	 */
    public function __construct($path)
    {
        $this->path = $path;
    }

	/**
	 * @return array|bool
	 */
    public function getData()
    {
        return file($this->path, FILE_IGNORE_NEW_LINES);
    }
}