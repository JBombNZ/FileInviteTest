<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BookingRepositoryInterface;
use App\Models\Booking;


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
        
        // Filter start time
        if (!empty($parameters['start'])) {
            $query = $query->where('start', '>=', $parameters['start']);
        }
        
        // Filter end time
        if (!empty($parameters['end'])) {
            $query = $query->where('end', '<=', $parameters['end']);
        }
        
        // Filter room
        if (!empty($parameters['room'])) {
            $query = $query->where('room_id', $parameters['room']);
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
            
        }
               
        if ($paginate) {
            return $query->paginate($paginate);
        }
        
        return $query->get();
    }
    
}