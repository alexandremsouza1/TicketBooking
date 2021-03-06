<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'description',
        'address',
        'phone',
        'status',
        'station_id',
    ];

    protected $appends = [
        'rating',
        'first_image',
        'list_images',
        'latitude',
        'longitude',
    ];

    public function station() {
        return $this->belongsTo(Station::class);
    }

    public function userCompanies() {
        return $this->hasMany(UserCompany::class, 'company_id', 'id');
    }

    public function routes() {
        return $this->hasMany(Route::class);
    }

    public function buses() {
        return $this->hasMany(Bus::class);
    }

    public function ratings() {
        return $this->morphMany(Rating::class, 'ratingable');
    }

    public function images() {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getRatingAttribute()
    {
        $rating = $this->ratings();
        $count = $rating->count();

        if ($count) return $rating->sum('rating') / $count;
        
        return 0;
    }

    public function getFirstImageAttribute()
    {
        return $this->images->count() ? $this->images->first()->url : config('setting.image_company_default');
    }

    public function getListImagesAttribute()
    {
        return $this->images->count() ? $this->images : ['url' => config('setting.image_company_default')];
    }

    public function getLatitudeAttribute() {
        return $this->station->latitude;
    }

    public function getLongitudeAttribute() {
        return $this->station->longitude;
    }
}
