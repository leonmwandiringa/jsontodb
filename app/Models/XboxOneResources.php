<?php

    namespace DealsWithGold\Models;
    use Illuminate\Database\Eloquent\Model;

    class XboxOneResources extends Model{

        protected $table = "x1resources";

        protected $fillable = ['game_name', 'game_bigid', 'game_box_art'];


    }




?>