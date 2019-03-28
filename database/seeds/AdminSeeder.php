<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "Administrator";
        $user->date_of_birth = "1990-01-01";
        $user->email = "admin@kidwedo.com";
        $user->user_id = "admin";
        $user->password = bcrypt("kidwedo00%");
        $user->user_role_id = 0;
        $user->status_id = 1;
        $user->save();
    }
}
