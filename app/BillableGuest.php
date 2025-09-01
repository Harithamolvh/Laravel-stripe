<?php

namespace App;

use Laravel\Cashier\Billable;

class BillableGuest
{
    use Billable;

    public $id;
    public $stripe_id;
    public $email;

    public function __construct(array $attributes = [])
    {
        foreach ($attributes as $key => $value) {
            $this->{$key} = $value;
        }
    }
}