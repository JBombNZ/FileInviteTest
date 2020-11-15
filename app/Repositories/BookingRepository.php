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
        $query = $this->model;
        
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
        if (!empty($parameters['sort'])) {
            
        }
               
        if ($paginate) {
            return $query->paginate($paginate);
        }
        
        return $query->get();
    }
    
}