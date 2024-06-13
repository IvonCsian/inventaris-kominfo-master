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
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kendaraan')->constrained('kendaraan')->cascadeOnDelete()->cascadeOnUpdate();            
            $table->string('nipl',50)->nullable();
            $table->string('nama');
            $table->date('tanggal');
            $table->string('isi');
            $table->string('foto');
            $table->foreignId('id_user')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('is_active', [1, 0])->default(true)->comment('0:false; 1:true');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan');
    }
};
