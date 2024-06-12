<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->id();
            $table->string('nopol');
            $table->string('jenis');
            $table->foreignId('id_kategori')->constrained('kategori')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('stnk');
            $table->timestamps();
            $table->foreignId('id_user')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('is_active', [1, 0])->default(true)->comment('0:false; 1:true');
            $table->softDeletes();
            $table->string('nipk',50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kendaraan');
    }
};