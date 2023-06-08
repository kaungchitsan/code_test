<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'amount',
        'description',
        'due_date'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
