<?php


namespace Reviewable\Traits;


trait Reviewable
{
    public function reviews()
    {
        return $this->hasMany(config('reviewable.models.review'),'item_id', 'id');
    }
}