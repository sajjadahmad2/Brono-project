<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_permissions', function (Blueprint $table) {
            Schema::create('property_permissions', function (Blueprint $table) {
                $table->id();
                $table->string('column_name'); // Column name that the permission refers to
                $table->tinyInteger('editable')->default(1); // Indicates if the column is editable
                $table->unsignedBigInteger('company_id'); // Foreign key for the company
                $table->foreign('company_id')->references('id')->on('users')->onDelete('cascade'); // Reference to companies table
                $table->timestamps(); // Created at and updated at timestamps
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_permissions');
    }
}
