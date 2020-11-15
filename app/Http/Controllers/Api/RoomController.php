<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\RoomRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Resources\RoomResourceCollection;

class RoomController extends Controller
{
    
    protected $repository;
    
    /**
     *
     */
    public function __construct(RoomRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    
    /*
     *
     */
    public function index()
    {
        return new RoomResourceCollection($this->repository->all());
    }
    
}
