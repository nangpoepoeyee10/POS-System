<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\alert;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Payment_method;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Role::create(['name' => 'staff']);

        Permission::create(['name' => 'create product']);
        Permission::create(['name' => 'edit product']);
        Permission::create(['name' => 'delete product']);

        Permission::create(['name' => 'create category']);
        Permission::create(['name' => 'edit category']);
        Permission::create(['name' => 'delete category']);

        Permission::create(['name' => 'create stock']);

        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'delete user']);
        Permission::create(['name' => 'change role of user']);

        Permission::create(['name' => 'view product page']);
        Permission::create(['name' => 'view category page']);
        Permission::create(['name' => 'view stock page']);
        Permission::create(['name' => 'view user page']);

        Permission::create(['name' => 'view profile']);
        Permission::create(['name' => 'edit profile']);
        Permission::create(['name' => 'change password']);

        $role = Role::create(['name' => 'super admin']);
        $role->givePermissionTo(Permission::all());
        $user = User::create([
            'name' => 'super admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('superadmin123'),
            'image' => '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',
            'role' => 'super admin',
            'gender' => 'male',
        ]);
        $user->assignRole($role);
        $data =[
            'staff_id' => 'STAFF-001',
            'name' => 'staff',
            'email' => 'staff@gmail.com',
            'password' => Hash::make('staff123'),
            'image' =>'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',
            'role' => 'staff',
            'gender' => 'female',
        ];
        $user1 = User::create($data);

        $user1->assignRole('staff');
        Category::create([
            'name' => 'food',
        ]);
        Customer::create([
            'name' => 'Nang Aye'
        ]);
        Payment_method::create(['name'=>'cash']);
        alert::create(['qty'=>10]);
    }
}
