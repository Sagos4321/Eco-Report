<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    // Tambahkan kode ini:
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'location',
        'image_path',
        'status',
        'likes',
    ];

    // Relasi ke User (opsional, tapi disarankan)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}