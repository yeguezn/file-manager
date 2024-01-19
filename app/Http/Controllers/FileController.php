<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class FileController extends Controller
{

    public function checkFileExists(String $path){
        $parent_directory = dirname($path);
        $all_files = Storage::allFiles($parent_directory);
        return in_array($path, $all_files);
    }

    /**
     * Store a newly created file in storage.
     */
    public function store(Request $request, String $path)
    {
        $available_mimes = "gif,jpg,jpeg,png,mp4,txt,pdf,docx";

        $min_file_size = 1; // 1 kilobyte

        // 1024 = 1 megabyte
        $max_file_size = 5 * 1024; // 5 megabytes
        
        $request->validate([
            "newFile" => [
                "file", 
                "required", 
                "mimes:$available_mimes",
                "min:$min_file_size", 
                "max:$max_file_size"
            ]
        ], 
        // Custom validation error message
        [
            "newFile.max" => "Your file must not be greater than 5MB"

        ]);

        $file = $request->file("newFile");
        $file_extension = $file->getClientOriginalExtension();
        $file_name = Str::random(20); //Generates a random string of 10 characters
        $file_name = "$file_name.$file_extension";

        $path = preg_replace("/-/", "/", $path);     

        Storage::putFileAs(
            $path,
            $file,
            $file_name
        );

        $path = preg_replace("/\//", "-", $path);
        return redirect("/" . $path);
    }

    /**
     * Remove the specified file from storage.
     */
    public function destroy(string $path)
    {
        $path = preg_replace("/-/", "/", $path);
        Storage::delete($path);
    }

    /**
     * Download the specified file from storage.
     */
    public function download(string $path)
    {
        $path = preg_replace("/-/", "/", $path);

        if(!$this->checkFileExists($path)){

            return Inertia::render("notFoundPage");

        }

        return Storage::download($path);
    }
}
