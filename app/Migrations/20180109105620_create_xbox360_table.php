<?php


use DealsWithGold\Migrations\Core\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateXbox360Table extends Migration
{
    public function up(){

        $this->schema->create('xbox360', function(Blueprint $table){

            $table->increments("id");
            $table->string("game_name", 250);
            $table->string("game_box_shot", 250)->nullable();
            $table->string("game_link", 250)->nullable();
            $table->string("game_data_click_name", 250)->nullable();
            $table->string("game_discount", 250)->nullable();
            $table->string("game_include", 250)->nullable();
            $table->string("game_exclude", 250)->nullable();
            $table->timestamps();

        });

    }

    public function down(){

        $this->schema->drop('xbox360');

    }
}
