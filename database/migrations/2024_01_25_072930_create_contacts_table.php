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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table -> string("first_name", 20)->nullable(false);
            $table -> string("last_name", 20)->nullable();
            $table -> string("email", 50)->nullable(false);
            $table -> string("phone", 12)->nullable(false);
            $table -> unsignedBigInteger("user_id")->nullable(false);
            $table->timestamps();

            $table -> foreign("user_id")->on("users")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
