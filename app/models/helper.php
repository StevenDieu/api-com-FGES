<?php

class helper {

    function deleteAndCreatDir($src) {
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
        mkdir($src);
    }

}
