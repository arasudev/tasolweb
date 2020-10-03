<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'gender', 'image', 'breakfast', 'lunch', 'team_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get menus detail.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'user_menus')->withPivot('count');
    }

    /**
     * Get breakfast menus detail.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function breakfast_menus()
    {
        return $this->belongsToMany(Menu::class, 'user_menus')->withPivot('count')->where('type', BREAKFAST_MENU);
    }

    /**
     * Get breakfast menus detail.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function breakfast_menu_for_next_day()
    {
        // TODO :: check with Anandhan
        $tomorrow = now()->addDay()->format('l');
        $menu = Menu::getTomorrowMenu($tomorrow);
        return $this->belongsToMany(Menu::class, 'user_menus')->withPivot('count')->where('menu_id', $menu->id);
    }

    /**
     * Get breakfast menus detail.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function lunch_menus()
    {
        return $this->belongsToMany(Menu::class, 'user_menus')->withPivot('count')->where('type', LUNCH_MENU);
    }

    /**
     * User belongs to a Team
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Get the user's photo.
     *
     * @param  string  $value
     * @return string
     */
    public function getPhotoAttribute($value)
    {
        if ($this->image) {
            return $value;
        } else {
            if ($this->gender == GENDER_MALE) {
                return asset('/assets/custom/user/male.webp');
            } else {
                return asset('/assets/custom/user/female.webp');
            }
        }
    }
}
