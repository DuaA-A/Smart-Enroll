<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewUserRegistered;

class SendEmailTest extends TestCase
{
    /**
     * A test to check if the email is sent.
     */
    public function test_email_is_sent_when_user_registers()
    {
    
        Mail::fake();

        
        $username = 'testuser';

        
        Mail::to('example@test.com')->send(new NewUserRegistered($username));

        
        Mail::assertSent(NewUserRegistered::class, function ($mail) use ($username) {
            return $mail->username === $username;
        });
    }
}
