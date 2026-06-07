<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Testing\Fluent\Concerns\Has;

class Todo extends Model
{
    use SoftDeletes, HasFactory;

    // Izinkan kolom-kolom ini diisi secara massal
    protected $fillable = ['task', 'is_completed','category'];
}
