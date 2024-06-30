<?php

namespace Config\Traits;


Trait FilePath
{
    public function pathUploadFile():string
    {
        $path_parts = pathinfo('Path');
        return $path_parts['dirname'].'/'.$path_parts['basename'].'/uploads/';
    }
}