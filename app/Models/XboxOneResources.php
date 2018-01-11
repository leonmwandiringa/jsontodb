<?php

    namespace DealsWithGold\Models;
    use Illuminate\Database\Eloquent\Model;

    class XboxOneResources extends Model{

        protected $table = "x1resources";

        protected $fillable = ['game_name', 'game_bigid', 'game_aria_label', 'game_box_art', 'game_discount', 'game_include', 'game_exclude', 'game_data_click_name'];


    }




?>