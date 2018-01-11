<?php


use DealsWithGold\Migrations\Core\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateXboxOneResourceTable extends Migration
{
    public function up(){

        $this->schema->create('x1resources', function(Blueprint $table){

            $table->increments("id");
            $table->string("game_name", 250)->nullable();
            $table->string("game_bigid", 250)->nullable();
            $table->string("game_aria_label", 250)->nullable();
            $table->string("game_data_click_name", 250)->nullable();
            $table->longText("game_box_art")->nullable();
            $table->string("game_discount", 250)->nullable();
            $table->string("game_include", 250)->nullable();
            $table->string("game_exclude", 250)->nullable();
            $table->timestamps();

        });

    }

    public function down(){

        $this->schema->drop('x1resources');

    }
}
