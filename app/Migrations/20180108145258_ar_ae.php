<?php


use DealsWithGold\Migrations\Core\Migration;
use Illuminate\Database\Schema\Blueprint;

class ArAe extends Migration
{
    public function up(){

        $this->schema->create('ar-ae', function(Blueprint $table){

            $table->increments("id");
            $table->string("game_name", 250);
            $table->string("game_bigid", 250);
            $table->string("game_link", 250);
            $table->string("game_data_click_name", 250);
            $table->string("game_include", 250);
            $table->string("game_exclude", 250);
            $table->timestamps();

        });

    }

    public function down(){

        $this->schema->drop('ar-ae');

    }
}
