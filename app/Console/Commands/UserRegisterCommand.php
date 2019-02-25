<?php


namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use \Illuminate\Support\Facades\Validator;

/**
 * List users
 *
 * @package App\Console\Commands
 */
class UserRegisterCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:register { email : Email of user } { --admin : User should get admin rights }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Register a user (email for changing password will be send)';

    /**
     * Execute command
     */
    public function handle() {

        if (!$this->validateArgumentsAndPrintErrors()) {
            return;
        }

        $user = new User();
        $user->type = $this->hasOption('admin') ? User::TYPE_ADMIN : User::TYPE_USER;
        $user->email = $this->argument('email');
        $user->chash = sha1(microtime(true));
        $user->save();

        $this->info('User has been registered.');
    }

    /**
     * Validates arguments
     *
     * @return bool
     */
    protected function validateArgumentsAndPrintErrors(): bool {
        $errors = Validator::make(
            $this->arguments(),
            [
                'email' => [
                    'email',
                    'unique:user,email'
                ]
            ]
        )->errors()->getMessages();

        if (empty($errors)) {
            return true;
        }

        array_walk_recursive($errors, [$this, 'error']);

        return false;
    }

}