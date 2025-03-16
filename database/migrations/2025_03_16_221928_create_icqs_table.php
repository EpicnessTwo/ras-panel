<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('icqs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->integer('name');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('icqs');
    }
};
