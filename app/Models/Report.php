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
    // Tambahkan di bawah relasi user() yang sudah ada sebelumnya
    
    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'asc');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}