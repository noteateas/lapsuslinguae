<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_info_translation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_info_id')->references('id')->on('task_info');
            $table->string('intro');
            $table->longText('text');
            $table->foreignId('language_id')->default('2')->constrained()->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_info_translation');
    }
};
