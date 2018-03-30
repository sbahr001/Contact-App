<?php

use App\Contact;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create users with contacts.
        factory(User::class, 10)->create()->each(function($user) {
            $contacts = factory(Contact::class,5)->make();
            $user->contacts()->saveMany($contacts);
        });
    }
}
