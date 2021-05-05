<?php

namespace App\Http\Traits;

trait WithSorting
{
    public $sortBy = 'id';
    public $order = 'desc';

    public function sortBy($field)
    {
        if ($this->sortBy != $field)  $this->order = 'desc';
        $this->order = $this->order === 'desc' ?  'asc' :  'desc';
        $this->sortBy = $field;
    }
}
