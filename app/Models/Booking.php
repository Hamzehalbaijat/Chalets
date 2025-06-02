<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class Booking extends Model
// {
//     protected $fillable = ['chalet_id', 'user_id', 'start', 'end', 'total_price'];
//     use HasFactory;
//     public function user()
//     {
//         return $this->belongsTo(User::class);
//     }
//     public function chalet()
//     {
//         return $this->belongsTo(Chalet::class);
//     }

// }

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['chalet_id', 'user_id', 'start', 'end', 'total_price'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'start' => 'date',
        'end' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that made the booking.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the chalet that was booked.
     */
    public function chalet()
    {
        return $this->belongsTo(Chalet::class);
    }

    /**
     * Format the start date for display.
     *
     * @return string
     */
    public function getFormattedStartAttribute()
    {
        return $this->start ? $this->start->format('M d, Y') : 'N/A';
    }

    /**
     * Format the end date for display.
     *
     * @return string
     */
    public function getFormattedEndAttribute()
    {
        return $this->end ? $this->end->format('M d, Y') : 'N/A';
    }

    /**
     * Get the duration of the booking in days.
     *
     * @return int
     */
    public function getDurationAttribute()
    {
        if ($this->start && $this->end) {
            return $this->start->diffInDays($this->end);
        }
        return 0;
    }

    /**
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUpcoming($query)
    {
        return $query->where('start', '>=', Carbon::today());
    }

    /**
     * Scope a query to only include past bookings.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePast($query)
    {
        return $query->where('end', '<', Carbon::today());
    }
}