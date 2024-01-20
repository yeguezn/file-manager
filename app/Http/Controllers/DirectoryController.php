<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class DirectoryController extends Controller
{
    /**
     * Display a listing of all directories.
     */
    public function index()
    {
        $all_files = Storage::files("public");
        $sub_directories = Storage::directories("public");
        $path = "public"; 

        $directory_content = array_merge($all_files, $sub_directories);
        $gitignore_index = array_search("public/.gitignore", $directory_content);

        /*It is not allowed that the user can see the .gitignore file,
        therefore it is deleted from the directory_content array*/  
        unset($directory_content[$gitignore_index]);
        
        return Inertia::render("index", [
            "directoryContent" => $directory_content,
            "path" => $path
        ]);
    }

    /**
     * Store a newly created directory.
     */
    public function store(Request $request, String $path)
    {
        $request->validate([
            "directoryName" => ["required", "regex:/^[a-zA-Z0-9]+$/"]
        ], 
        
        [
            "directoryName.regex" => "A directory name must have only letters or numbers" 

        ]);

        /*turn path from directory-subdirectory 
        into directory/subdirectory */
        $path = preg_replace("/-/", "/", $path);

        $new_directory = "$path/$request->directoryName";

        if ($this->directoryExists($new_directory)) {
            return back()->withErrors([
                "directoryName" => "A directory already exists with that name"
            ]);
        }

        Storage::makeDirectory($new_directory);

    }

    /**
     * Checks if the specified directory exists.
     */
    protected function directoryExists(String $path){

        $parent_directory = dirname($path);
        $all_directories = Storage::directories($parent_directory);
        return in_array($path, $all_directories);

    }

    /**
     * Display the specified directory.
     */
    public function show(string $path)
    {
        /*turn path from directory-subdirectory 
        into directory/subdirectory */
        $path = preg_replace("/-/", "/", $path);

        if (!$this->directoryExists($path)){
            return Inertia::render("notFoundPage");
        }

        $all_files = Storage::files($path);
        $sub_directories = Storage::directories($path);

        $directory_content = array_merge($all_files, $sub_directories);

        if($path == "public"){
            $gitignore_index = array_search("public/.gitignore", $directory_content);
            unset($directory_content[$gitignore_index]);
        }

        /*turn path from directory/subdirectory 
        into directory-subdirectory*/
        $path = preg_replace("/\//", "-", $path);

        return Inertia::render("index", [
            "directoryContent" => $directory_content,
            "path" => $path
        ]);
    }

    /**
     * Remove the specified diretory.
     */
    public function destroy(string $path)
    {
        /*it is not allowed to delete the public directory
        because it is folder where all files and directories
        created by the user are saved*/
        if ($path == "public") {
            return Inertia::render("notFoundPage");    
        }

        /*turn path from directory-subdirectory 
        into directory/subdirectory */
        $path = preg_replace("/-/", "/", $path);
        Storage::deleteDirectory($path);
    }

     /**
     * Redirect to parent folder of the specified directory.
     */
    public function parentDirectory(String $path){

        /*turn path from directory-subdirectory 
        into directory/subdirectory*/
        $path = preg_replace("/-/", "/", $path);
        $parent_directory = dirname($path);

        /*turn parent_directory from directory/subdirectory 
        into directory-subdirectory */
        $parent_directory = preg_replace("/\//", "-", $parent_directory);
        
        return redirect("/" . $parent_directory);
    }

    /**
     * Retrieve the specified directory if this exists.
     */
    public function searchDirectory(Request $request){

        $request->validate([
            "directoryPath" => ["required", "regex:/^[a-zA-Z0-9]+(\/[a-zA-Z0-9]+)*$/"]
        ],

        [
            "directoryPath" => "Your input must have this format: public/directory/..."
        ]);

        $directory_path = $request->directoryPath;

        if (!$this->directoryExists($directory_path)) {
            
            return back()->withErrors([
                "directoryPath" => "this directory doesn't exist. Rememeber your input must be like this: public/directory"
            ])
            ->onlyInput("directoryPath");
        }

        /*turn directory_path from directory/subdirectory 
        into directory-subdirectory */
        $directory_path = preg_replace("/\//", "-", $directory_path);

        return redirect("/" . $directory_path);

    }

}