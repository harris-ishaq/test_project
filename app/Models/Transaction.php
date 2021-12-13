<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'transaction_id',
        'books_id',
        'students_id',
        'date_start',
        'date_return',
        'date_returned',
        'status',
    ];

    protected $dates = [
        'date_start',
        'date_return',
        'date_returned',
    ];

    public function bookInformation()
    {
    	return $this->belongsTo('\App\Models\Book', 'books_id');
    }

    public function studentInformation()
    {
    	return $this->belongsTo('\App\Models\Student', 'students_id');
    }
}
