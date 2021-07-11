<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;
    protected $table = 'payments';
    protected $fillable = ['order_id', 'thanh_vien', 'money', 'note', 'vnp_response_code', 'code_vnpay', 'code_bank', 'time'];
}
