<?php

namespace App\Console\Commands;

use App\Mail\NewUserWelcomeMail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'command:name';
    protected $signature = 'mail:send {user_email_address}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to the user given as an argument';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return 0;
        $user_email_address = $this->argument('user_email_address');
        var_dump($user_email_address);
        $user = User::where('email', $user_email_address)->first();
        Mail::to($user->email)->send(new NewUserWelcomeMail($user));
    }
}
