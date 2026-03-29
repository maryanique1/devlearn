<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('qcm_name', 50);
            $table->integer('chapter_completed')->default(0);
            $table->integer('total_chapters')->default(7);
            $table->integer('score_so_far')->default(0);
            $table->integer('total_so_far')->default(0);
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->unique(['user_id', 'qcm_name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progress');
    }
};
