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
        'review'          => '\Reviewable\Models\Review',
        'items'   => config('auth.providers.users.model'),
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
    'perPage' => 15,
    'route-prefix' => 'acl',
    'login-route' => 'login',
    'route-middleware' => 'web',
    'messages' => [
        'no-role' => "Permission denied"
    ]
];