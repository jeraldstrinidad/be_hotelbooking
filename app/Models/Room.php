<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Booking;


class Room extends Model
{
    use HasFactory;
    protected $fillable = ['name','description','capacity','price_per_night','available'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
