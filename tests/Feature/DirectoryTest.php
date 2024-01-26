<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Inertia\Testing\AssertableInertia as Assert;

class DirectoryTest extends TestCase
{
    /**
     * A basic test to check if the main page is getting the props it needs.
     */
    public function test_index(): void
    {
        $this->withoutVite();

        $response=$this->get("/")
            ->assertInertia(
                fn (Assert $page) => $page
                    ->has("directoryContent")
                    ->has("path")
                    ->has("errors")

            );    
        
    }

    /**
     * A test to invalid the creation of a directory with an empty value 
     * when is submited to /new-directory endpoint .
     */
    public function test_new_directory_with_empty_value(): void
    {
        $this->withoutVite();

        $this->get("/");

        $this->followingRedirects()
            ->post("/new-directory/public", ["directoryName" => ""])
            ->assertInertia(
                fn (Assert $page) => $page
                    ->where("errors.directoryName", "The directory name field is required.")

            );    
        
    }

    /**
     * A test to invalid the creation of a directory with invalid characters (special characters) 
     * when is submited to /new-directory endpoint .
     */
    public function test_new_directory_with_invalid_name(): void
    {
        $this->withoutVite();

        $this->get("/new-directory/public");

        $this->followingRedirects()
            ->post("/new-directory/public", ["directoryName" => "¿¡{.3\$n_x!/"])
            ->assertInertia(
                fn (Assert $page) => $page
                    ->where(
                        "errors.directoryName", 
                        "A directory name must have only letters or numbers"
                    )

            );    
        
    }

}
