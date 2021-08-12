<?php

namespace App\Console\Commands;

use App\Services\UserService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Console\Command;

class CreateUser extends Command
{
    private UserService $userService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:user {email} {--name= : The name of the user} {--password= : Set an initial password.'
    . ' Otherwise the password can be reset by the forgot password page}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a user in the users table';

    /**
     * Create a new command instance.
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        parent::__construct();
        $this->userService = $userService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $password = $this->option('password') ?? substr(sha1(uniqid('', true)), 0, 8);
            $user = $this->userService->create($this->argument('email'), $password, $this->option('name'));

            if ($this->option('password') === null) {
                echo "Password not provided. Initial password has been set to $password\n";
            }

            event(new Registered($user));
            $user->sendEmailVerificationNotification();

            return 0;
        } catch (\Exception $e) {
            echo get_class($e) . ': ' . $e->getMessage() . "\n";

            return 1;
        }
    }
}
