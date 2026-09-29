<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// File: app/Models/Category.php
class Category extends Model
{
    use HasFactory;

    protected $table = 'categories'; // pastikan ini ada
    protected $fillable = ['nama_kategori', 'deskripsi'];
}
