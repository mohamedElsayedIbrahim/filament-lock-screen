<?php

return [

    'timeout' => env('FILAMENT_LOCK_TIMEOUT', 900),

    'enabled' => true,

    'guard' => 'web',

    'password_check' => true,

];