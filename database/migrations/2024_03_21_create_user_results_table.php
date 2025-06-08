<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('score_a')->default(0);
            $table->integer('score_b')->default(0);
            $table->integer('score_c')->default(0);
            $table->integer('score_d')->default(0);
            $table->integer('score_e')->default(0);
            $table->string('personality_type');
            $table->text('recommended_majors');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_results');
    }
}; 