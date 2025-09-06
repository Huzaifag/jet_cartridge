<?php

namespace App\Mail;

use App\Models\AccountPerson;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountPersonCredentials extends Mailable
{
    use Queueable, SerializesModels;

    public $accountPerson;

    public function __construct(AccountPerson $accountPerson)
    {
        $this->accountPerson = $accountPerson;
    }

    public function build()
    {
        return $this->markdown('emails.account-person-credentials')
                    ->subject('Your Account Login Credentials');
    }
} 