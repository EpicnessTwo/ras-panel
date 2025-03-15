<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UserSetAdminCommand extends Command
{
    protected $signature = 'user:set-admin {name}';

    protected $description = 'Updates a user to admin status';

    public function handle(): void
    {
        $user = User::whereName($this->argument('name'))->firstOrFail();

        if (! $this->ask("Are you sure you want to set {$user->name} as an admin?")) {
            $this->info('Operation cancelled');
            return;
        }

        $user->is_admin = true;
        $user->save();
    }
}
