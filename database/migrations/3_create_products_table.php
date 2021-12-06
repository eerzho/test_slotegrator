<?php

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Blueprint;

Manager::schema()->create('products', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('description');
    $table->integer('count');
    $table->timestamps();
});