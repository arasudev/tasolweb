<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class Menu extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'type', 'bill_type', 'price'];

    /**
     * Get users detail.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_menus')->withPivot('count');
    }

    /**
     * Return the Idly Object
     *
     * @return
     */
    public static function getIdly()
    {
        return self::whereSlug('idly')->first();
    }

    /**
     * Return the Chapati Object
     *
     * @return
     */
    public static function getChapati()
    {
        return self::whereSlug('chapati')->first();
    }

    /**
     * Return the Upma Object
     *
     * @return
     */
    public static function getUpma()
    {
        return self::whereSlug('upma')->first();
    }

    /**
     * Return the Boori Object
     *
     * @return
     */
    public static function getBoori()
    {
        return self::whereSlug('boori')->first();
    }

    /**
     * Return the Dosa Object
     *
     * @return
     */
    public static function getDosa()
    {
        return self::whereSlug('dosa')->first();
    }

    /**
     * Return the Rice Object
     *
     * @return
     */
    public static function getRice()
    {
        return self::whereSlug('rice')->first();
    }

    /**
     * Return the Tomorrow breakfast menu details of ordering before day night
     *
     * @param $day
     * @return \Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed
     */
    public static function getTomorrowMenu($day)
    {
        $setting = Setting::with('breakfast_menu')->where('day', $day)->first();
        return $setting->breakfast_menu;
    }

    /**
     * Return the Today's lunch menu details of ordering on current day's morning
     *
     * @param $day
     * @return \Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed
     */
    public static function getTodayLunchMenus($day)
    {
        $setting = Setting::with('lunch_menu_one', 'lunch_menu_two')->where('day', $day)->first();
        return [$setting->lunch_menu_one, $setting->lunch_menu_two];
    }
}
