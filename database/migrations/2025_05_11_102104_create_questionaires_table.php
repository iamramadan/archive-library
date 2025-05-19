<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionaires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author')->nullable()->references('id')->on('users')->onDelete('set null');
            $table->foreignId('system')->nullable()->references('id')->on('systems')->onDelete('cascade');
            $table->string('name');
            $table->string('goal')->nullable();
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
        Schema::dropIfExists('questionaires');
    }
};
