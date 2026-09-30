<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'isbn',
        'stok',
        'category_id',
        'sampul',
    ];

   public function category()
   {
    return $this->belongsTo(Category::class);
   }

   public function loanItems(){
    return $this->hasMany(Loan::class);
   }
}
