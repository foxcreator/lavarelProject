<?php

namespace App\Observers;

use App\Models\Image;
use App\Models\Product;
use App\Services\FileStorageService;

class ImageObserver
{
    /**
     * Handle the Image "created" event.
     *
     * @param  \App\Models\Image  $image
     * @return void
     */
    public function created(Image $image)
    {
        //
    }

    /**
     * Handle the Image "updated" event.
     *
     * @param  \App\Models\Image  $image
     * @return void
     */
    public function updated(Image $image)
    {
        //
    }

    /**
     * Handle the Image "deleted" event.
     *
     * @param  \App\Models\Product  $image
     * @return void
     */
    public function deleted(Product $image)
    {
        FileStorageService::remove($image->path);
    }

}
