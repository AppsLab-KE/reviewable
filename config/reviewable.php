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
        'review' => '\Reviewable\Models\Review',
        'user'   => config('auth.providers.users.model'),
        'item'   => config('auth.providers.users.model'),
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
        'item' => "hotels",
        'user' => "users"
    ],
    'monitor' => true,
    'perPage' => 15,
    'route-prefix' => 'reviews',
    'login-route' => 'login',
    'route-middleware' => 'web',
    'messages' => [
        'no-role' => "Permission denied"
    ]
];