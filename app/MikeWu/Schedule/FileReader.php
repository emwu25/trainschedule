<?php
/**
 * Created by PhpStorm.
 * User: punker
 * Date: 9/2/14
 * Time: 11:29 PM
 */

namespace MikeWu\Schedule;


class FileReader {

    public static function readFile($path) {
        $file_lines = file($path,FILE_IGNORE_NEW_LINES);
        return $file_lines;
    }

} 