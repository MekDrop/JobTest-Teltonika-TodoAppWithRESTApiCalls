<?php


namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

/**
 * List users
 *
 * @package App\Console\Commands
 */
class UserListCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List users';

    /**
     * Execute command
     */
    public function handle() {

        $users = User::all('email', 'type')->map(
            function ($user) {
                return [
                  'email' => $user->email,
                  'type' => ($user->type == USER::TYPE_ADMIN) ? 'admin' : 'user'
                ];
            }
        );

        if ($users->isEmpty()) {
            $this->warn('No users are registered. Use <fg=white>php artisan user:register</> to register new user');
        } else {
            $this->table(['Email', 'Type'], $users);
        }
    }

}