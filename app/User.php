<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\File; /*Also add this MediaLibrary class for definin collection */
use Spatie\MediaLibrary\Models\Media;/*for conversing media*/


class User extends Authenticatable implements HasMedia
{
    use Notifiable, HasMediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function registerMediaCollections()
    {
        $this->addMediaCollection('avatar')
        /* below two line are use for restriction of other images. it only use jpeg image.
        Only allow certain files in a collection*/
        ->acceptsFile(function (File $file) {
            return $file->mimeType === 'image/jpeg';
        })
/*below we have add code for Media Conversion*/
        ->registerMediaConversions(function (Media $media){
           $this->addMediaConversion('card')
           ->width(400)
           ->height(300);
           $this->addMediaConversion('thumb')
           ->width(100)
           ->height(100);
       });

    }

    protected $fillable = [
        'name', 'email', 'password',
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

    /*
    Below i add code for relationship between Model user->avatar_id with media->id
    */
    public function avatar()
    {
        //return $this->hasOne(Media::class, 'localkey','foriegn key');
        return $this->hasOne(Media::class, 'id','avatar_id');
    }
    /*
    get url with avatar thumb
    */
    public function getAvatarUrlAttribute()
    {
        //this is for profile pic at the top 
        return $this->avatar->getUrl('thumb');
    }
}
