<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('auto_version'))
{
    // TODO Check if this works properly
    function auto_version($file)
    {
        if (strpos($file, '/') !== 0 || !file_exists($_SERVER['DOCUMENT_ROOT'] . $file))
            return $file;

        $mtime = filemtime($_SERVER['DOCUMENT_ROOT'] . $file);
        return preg_replace('{\\.([^./]+)$}', ".$mtime.\$1", $file);
    }
}