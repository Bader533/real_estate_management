<?php

namespace Database\Seeders;

use App\Models\PropertyOwner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PropertyOwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PropertyOwner::create([
            'name' => 'bader',
            'email' => 'bader@app.com',
            'phone' => '999999989',
            'password' => Hash::make(12345),
        ]);
    }
}
