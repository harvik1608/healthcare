<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('specialities', function (Blueprint $table) {
            $table->id(); // id (primary key)
            $table->string('name'); // speciality name
            $table->boolean('is_active')->default(true); // active/inactive
            $table->timestamps(); // created_at & updated_at
            $table->softDeletes(); // deleted_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('specialities');
    }
};
