<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BookingRepositoryInterface;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;


class BookingRepository implements BookingRepositoryInterface
{
    protected $model;
    
    /*
     * 
     */
    public function __construct(Booking $model)
    {
        $this->model = $model;
    }
    
    /*
     * 
     */
    public function search($parameters, $paginate = 10)
    {
        $query = $this->model
            ->with('room')
            ->with('user');
        
        // Filter times
        if (!empty($parameters['start']) && !empty($parameters['end'])) {
            $query = $query->whereRaw('((? > start AND ? < end) OR (? > start AND ? < end) OR (start > ? AND end < ?))', [
                $parameters['start']->format('Y-m-d H:i:s'), 
                $parameters['start']->format('Y-m-d H:i:s'),
                $parameters['end']->format('Y-m-d H:i:s'),
                $parameters['end']->format('Y-m-d H:i:s'),
                $parameters['start']->format('Y-m-d H:i:s'),
                $parameters['end']->format('Y-m-d H:i:s'),
            ]);
            
        }
        
        // Filter room
        if (!empty($parameters['room'])) {
            $query = $query->where('room_id', $parameters['room']);
        }
        
        // Filter date
        if (!empty($parameters['date'])) {
            $query = $query->whereDate('start', $parameters['date']);
        }
        
        // Filter by logged in users bookings
        if (!empty($parameters['userBookings']) && $parameters['userBookings'] == 'true') {
            $query = $query->where('user_id', Auth::user()->id);
        }
                
        // Apply a sorting
        if (!empty($parameters['sortBy']) && !empty($parameters['sortDesc'])) {
            
            switch ($parameters['sortBy']) {
                case 'date':
                    $query = $query->orderBy('start', ($parameters['sortDesc']) ? 'desc' : 'asc');
                    break;
                case 'room':
                    $query = $query->join('rooms', 'bookings.room_id', '=', 'rooms.id')
                                    ->select('bookings.*', 'rooms.title as room_title')
                                    ->orderBy('room_title', ($parameters['sortDesc']) ? 'desc' : 'asc');
                    break;
                case 'user':
                    $query = $query->join('users', 'bookings.user_id', '=', 'users.id')
                                   ->select('bookings.*', 'users.name as user_name')
                                   ->orderBy('user_name', ($parameters['sortDesc']) ? 'desc' : 'asc');
                    break;
                case 'time':
                    $query = $query->selectRaw('bookings.*, DATE_FORMAT(start, \'%H%i\') as start_time')
                                   ->orderBy('start_time', ($parameters['sortDesc']) ? 'desc' : 'asc');
                    break;
                default:
                    
            }
        } else { 
            // Apply a default sort based on date
            $query = $query->orderBy('start', 'asc');
        }
               
        if ($paginate) {
            return $query->paginate($paginate);
        }
        
        return $query->get();
    }
    
}