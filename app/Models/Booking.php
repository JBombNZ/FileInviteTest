<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    
    /*
     *
     */
    protected $fillable = [
        'room_id',
        'user_id',
        'start',
        'end'
    ];
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'start',
        'end',
        'created_at',
        'updated_at',
    ];
    
    /*
     * 
     */
    public function room() {
        return $this->belongsTo(Room::class);
    }
    
    /*
     * 
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
