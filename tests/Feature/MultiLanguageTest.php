<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class MultiLanguageTest extends TestCase
{
    use RefreshDatabase;

 public function test_multilanguage_support()
{
    // Default language redirect
    // $response = $this->get('/');
    // $response->assertRedirect('/en/'); 

    // English language route 
    $response = $this->get('/en/');
    $response->assertStatus(200);
    $this->assertEquals('en', App::getLocale());

    // Arabic language route
    $response = $this->get('/ar/');
    $response->assertStatus(200);
    $this->assertEquals('ar', App::getLocale());

    // Translation
    App::setLocale('en');
    $this->assertEquals('Home', __('auth.Home'));
    $this->assertEquals('Username', __('auth.Username'));
    $this->assertEquals('Register', __('auth.Register'));

    App::setLocale('ar');
    $this->assertEquals('الرئيسية', __('auth.Home'));
    $this->assertEquals('اسم المستخدم', __('auth.Username'));
    $this->assertEquals('التسجيل', __('auth.Register'));

    // available locales configuration
    $availableLocales = config('app.available_locales');
    $this->assertContains('en', $availableLocales);
    $this->assertContains('ar', $availableLocales);
    $this->assertCount(2, $availableLocales);

    // test middleware alias exists
    $middlewareAliases = app('router')->getMiddleware();
    $this->assertArrayHasKey('setapplang', $middlewareAliases);
}

   
    public function test_language_switching()
    {
        //switching from English to Arabic
        $response = $this->get('/en');
        $this->assertEquals('en', App::getLocale());

        $response = $this->get('/ar');
        $this->assertEquals('ar', App::getLocale());
    }

    
    public function test_critical_translations_exist()
    {
        $criticalKeys = [
            'Home', 'About', 'Reviews', 'Contact',
            'Username', 'Email', 'Password', 'Register',
            'Enter username', 'Enter email', 'Enter password'
        ];

        foreach (['en', 'ar'] as $locale) {
            App::setLocale($locale);
            
            foreach ($criticalKeys as $key) {
                $translation = __("auth.{$key}");
                $this->assertNotEquals("auth.{$key}", $translation, 
                    "Translation missing for key 'auth.{$key}' in locale '{$locale}'");
            }
        }
    }
}
