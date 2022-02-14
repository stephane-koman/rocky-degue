<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'code',
        'country',
    ];

    protected $hidden = [
        'delete_at'
    ];

    protected $visible = [
        'id',
        'name',
        'code',
        'country',
    ];


    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
