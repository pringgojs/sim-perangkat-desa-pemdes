<?php

namespace App\Console\Commands;

use App\Services\CpanelService;
use Illuminate\Console\Command;
use App\Services\EncryptService;
use App\Services\DatabaseService;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // self::createAccountCpanel();
        // self::encrypt();
        self::getUserAccountDatabase();
    }

    public function getUserAccountDatabase()
    {
        $service = new DatabaseService;
        $users = $service->getUserAccounts();
    }

    public function encrypt()
    {
        $enc = EncryptService::encrypt('datanya');
        $dec = EncryptService::decrypt($enc);
    }

    public function createAccountCpanel()
    {
        $cpanel_service = new CpanelService;
        $username = 'ricky1';
        $domain = 'ricky1.ponorogo.go.id';
        $password = 'atasNAMAC!NT4';
        $email = 'ricky1@gmail.com';
        $response = $cpanel_service->createAccount($username, $domain, $email, $password);
        dd($response->body());

    }
}
