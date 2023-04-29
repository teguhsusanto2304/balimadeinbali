<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProofingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proofings', function (Blueprint $table) {
            $table->id();
            $table->datetime('proofing_at');
            $table->datetime('purpose_at')->nullable();
            $table->datetime('complete_at')->nullable();
            $table->integer('supplier_id');
            $table->integer('purchasing_order_id')->nullable();
            $table->string('path_image',100)->nullable();
            $table->string('description',100)->nullable();
            $table->integer('data_status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proofings');
    }
}
