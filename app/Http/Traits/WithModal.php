<?php

namespace App\Http\Traits;

trait WithModal
{

    public function toggle($modal)
    {
        $modal['isOpen'] = !$modal['isOpen'];
    }
}
