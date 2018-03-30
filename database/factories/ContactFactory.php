<?php

use App\Contact;
use App\User;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {

    $phone_numbers = [];
    $addresses = [];
    $emails = [];


    for($i=0;$i<5;$i++) {
        $phone_numbers[] = $faker->phoneNumber;
        $addresses[] = $faker->address;
        $emails = $faker->email;
    }

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'emails' => $emails,
        'phones' => $phone_numbers,
        'company' => $faker->company,
        'photo' => $faker->imageUrl(),
        'addresses' => $addresses
    ];
});
