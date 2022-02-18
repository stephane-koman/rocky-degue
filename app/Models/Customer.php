<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'phone',
        'address',
        'email',
        'description',
        'country'
    ];

    protected $hidden = [
        'delete_at'
    ];

    protected $visible = [
        'id',
        'name',
        'phone',
        'address',
        'email',
        'description',
        'country'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
