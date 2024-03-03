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
        'amount',
        'created_at',
        'updated_at',
    ];

    public function receiver(){
      return $this->belongsTo(User::class, 'receiver_id','id');
    }

    public function sender(){
      return $this->belongsTo(User::class, 'sender_id', 'id');
    }
}
