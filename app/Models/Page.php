<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'content', 'img'];

    /**
     * Get the URL for the page's image.
     *
     * @return array|null
     */
    public function getImageUrlsAttribute()
    {
        if (!is_null($this->img)) {
            $images = explode(';', $this->img);
            $imageUrls = [];

            foreach ($images as $image) {
                // Assuming your images are stored in the 'public' directory
                $imageUrls[] = asset('storage/img/pages' . $image);
            }

            return $imageUrls;
        }

        return null;
    }
}
