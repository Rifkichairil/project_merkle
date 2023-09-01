<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestBook extends Model
{
    use HasFactory;

    // sesuaikan dengan nama database
    protected $table = 'guest_book';

    // isi sesuai dengan field databse
    protected $fillable = [
        'name',
        'address',
        'phone',
        'comment'
    ];
}
