<?php

namespace App\Models\Gallery;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryListImages extends Model
{
    use HasFactory;

    protected $table = 'gallery_list_images';

    protected $fillable = [
        'image_path',
        'slug'
    ];
}
