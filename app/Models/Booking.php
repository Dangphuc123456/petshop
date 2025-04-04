<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'Booking';
    protected $primaryKey = 'BookingID';
    protected $fillable = [
            'RoomID' ,                              
            'CustomerName',        
            'PhoneNumber' ,          
            'Email' ,                       
            'CheckInDate' ,             
            'CheckOutDate',                
            'TotalPrice' ,                  
            'BookingStatus' , 
            'created_at',
            'updated_at' ,
        
    ];

    public function rooms()  
    {  
        return $this->belongsTo(Room::class, 'RoomID');  
    } 
}
