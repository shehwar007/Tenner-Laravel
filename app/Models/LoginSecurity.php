<?php

namespace App\Models;

use App\Models\Vendor;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginSecurity extends Model
{
    use HasFactory;


    protected $fillable = [
        'vender_id'
    ];
    
    public function vender()
    {
        return $this->belongsTo(Vendor::class);
    }


    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
