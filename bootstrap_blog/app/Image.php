<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use InterventionImage;

class Image extends Model
{
    public function test_crop(){
        $intervention_image = InterventionImage::make($this->path);
        return $intervention_image->crop(50, 50)->encode('data-url');
    }
}
