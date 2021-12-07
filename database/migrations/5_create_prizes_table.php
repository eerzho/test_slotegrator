<?php

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Blueprint;

Manager::schema()->create('prizes', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('user_id');
    $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
    $table->string('target_class');
    $table->unsignedBigInteger('target_id');
    $table->integer('count')->default(1);
    $table->boolean('is_received')->default(false);
    $table->timestamps();
});