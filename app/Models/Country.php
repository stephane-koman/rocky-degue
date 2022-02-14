<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'code',
    ];

    protected $hidden = [
        'delete_at'
    ];

    protected $visible = [
        'id',
        'name',
        'code',
    ];

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
