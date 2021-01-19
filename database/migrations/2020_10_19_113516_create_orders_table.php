<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')/*->onDelete('cascade')*/;
            //$table->string('pnr', 13);
            $table->set('status', [Config::get('constants.orders.ORDER_CREATED'), 
                                   Config::get('constants.kits.KIT_REGISTERED'),
                                   Config::get('constants.kits.KIT_DISPATCHED'),
                                   Config::get('constants.samples.SAMPLE_RECEIVED'),
                                   Config::get('constants.samples.SAMPLE_REGISTERED'),
                                   Config::get('constants.results.RESULT_RECEIVED')
                                  ]
                        )->default(Config::get('constants.orders.ORDER_CREATED'));
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
        Schema::dropIfExists('orders');
    }
}
