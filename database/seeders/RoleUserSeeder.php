<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        foreach ([Role::ROLE_USER, Role::ROLE_GUEST] as $roleName) {
            $role = Role::create(['name' => $roleName]);
            
            if ($role->name == Role::ROLE_USER) {
                $role->users()->create([
                    'name' => 'Jeremy',
                    'email' => 'jeremy@likefury.com',
                    'password' => bcrypt('password'),
                ]);
            }
        }
        
    }
}
