<?php

/**
 * Customer Class
 */

class Customer
{

    use Model;

    protected $table = 'customer';

    protected $allowedColumns = [

        'customer_name',
        'customer_contact',
        'customer_address',
    ];
}
