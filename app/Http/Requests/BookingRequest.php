<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Rules\TimeBetween;

class BookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        if (Auth::user()->isGuest) {
            return false;
        }
        
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            
            'date' => 'required|date|after_or_equal:today',
            'duration' => Rule::in(['30', '60']),
            'room_id' => 'required|exists:rooms,id',
            'time' => ['required', new TimeBetween('08:00', '17:00')],
            'id' => 'nullable|sometimes|exists:bookings,id'
        ];
    }
}
