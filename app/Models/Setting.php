<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name', 'site_title', 'site_short_description', 
        'site_description', 'site_image', 'site_share_image','keyword', 
        'site_favicon'
    ];

    public $timestamps = true;
}
