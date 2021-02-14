<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("mysql_auth")->create('account', function (Blueprint $table) {
            $table->integer("acc_id")->autoIncrement();
            $table->string("acc_nickname", 30);
            $table->string("acc_name", 30)->default("");
            $table->integer("acc_admin", 30)->default(0);
            $table->integer("game_acc_id");
            $table->string("o2_google_id", 126)->default('');
            $table->string("o2_discord_id", 126)->default('');
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
        Schema::dropIfExists('account');
    }
}
