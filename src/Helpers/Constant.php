<?php

namespace App\Helpers;
class Constant {
    /** @var string[] SALES_KEYS */
    public const SALES_KEYS = [
        'sale_id',
        'customer_name',
        'customer_mail',
        'product_id',
        'product_name',
        'product_price',
        'sale_date',
        'version'
    ];

    /** @var string VERSION_COMPARE_VAL */
    public const VERSION_COMPARE_VAL = "1.0.17+60";

    /** @var string[] TIMEZONES */
    public const TIMEZONES = [
        'EB' => 'Europe/Berlin',
        'UTC' => 'UTC'
    ];
}
