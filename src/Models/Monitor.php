<?php


namespace Reviewable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Monitor extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at'
    ];
    protected $table;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTable(config('reviewable.tables.monitor'));
    }

    protected $fillable = [
        'type','name','description',
    ];
}