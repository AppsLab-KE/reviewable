<?php


namespace Reviewable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Occurrence extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at'
    ];
    protected $table;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTable('occurrences');
    }

    public function occurrable(): MorphTo
    {
        return $this->morphTo();
    }

    protected $guarded = [];
}