<?php

namespace App\Models\EventOffer;
use App\Models\EventOffer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    protected $table = "favourites";
    use HasFactory;
    protected $fillable = [
      'event_id',
      'ticket_id',
      'ticket_name',
      'customer_id'
    ];
    // customer 
    public function user()
    {
      return $this->belongsTo(User::class);
    }
    public function events()
    {
      return $this->belongsTo(EventOffer::class,'event_id');
    }
}
