<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BusRoute extends Model
{
    protected $table = 'bus_route';

    protected $fillable = [
        'bus_id',
        'route_id',
        'price',
        'status',
    ];

    protected $appends = [
        'rating',
        'price_format',
        'route_tickets',
    ];

    public function getRouteTicketsAttribute()
    {
        return $this->tickets->where('status', config('setting.ticket.status.active'))->groupBy('date');
    }

    public function getPriceFormatAttribute()
    {
        return number_format($this->price, 2);
    }

    public function getRatingAttribute()
    {
        $ratings = $this->ratings();
        $count = $ratings->count();

        if ($count) return $ratings->sum('rating') / $count;
        
        return 0;
    }

    public function bus() {
        return $this->belongsTo(Bus::class);
    }

    public function route() {
        return $this->belongsTo(Route::class);
    }

    public function ratings() {
        return $this->morphMany(Rating::class, 'ratingable');
    }

    public function tickets() {
        return $this->hasMany(Ticket::class, 'bus_route_id');
    }
}
