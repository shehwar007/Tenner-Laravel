<?php

namespace App\Models\EventOffer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EventOffer\Favourite;
class EventPopup extends Model
{
  protected $table = "event_popups";
  use HasFactory;
  protected $fillable = [
    'popup_type',
    'circle_pic',
    'title',
    'description',
    'flyer_pic',
  ];
 
}
