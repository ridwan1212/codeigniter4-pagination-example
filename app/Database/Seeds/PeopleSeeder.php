<?php

namespace App\Database\Seeds;

use \CodeIgniter\I18n\Time;

class PeopleSeeder extends \CodeIgniter\Database\Seeder
{
  public function run()
  {
    // $data = [
    //   [
    //     'name'        => 'Andy',
    //     'address'     => '8733 Apple Street, 10',
    //     'created_at'  => Time::now(),
    //     'updated_at'  => Time::now()
    //   ],
    //   [
    //     'name'        => 'Buddy',
    //     'address'     => '643 Banana Street, 135',
    //     'created_at'  => Time::now(),
    //     'updated_at'  => Time::now()
    //   ],
    //   [
    //     'name'        => 'Anie',
    //     'address'     => '112 Lemon Street, 121',
    //     'created_at'  => Time::now(),
    //     'updated_at'  => Time::now()
    //   ]
    // ];

    // $this->db->table('peoples')->insertBatch($data);

    // // Simple Queries
    // $this->db->query(
    //   "INSERT INTO peoples (name, address, created_at, updated_at) VALUES(:name:, :address:, :created_at:, :updated_at:)",
    //   $data
    // );

    $faker = \Faker\Factory::create('id_ID');

    for ($i = 0; $i < 150; $i++) {
      $data = [
        'name'        => $faker->name,
        'address'     => $faker->address,
        'created_at'  => Time::createFromTimestamp($faker->unixTime()),
        'updated_at'  => Time::now()
      ];

      // Using Query Builder
      $this->db->table('peoples')->insert($data);
    }
  }
}
