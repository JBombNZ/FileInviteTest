<?php 

namespace App\Repositories\Interfaces;

interface BookingRepositoryInterface
{
    /*
     * 
     */
    public function search($parameters, $paginate);
}