<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRelationships extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wallet', function($table) {
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');;
        });

        Schema::table('transaction', function($table) {
            $table->foreign('wallet_id')->references('id')->on('wallet')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wallet', function($table) {
            $table->dropForeign('user_id');
        });

        Schema::table('transaction', function($table) {
            $table->dropForeign('wallet_id');
        });
    }
}
