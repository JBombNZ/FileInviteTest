<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Repositories\Interfaces\BookingRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Requests\BookingGetRequest;
use App\Http\Resources\BookingResourceCollection;

class BookingController extends Controller
{

    protected $repository;
    
    /**
     *
     */
    public function __construct(BookingRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    
    /*
     * 
     */
    public function index(BookingGetRequest $request)
    {

        $parameters = $request->all();
        $models = $this->repository->search($parameters);        
        
        return new BookingResourceCollection($models);
    }
    
    /*
     * 
     */
    public function store(BookingRequest $request)
    {
        $user = Auth::user();
                
        $start = Carbon::parse($request->get('date') . ' ' . $request->get('time'));
        $end = $start->copy()->addMinutes($request->get('duration'));
        
        $parameters = [
            'start' => $start,
            'end' => $end,
            'room' => $request->get('room')
        ];
        $existingBooking = $this->repository->search($parameters, 0);
        
        if ($existingBooking->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'There is already a booking for that time and room'
            ]);
        }
        
        $booking = $user->bookings()->create([
            'room_id' => $request->get('room'),
            'start' => $start,
            'end' => $end
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Booking created successfully'
        ]);
    }
 
    /*
     * 
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if ($model = $user->bookings()->where('id', $id)->first()) {
            $model->delete();
            
            return response()->json([
               'success' => true 
            ]);
        } else {
            abort(403);
        }
        
    }
    
}
