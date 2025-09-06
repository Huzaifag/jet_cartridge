<?php

namespace App\Policies;

use App\Models\AccountPerson;
use App\Models\Seller;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccountPersonPolicy
{
    use HandlesAuthorization;

    public function view(Seller $seller, AccountPerson $accountPerson)
    {
        return $seller->id === $accountPerson->seller_id;
    }

    public function update(Seller $seller, AccountPerson $accountPerson)
    {
        return $seller->id === $accountPerson->seller_id;
    }

    public function delete(Seller $seller, AccountPerson $accountPerson)
    {
        return $seller->id === $accountPerson->seller_id;
    }
} 