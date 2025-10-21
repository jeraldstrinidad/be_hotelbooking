<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Request $r){
        $query = Room::query();
        if($r->filled('q')) {
            $q = $r->q;
            $query->where('name','like',"%{$q}%")
                  ->orWhere('description','like',"%{$q}%");
        }
        if($r->filled('capacity')) $query->where('capacity','>=',$r->capacity);
        return $query->where('available', true)->paginate(12);
    }

    public function show(Room $room){ return $room; }
}
