<?php

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Blueprint;

Manager::schema()->create('monetaries', function (Blueprint $table) {
    $table->id();
    $table->integer('type')->unique();
    $table->integer('interval_from');
    $table->integer('interval_to');
    $table->integer('max_sum')->nullable();
    $table->timestamps();
});