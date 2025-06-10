<?php

namespace Tests\Feature;

use App\Mail\NewUserRegistered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Support\Facades\Mail;

class RegistrationTest extends TestCase
{
    use RefreshDatabase; // Clears database after each test

    public function test_weak_password_rejection()
    {
        $response = $this->post('/register', [
            'password' => 'weak',
            'password_confirmation' => 'weak',
            '_token' => csrf_token()
        ]);

        $response->assertSessionHasErrors(['password']); 
    }
  public function test_registration_page_loads()
{
    $response = $this->get('/register');
    $response->assertStatus(200);
    $response->assertSee('get you enrolled today.', false); 
}
  

    
 

    
}