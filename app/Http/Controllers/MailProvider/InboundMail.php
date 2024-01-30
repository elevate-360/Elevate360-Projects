<?php

namespace App\Http\Controllers\MailProvider;

use App\Http\Controllers\Controller;
use Illuminate\Console\Command;
use Webklex\IMAP\Facades\Client;

class InboundMail extends Controller
{
    public static function getMails()
    {
        $client = Client::make([
            'host'          => config('imap.accounts.default.host'),
            'port'          => config('imap.accounts.default.port'),
            'encryption'    => config('imap.accounts.default.encryption'),
            'validate_cert' => config('imap.accounts.default.validate_cert'),
            'username'      => config('imap.accounts.default.username'),
            'password'      => config('imap.accounts.default.password'),
            'protocol'      => config('imap.accounts.default.protocol'),
        ]);

        $client->connect();

        $folder = $client->getFolder('INBOX');
        $messages = $folder->query()->unseen()->get();

        $client->disconnect();

        return $messages;
    }
}
