<?php

return [
    /*
   |--------------------------------------------------------------------------
   | Models
   |--------------------------------------------------------------------------
   |
   | If you want, you can replace default models from this package by models
   | you created.
   |
   */

    'models' => [
        'review' => \Reviewable\Models\Review::class,
        'monitor'   => '\Reviewable\Models\Monitor',
    ],

    /*
  |--------------------------------------------------------------------------
  | Tables
  |--------------------------------------------------------------------------
  |
  | If you want, you can replace default tables from this package
  |
  */
    'tables' => [
        'review' => "reviews",
    ],
    'monitor' => true,
    'perPage' => 5,
    'route-prefix' => 'reviews',
    'route-middleware' => 'web',
];