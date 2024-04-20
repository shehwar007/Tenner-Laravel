<?php

namespace App\Models\EventOffer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EventOffer\Favourite;
class EventPopupClick extends Model
{
  protected $table = "event_popups_clicks";
  use HasFactory;
  protected $fillable = [
    'user_id',
    'offer_id',
    'clicks',
  ];
 
}