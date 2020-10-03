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
    protected $fillable = ['day', 'breakfast_menu_id', 'lunch_menu_id_one', 'lunch_menu_id_two'];

    /**
     * Menu belongs to setting
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function breakfast_menu()
    {
        return $this->belongsTo(Menu::class, 'breakfast_menu_id', 'id');
    }

    /**
     * Menu belongs to setting
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lunch_menu_one()
    {
        return $this->belongsTo(Menu::class, 'lunch_menu_id_one', 'id');
    }

    /**
     * Menu belongs to setting
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lunch_menu_two()
    {
        return $this->belongsTo(Menu::class, 'lunch_menu_id_two', 'id');
    }
}
