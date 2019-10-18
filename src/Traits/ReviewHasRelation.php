<?php


namespace Reviewable\Traits;

trait ReviewHasRelation
{
    public function item()
    {
        return $this->belongsTo(config('reviewable.models.item'), 'item_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(config('reviewable.models.user'), 'user_id', 'id');
    }


}