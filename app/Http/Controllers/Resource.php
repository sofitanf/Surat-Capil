<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Resource extends Controller
{
    public function upload($request, $file, $data, $location)
    {
        if($request->input($file)){
            $file_data = $request->input($file); 
            $file_name = Str::random(10).'.pdf'; //generating unique file name; 
            @list($type, $file_data) = explode(';', $file_data);
            @list(, $file_data) = explode(',', $file_data); 
            if($file_data!=""){ // storing image in storage/app/public Folder 
                Storage::disk('public')->put($location.$file_name,base64_decode($file_data)); 
                $data->$file = $file_name;
                $data->save();
            }
        }
    }

    public function delete($request, $file, $location)
    {
        if($request->$file) {
            Storage::disk('public')->delete($location.$request->$file);
        }
    }
}
