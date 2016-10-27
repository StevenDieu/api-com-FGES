<?php

class helper {
    
    function deleteFile($src){
        if(file_exists($src)){
            unlink($src);
        }
    }

    function deleteDir($src) {
        $this->deleteAndCreatDir($src, false);
    }

    function deleteAndCreatDir($src, $createDir = true) {
        if (file_exists($src)) {
            $dir = opendir($src);
            while (false !== ( $file = readdir($dir))) {
                if (( $file != '.' ) && ( $file != '..' )) {
                    $full = $src . '/' . $file;
                    if (is_dir($full)) {
                        rrmdir($full);
                    } else {
                        unlink($full);
                    }
                }
            }
            closedir($dir);
            rmdir($src);
        }
        if ($createDir) {
            mkdir($src);
        }
    }

    function createDir($src) {
        if (!file_exists($src)) {
            mkdir($src);
        }
    }

}
