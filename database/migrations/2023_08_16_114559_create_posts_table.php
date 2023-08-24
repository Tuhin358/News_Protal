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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
            $table->integer('dis_id');
            $table->integer('subdis_id')->nullable();
            $table->integer('user_id');
            $table->string('title_bd');
            $table->string('title_en');
            $table->string('image');
            $table->text('details_en')->nullable();
            $table->text('details_bn');
            $table->text('tags_en')->nullable();
            $table->text('tags_bn');
            $table->integer('headline')->nullable();
            $table->integer('first_section')->nullable();
            $table->integer('time_section_thumbnil')->nullable();
            $table->integer('bigthumbnail')->nullable();
            $table->string('post_date')->nullable();
            $table->string('post_month')->nullable();
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
        Schema::dropIfExists('posts');
    }
};
