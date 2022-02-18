<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentType extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'code',
        'name',
    ];

    protected $hidden = [
        'delete_at'
    ];

    protected $visible = [
        'id',
        'code',
        'name',
    ];
}
