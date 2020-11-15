<?php

namespace App\Repositories;

use App\Models\Room;
use App\Repositories\Interfaces\RoomRepositoryInterface;

class RoomRepository implements RoomRepositoryInterface
{
    protected $model;
    
    /*
     * 
     */
    public function __construct(Room $model)
    {
        $this->model = $model;
    }
    
    /*
     * 
     */
    public function all()
    {
        return $this->model->all();
    }
    
}