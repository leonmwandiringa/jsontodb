<?php

    namespace DealsWithGold\Models;
    use Illuminate\Database\Eloquent\Model;

    class Xboxone extends Model{

        protected $table = "xboxone";

        protected $fillable = ['game_name', 'game_bigid', 'game_data_click_name', 'game_discount', 'game_include', 'game_exclude'];


    }




?>