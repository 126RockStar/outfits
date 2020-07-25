<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contests', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('title');
            $table->integer('category');
            $table->integer('sub_category');
            $table->longText('description');
            $table->string('participants');
            $table->longText('prize_description')->nullable();
            $table->string('file');
            $table->string('thumbnail');
            $table->string('file_type');
            $table->longText('post')->nullable();
            $table->integer('is_featured')->default(0);
            $table->integer('is_prize_featured')->default(0);
            $table->string('status')->default('open');
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
        Schema::dropIfExists('contests');
    }
}
