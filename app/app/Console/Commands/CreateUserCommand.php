<?php

namespace App\Console\Commands;

use App\Models\User;
use Faker\Generator;
use Illuminate\Console\Command;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'x:create:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command create user';

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
    public function handle(Generator $faker)
    {
        $user = User::create([
            "name"     => $faker->name,
            "email"    => $faker->email,
            "password" => bcrypt("user")
        ]);

        $token = $user->createToken("api_token")->plainTextToken;

        echo "{$user->email} | password: user | token: {$token}\n";
    }
}
