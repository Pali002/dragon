<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Color;

class Dragon extends Model {
    protected $fillable = [
        "name",
        "age",
        "color_id"
    ];

    public $timestamps = false;

    public function color() {
        return $this->belongsTo(Color::class);
    }
}
