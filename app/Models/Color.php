<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dragon;

class Color extends Model {
    protected $fillable = [
        "color"
    ];

    public $timestamps = false;

    public function dragon() {
        return $this->hasMany(Dragon::class);
    }
}
