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
        Schema::create('user_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique('name');
            $table->string('status',1);
            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->comment('Usuario que cadastrou');
            $table->timestamps();
            $table->integer('deleted_id')->nullable()->comment('Usuario que excluiu');
            $table->softDeletes();
            $table->foreignId('user_type')->nullable()->constrained()->comment('Tipo do Usuario');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('cellphone',20)->nullable();
            $table->string('telephone',20)->nullable();
            $table->string('personal_id_primary',20)->nullable()->comment('CPF');
            $table->string('personal_id_secundary',20)->nullable()->comment('RG ou PASSAPORTE');
            $table->string('driver_id',20)->nullable()->comment('Carteira de motorista');
            $table->string('password')->nullable();
            $table->rememberToken();
        });

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
        
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('user_id')->constrained()->comment('Usuario que cadastrou');
            $table->string('address');
            $table->string('address_number',20)->nullable();
            $table->string('complement')->nullable();
            $table->string('state');
            $table->string('city');
            $table->string('cep');
            $table->string('observation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_types');
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('addresses');
    }
};
