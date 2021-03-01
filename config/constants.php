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
    ],
    
    'result' => [
        'COBAS' => [
            'NEGATIVT' => 'NEGATIVT',
            'HPV16' => 'HPV16',
            'HPV18' => 'HPV18',
            'ÖVRIGT_HPV' => 'ÖVRIGT_HPV',
            'FAILED' => 'FAILED',
        ],
        
        'LUMINEX' => [
            'NEGATIVT' => 'NEGATIVT',
            'HPV16' => 'HPV16',
            'HPV18' => 'HPV18',
            'ÖVRIGT_HPV' => 'ÖVRIGT_HPV',
            'FAILED' => 'FAILED',
        ],
        
        'RTPCR' => [
            'NEGATIVT' => 'NEGATIVT',
            'HPV16' => 'HPV16',
            'HPV18' => 'HPV18',
            'ÖVRIGT_HPV' => 'ÖVRIGT_HPV',
            'FAILED' => 'FAILED',
        ],
        
        'FINAL_REPORTING' => [
            'NEGATIVT' => 'NEGATIVT',
            'HPV16' => 'HPV16',
            'HPV18' => 'HPV18',
            'HPV45' => 'HPV45',
            'ÖVRIGT_HPV_LÅG' => 'ÖVRIGT_HPV_LÅG',
            'ÖVRIGT_HPV_MEDEL' => 'ÖVRIGT_HPV_MEDEL',
        ]
    ],
    
    'result_message' => [
        'NEGATIVT' => 'NEGATIVT',
        'HPV16' => 'HPV16',
        'HPV18' => 'HPV18',
        'HPV45' => 'HPV45',
        'ÖVRIGT_HPV_LÅG' => 'ÖVRIGT_HPV_LÅG',
        'ÖVRIGT_HPV_MEDEL' => 'ÖVRIGT_HPV_MEDEL',
    ]
];