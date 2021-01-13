<?php

/*
 * Constants
 * To access
 * Config::get('constants.roles')
 * Config::get('constants.roles.ADMIN_ROLE')
 * 
 */
return [
    'roles' => [
        'ADMIN_ROLE' => 'ADMIN_ROLE',
        'USER_ROLE' => 'USER_ROLE'
    ],
    
    'orders' => [
        'ORDER_CREATED' => 'ORDER_CREATED'
    ],
    
    'kits' => [
        'KIT_REGISTERED' => 'KIT_REGISTERED',
        'KIT_DISPATCHED' => 'KIT_DISPATCHED'
    ],
    
    'samples' => [
        'SAMPLE_RECEIVED' => 'SAMPLE_RECEIVED',
        'SAMPLE_REGISTERED' => 'SAMPLE_REGISTERED'
    ],
    
    'results' => [
        'RESULT_RECEIVED' => 'RESULT_RECEIVED'
    ]
];