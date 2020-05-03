<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['day', 'breakfast_menu_id', 'type', 'lunch_menu_id_one', 'lunch_menu_id_two'];
}
