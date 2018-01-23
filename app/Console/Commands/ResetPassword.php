<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class ResetPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'password:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'reset administrator password';

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
     * @return mixed
     */
    public function handle()
    {
        $password = $this->secret('please input password?');
        $rePassword = $this->secret('please repeat input password?');
        if ($password != $rePassword) {
            $this->error('password not correct.');
        } else {
            $user = (new User())->first();
            $user->password = bcrypt($password);
            $user->save();

            $this->info('reset success');
        }
    }
}
