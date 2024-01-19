<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\DirectoryController;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
|--------------------------------------------------------------------------
| IMPORTANT
|--------------------------------------------------------------------------
|
| In order to access files or directories, in most cases you will need the
| path for any of these. But you cannot access the content of a directory or 
| managing a file using this format: public/subdirectory/... ; You will need to
| use the following ones:
|
| public-subdirectory --> to access the content of a directory.
| public-subdirectory-test.txt --> to manage any files with extensions
| gif,jpg,jpeg,png,mp4,txt,pdf,docx.
| 
| All the directories you create or files you upload will be saved within a folder
| called public and this folder is located in the following path: 
| files-app/storage/public
|
*/


/*
|-------------------------------------------------------------------
| Routes to manage files (upload, delete and download)
|-------------------------------------------------------------------
| In order to download, delete or uploading a file, all urls must have
| a parameter called path which contains the file's path and this
| must match the regex defined in the where clause.
|
| Examples:
| /upload-file/public-subdirectory
| /delete-file/public-subdirectory-test.txt
| /download-file/public-subdirectory-test.txt
|
*/
Route::controller(FileController::class)->group(function(){
    
    Route::post("/upload-file/{path}", "store")
    ->where("path", "^[a-zA-Z0-9]+(-[a-zA-Z0-9]+)*$")
    ->missing(function (){
        return Inertia::render("notFoundPage");
    });
    
    Route::delete("/delete-file/{path}", "destroy")
    ->where("path", "^[a-zA-Z0-9]+(-[a-zA-Z0-9]+)*-[a-zA-Z0-9]+\.[a-z0-9]+$")
    ->missing(function (){
        return Inertia::render("notFoundPage");
    });;

    Route::get("/download-file/{path}", "download")
    ->where("path", "^[a-zA-Z0-9]+(-[a-zA-Z0-9]+)*-[a-zA-Z0-9]+\.[a-z0-9]+$")
    ->missing(function (){
        return Inertia::render("notFoundPage");
    });
});

/*
|--------------------------------------------------------------------------
| Routes to manage directories (create, delete, search and display content)
|--------------------------------------------------------------------------
| In order to create, delete and display content of a directory, all urls 
| must have a parameter called path which contains the directory path 
| and this must match the regex defined in the where clause.
|
| Examples:
| /public-subdirectory --> display the content of a specified subdirectory
| /new-directory/public-subdirectory --> create a new subdirectory within of a specified subdirectory
| /parent-directory/public-subdirectory --> Go back to parent folder of a specified directory
| /delete-directory/public-subdirectory --> Delete a subdirectory
|
*/
Route::controller(DirectoryController::class)->group(function(){

    Route::get("/", "index");

    Route::get("/{path}", "show")
    ->where("path", "^[a-zA-Z0-9]+(-[a-zA-Z0-9]+)*$")
    ->missing(function (){
        return Inertia::render("notFoundPage");
    });
    
    Route::post("/new-directory/{path}", "store")
    ->where("path", "^[a-zA-Z0-9]+(-[a-zA-Z0-9]+)*$")
    ->missing(function (){
        return Inertia::render("notFoundPage");
    });
    
    Route::get("/parent-directory/{path}", "parentDirectory")
    ->where("path", "^[a-zA-Z0-9]+(-[a-zA-Z0-9]+)*$")
    ->missing(function (){
        return Inertia::render("notFoundPage");
    });

    Route::delete("/delete-directory/{path}", "destroy")
    ->where("path", "^[a-zA-Z0-9]+(-[a-zA-Z0-9]+)*$")
    ->missing(function (){
        return Inertia::render("notFoundPage");
    });

    Route::post("/search-directory", "searchDirectory");
});
