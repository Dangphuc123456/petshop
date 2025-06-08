<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $table = 'appointments'; // tên bảng
    protected $primaryKey = 'AppointmentID';    // khóa chính
    protected $fillable = [
        'ServiceID',
        'ServiceName',
        'CustomerName',
        'CustomerContact',
        'AppointmentDate',
        'Status',
        'created_at',
        'updated_at',
        'LocationName',
        'CancellationReason',
    ];
}
