<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('companies', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->string('mobile');
        $table->string('latitude')->nullable();
        $table->string('longitude')->nullable();
        $table->string('registration_tax_number')->unique();
        $table->string('country_id');
        $table->string('state');
        $table->string('city');
        $table->boolean('is_approved')->default(false); // Admin approval status
        $table->string('password');
        $table->rememberToken();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('companies');
}

}
