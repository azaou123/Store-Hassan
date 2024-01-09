<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->text('description');
            $table->string('repPhotos');
            $table->decimal('oldPrice', 8, 2);
            $table->decimal('price', 8, 2);
            $table->integer('nbrAchats')->default(0);
            $table->unsignedBigInteger('id_categorie');
            $table->foreign('id_categorie')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produits');
    }
};
