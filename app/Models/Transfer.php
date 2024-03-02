<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    protected $primaryKey = "transfer_id";

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'created_at',
        'updated_at',
    ];
}
