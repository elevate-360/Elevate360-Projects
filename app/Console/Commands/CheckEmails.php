<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Webklex\IMAP\Facades\Client;

class CheckEmails extends Command
{
    protected $signature = 'email:check';
    protected $description = 'Check for new emails';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
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

        foreach ($messages as $message) {
            // dd($message);
            // Process each email
            echo 'Subject: '.$message->getSubject()."\n";
            // Implement your logic here
            $body = $message->getTextBody();
            if (empty($body)) {
                $body = $message->getHTMLBody();
            }
            echo "Body: " . $body . "\n";
            echo "From: " . $message->getFrom()[0]->mail . "\n";
            echo "From name: " . $message->getFrom()[0]->personal . "\n";
            echo "to: " . $message->getToAddress() . "\n";

            // Optionally mark the message as read
            // $message->setFlag('SEEN');
        }

        $client->disconnect();
    }
}
