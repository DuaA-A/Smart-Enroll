<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\User;
use App\Mail\NewUserRegistered;

class FeatureTest extends TestCase
{
    use RefreshDatabase;
    
    private const REGISTER_ROUTE = '/register';
    
    /** @test */
    public function user_can_view_registration_form()
    {
        $response = $this->get(self::REGISTER_ROUTE);
        $response->assertStatus(200);
        $response->assertSee('Register');
    }
    
    /** @test */
    public function user_can_register_with_valid_data()
    {
        Mail::fake();
        Storage::fake('public');
        
        $file = UploadedFile::fake()->image('avatar.jpg');
        
        $response = $this->post(self::REGISTER_ROUTE, [
            'full_name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@example.com',
            'password' => 'Test1234!',
            'password_confirmation' => 'Test1234!',
            'phone' => '01012345678',
            'whatsapp_number' => '+201234567890',
            'address' => '123 Test Street',
            'user_image' => $file,
        ]);
        
        $this->assertDatabaseHas('users', [
            'username' => 'testuser',
            'email' => 'test@example.com',
        ]);
        
        Storage::disk('public')->assertExists('uploads/' . $file->hashName());
        
        Mail::assertSent(NewUserRegistered::class, function ($mail) {
            return $mail->hasTo('mayahuma9@gmail.com');
        });
        
        $response->assertRedirectContains('/welcome/testuser');
    }
    
    /** @test */
    public function registration_fails_with_invalid_data()
    {
        $response = $this->post(self::REGISTER_ROUTE, [
            'full_name' => '',
            'username' => '',
            'email' => 'not-an-email',
            'password' => '123',
            'password_confirmation' => '456',
            'phone' => 'abc',
            'address' => '',
        ]);
        
        $response->assertSessionHasErrors([
            'full_name',
            'username',
            'email',
            'password',
            'phone',
            'address',
            'user_image',
        ]);
    }
    
    /** @test */
    public function username_must_be_unique()
    {
        User::factory()->create(['username' => 'takenname']);
        
        $response = $this->post('/check-username', ['username' => 'takenname']);
        $response->assertJson(['exists' => true]);
        
        $response = $this->post('/check-username', ['username' => 'newname']);
        $response->assertJson(['exists' => false]);
    }
    
    /** @test */
    public function email_must_be_unique()
    {
        User::factory()->create(['email' => 'used@example.com']);
        
        $response = $this->post('/check-email', ['email' => 'used@example.com']);
        $response->assertJson(['exists' => true]);
        
        $response = $this->post('/check-email', ['email' => 'new@example.com']);
        $response->assertJson(['exists' => false]);
    }
    
    /** @test */
    public function registered_user_can_view_welcome_page()
    {
        User::factory()->create(['username' => 'maya']);
        
        $response = $this->get('/welcome/maya');
        $response->assertStatus(200);
        $response->assertSee('maya');
    }
}
