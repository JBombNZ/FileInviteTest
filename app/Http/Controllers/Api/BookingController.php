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
                
        $data = $this->parseCheckBooking($request, $user);
        
        if ($data == false) {
            return response()->json([
                'success' => false,
                'message' => 'There is already a booking for that time and room'
            ]);
        }
        
        $booking = $user->bookings()->create($data);
        
        return response()->json([
            'success' => true,
            'message' => 'Booking created successfully'
        ]);
    }
 
    /*
     * 
     */
    public function update(BookingRequest $request)
    {
        $user = Auth::user();
        
        if (!$model = $user->bookings()->where('id', $request->get('id'))->first()) {
            abort(404);
        }
        
        $data = $this->parseCheckBooking($request, $user);
        
        if ($data == false) {
            return response()->json([
                'success' => false,
                'message' => 'There is already a booking for that time and room'
            ]);
        }
        
        $model->update($data);
        
        return response()->json([
            'success' => true
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
    
    /*
     * 
     */
    protected function parseCheckBooking($request, $user)
    {
        $start = Carbon::parse($request->get('date') . ' ' . $request->get('time'));
        $end = $start->copy()->addMinutes($request->get('duration'));
        
        $parameters = [
            'start' => $start,
            'end' => $end,
            'room_id' => $request->get('room_id')
        ];
        $existingBooking = $this->repository->search($parameters, 0);
        
        if ($existingBooking->count() > 0) {
            return false;
        }
        
        return $parameters;
    }

}
