<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create the users table if it doesn't exist
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('full_name', 100);
                $table->string('username', 50)->unique();
                $table->string('phone', 15);
                $table->string('whatsapp_number', 15)->nullable();
                $table->text('address')->nullable();
                $table->string('email')->unique();
                $table->string('password');
                $table->string('user_image')->nullable();
                $table->timestamps();
            });
        } else {
            // Modify the existing users table
            Schema::table('users', function (Blueprint $table) {
                // Drop columns we don't need
                if (Schema::hasColumn('users', 'name')) {
                    $table->dropColumn('name');
                }
                if (Schema::hasColumn('users', 'email_verified_at')) {
                    $table->dropColumn('email_verified_at');
                }
                if (Schema::hasColumn('users', 'remember_token')) {
                    $table->dropColumn('remember_token');
                }

                // Add or modify columns
                if (!Schema::hasColumn('users', 'full_name')) {
                    $table->string('full_name', 100)->after('id');
                }
                if (!Schema::hasColumn('users', 'username')) {
                    $table->string('username', 50)->unique()->after('full_name');
                } else {
                    $table->string('username', 50)->unique()->change();
                }
                if (!Schema::hasColumn('users', 'phone')) {
                    $table->string('phone', 15)->after('username');
                }
                if (!Schema::hasColumn('users', 'whatsapp_number')) {
                    $table->string('whatsapp_number', 15)->nullable()->after('phone');
                }
                if (!Schema::hasColumn('users', 'address')) {
                    $table->text('address')->nullable()->after('whatsapp_number');
                }
                if (!Schema::hasColumn('users', 'user_image')) {
                    $table->string('user_image')->nullable()->after('password');
                }
            });
        }

        // Create other tables as before
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};