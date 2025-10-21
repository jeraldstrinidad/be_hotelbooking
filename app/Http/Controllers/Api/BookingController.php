<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookingController extends Controller
{
    public function store(Request $r){
        $r->validate([
            'room_id'=>'required|exists:rooms,id',
            'checkin'=>'required|date',
            'checkout'=>'required|date|after:checkin'
        ]);
        $room = Room::findOrFail($r->room_id);
        // compute nights
        $checkin = new \DateTime($r->checkin);
        $checkout = new \DateTime($r->checkout);
        $nights = $checkout->diff($checkin)->days;
        $total = $nights * $room->price_per_night;

        $booking = Booking::create([
            'user_id'=>$r->user()->id,
            'room_id'=>$room->id,
            'checkin'=>$r->checkin,
            'checkout'=>$r->checkout,
            'total_price'=>$total,
            'status'=>'confirmed'
        ]);
        return response()->json($booking,201);
    }

    public function index(Request $r){
        // past & upcoming
        $user = $r->user();
        return $user->bookings()->with('room')->orderBy('checkin','desc')->get();
    }

    public function cancel(Request $r, Booking $booking)
{
    if ($booking->user_id !== $r->user()->id) {
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    if ($booking->status === 'cancelled') {
        return response()->json(['message' => 'Already cancelled'], 400);
    }

    $booking->status = 'cancelled';
    $booking->save();

    return response()->json([
        'message' => 'Booking cancelled successfully',
        'booking' => $booking
    ]);
}

}
  