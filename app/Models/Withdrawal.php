<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    protected $primaryKey = "withdrawal_id";

    protected $fillable = [
        'account_id',
        'amount',
        'created_at',
        'updated_at',
    ];
}
