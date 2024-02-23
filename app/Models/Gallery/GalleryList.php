<?php

namespace App\Models\Gallery;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryList extends Model
{
    use HasFactory;

    protected $table = 'gallery_list';

    protected $fillable = [
        'image_path',
        'slug'
    ];
}
