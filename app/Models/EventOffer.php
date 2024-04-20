<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EventOffer\Favourite;
use App\Models\Vendor;
class EventOffer extends Model
{
  protected $table = "event_offers";
  use HasFactory;
  protected $fillable = [
    'vendor_id',
    'rest_title',
    'r_logo',
    'offer_title',
    'description',
    'offer_type',
    'media_content',
    'media_type',
    'seen',
    'available',
    'old_price',
    'new_price',
    'discount_amount',
    'status',
    'is_featured',
  ];

  public function favourite()
  {
    return $this->hasMany(Favourite::class, 'event_id', 'id');
  }
  
  
  
  public function vendor()
  {
    return $this->hasMany(Vendor::class, 'vendor_id', 'id');
  }
 
}
