<?php

namespace App\Traits;

trait FileUpload
{
    public function uploadFile($file, $path){
        $name = time().'-'.$file->getClientOriginalName();
        $file->move($path, $name);
        return $name;
    }
}
