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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->boolean('is_publish')->default(0);
            $table->string('title');
            $table->text('blog');
            $table->string('slug');
            $table->dateTime('blog_date')->nullable();
            $table->string('blog_image')->nullable();
            $table->timestamps();
            $table->foreign('users_id')
            ->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
};
