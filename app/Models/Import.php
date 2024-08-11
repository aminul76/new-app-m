<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    use HasFactory;
    protected $fillable = ['i_title', 'i_slug'];
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
