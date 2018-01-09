<?php


use DealsWithGold\Migrations\Core\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateXboxOneResourceTable extends Migration
{
    public function up(){

        $this->schema->create('x1resources', function(Blueprint $table){

            $table->increments("id");
            $table->string("game_name", 250);
            $table->string("game_bigid", 250);
            $table->string("game_box_art", 250)->nullable();
            $table->timestamps();

        });

    }

    public function down(){

        $this->schema->drop('x1resources');

    }
}
