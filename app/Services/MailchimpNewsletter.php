<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;

class MailchimpNewsletter implements Newsletter
{
    public function __construct(protected ApiClient $client) 
    {
        
    }

    public function subscribe(string $email, string $list = null)
    {
        $list ??= config('services.mailchimp.lists.subscribers'); // ??= is shorthand for "if $list is null, then set $list to..."

        return $this->client->lists->addListMember($list, [
            'email_address' => request('email'),
            'status' => 'subscribed'
        ]);
    }
}