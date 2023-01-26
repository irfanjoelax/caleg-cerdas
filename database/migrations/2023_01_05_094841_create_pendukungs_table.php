<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendukungsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendukungs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('usia');
            $table->enum('kelamin', ['PRIA', 'WANITA']);
            $table->string('phone', 20);
            $table->string('ktp');
            $table->foreignId('relawan_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->char('village_id', 10);
            $table->char('district_id', 7);
            $table->char('regency_id', 4);
            $table->char('province_id', 2);
            $table->timestamps();

            $table->foreign('village_id')
                ->references('id')
                ->on('villages')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('district_id')
                ->references('id')
                ->on('districts')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('regency_id')
                ->references('id')
                ->on('regencies')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('province_id')
                ->references('id')
                ->on('provinces')
                ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pendukungs');
    }
}
