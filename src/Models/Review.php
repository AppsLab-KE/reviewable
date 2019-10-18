<?php


namespace AppsLab\Acl\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;
    protected $dates = [
        'deleted_at'
    ];
    protected $table;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTable(config('review.tables.review'));
    }

    protected $fillable = [
        'name', 'slug','description'
    ];
}