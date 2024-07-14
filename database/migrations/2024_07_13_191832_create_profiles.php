<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('firstName',10);
            $table->string('lastName',10);
            $table->string('mobile',10);
            $table->string('city',10);
            $table->string('shippingAddress',1000);
            $table->string('email',50)->unique();

            //Relationship
            $table->foreign('email')->references('email')->on('users')
                ->restrictOnDelete()->cascadeOnUpdate(); //make 'email' column foreign key and connect with 'email' column of 'users' table.
                                                         //Relationship constraint restrictOnDelete(); means can't delete from parent table directly.
                                                         //Relationship constraint cascadeOnUpdate(); if table is updated others table should reflect the update
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
