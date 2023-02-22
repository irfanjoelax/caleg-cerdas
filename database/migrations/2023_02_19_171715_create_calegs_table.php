<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalegsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calegs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedTinyInteger('urutan');
            $table->char('province_id', 2)->nullable()->default(null);
            $table->char('regency_id', 4)->nullable()->default(null);
            $table->char('district_id', 7)->nullable()->default(null);
            $table->timestamps();

            $table->foreign('province_id')
                ->references('id')
                ->on('provinces')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('regency_id')
                ->references('id')
                ->on('regencies')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('district_id')
                ->references('id')
                ->on('districts')
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
        Schema::dropIfExists('calegs');
    }
}
