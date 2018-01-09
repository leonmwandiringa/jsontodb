<?php

    namespace DealsWithGold\Models;
    use Illuminate\Database\Eloquent\Model;

    class Xbox360 extends Model{

        protected $table = "xbox360";

        protected $fillable = ['game_name', 'game_box_shot', 'game_link', 'game_data_click_name', 'game_discount', 'game_include', 'game_exclude'];


    }




?>