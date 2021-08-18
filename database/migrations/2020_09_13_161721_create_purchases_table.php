<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('service_id')->unsigned();
            $table->bigInteger('profile_id')->unsigned();
            $table->bigInteger('rating_id')->unsigned();

            $table->string('code', 20);
            $table->dateTimeTz('due_date');

            $table->boolean('seller_confirmation');
            $table->boolean('customer_confirmation');
            $table->boolean('status');

            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
            $table->foreign('rating_id')->references('id')->on('ratings')->onDelete('cascade');

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
        Schema::dropIfExists('purchases');
    }
}
