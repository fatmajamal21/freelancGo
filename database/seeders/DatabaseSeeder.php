<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\project as ModelsProject;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // // صلاحيات الأدمن
        // $adminPermissions = [
        //     'manage clients',
        //     'view dashboard',
        //     'verify freelancers',
        //     'create project',
        // ];
        // foreach ($adminPermissions as $perm) {
        //     Permission::firstOrCreate([
        //         'name' => $perm,
        //         'guard_name' => 'admin',
        //     ]);
        // }

        // // صلاحيات المستخدم
        // $userPermissions = [
        //     'submit proposal',
        //     'view own profile',
        //     'apply for project',
        // ];
        // foreach ($userPermissions as $perm) {
        //     Permission::firstOrCreate([
        //         'name' => $perm,
        //         'guard_name' => 'web',
        //     ]);
        // }


        // // دور أدمن
        // $adminRole = Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'admin']);
        // $adminRole->givePermissionTo($adminPermissions);

        // // دور مستخدم
        // $userRole = Role::firstOrCreate(['name' => 'freelancer', 'guard_name' => 'web']);
        // $userRole->givePermissionTo($userPermissions);



        // // للأدمن
        // $admin = \App\Models\Admin::find(1);
        // $admin->assignRole('superadmin');

        // // للمستخدم
        // $user = \App\Models\User::find(1);
        // $user->assignRole('freelancer');




        // \App\Models\identity_verification_users::create([
        //     'user_id' => 1,
        //     'id_card_number' => '123456789',
        //     'front_image' => 'front1.jpg',
        //     'selfie_image' => 'selfie1.jpg',
        // ]);

        // \App\Models\identity_verification_freelancers::create([
        //     'freelancer_id' => 1,
        //     'id_card_number' => '987654321',
        //     'front_image' => 'front2.jpg',
        //     'selfie_image' => 'selfie2.jpg',
        // ]);


        // $users = User::pluck('id')->toArray();

        // if (empty($users)) {
        //     $this->command->warn('لا يوجد مستخدمين في جدول users، يرجى إنشاء مستخدمين أولًا.');
        //     return;
        // }

        // $statuses = ['open', 'in_progress', 'completed', 'cancelled'];

        // foreach (range(1, 10) as $i) {
        //     ModelsProject::create([
        //         'user_id'    => fake()->randomElement($users),
        //         'title'      => 'مشروع ' . fake()->words(3, true),
        //         'description' => fake()->paragraph,
        //         'budget'     => fake()->randomFloat(2, 100, 10000),
        //         'duration'   => fake()->numberBetween(1, 30) . ' يوم',
        //         'deadline'   => fake()->dateTimeBetween('now', '+2 months'),
        //         'status'     => fake()->randomElement($statuses),
        //     ]);
        // }


        // \App\Models\User::factory(10)->create();

        // \App\Models\User::create([
        //     'name' => 'Test User',
        //     'email' => 'user@example.com',
        //     'password' => Hash::make('123456789'),
        // ]);

        // \App\Models\Admin::create([
        //     'name' => 'Test Admin',
        //     'email' => 'admin@example.com',
        //     'phone' => '0599166114',
        //     'password' => Hash::make('123456789'),
        // ]);

        // \App\Models\Freelancer::create([
        //     'fullname' => 'Test Freelancer',
        //     'username' => 'TestFreelancer',
        //     'phone' => '0599166117',
        //     'country' => 'gaza',
        //     'email' => 'freelancer@example.com',
        //     'password' => Hash::make('123456789'),
        // ]);

        // \App\Models\User::create([
        //     'name' => 'Test User 2',
        //     'email' => 'user2@example.com',
        //     'password' => Hash::make('123456789'),
        // ]);

        // \App\Models\Admin::create([
        //     'name' => ' Admin View',
        //     'email' => 'adminView@example.com',
        //     'phone' => '0599166114',
        //     'password' => Hash::make('123456789'),
        // ]);

        // \App\Models\Freelancer::create([
        //     'fullname' => 'Test Freelancer 2',
        //     'username' => 'TestFreelancer2',
        //     'phone' => '0599166117',
        //     'country' => 'gaza',
        //     'email' => 'freelancer2@example.com',
        //     'password' => Hash::make('123456789'),
        // ]);

        /* users :  view , store , update , delete */
        // create perm
        /*Permission::create(['name' => 'users.view' , 'guard_name' => 'admin']);
        Permission::create(['name' => 'users.store', 'guard_name' => 'admin']);
        Permission::create(['name' => 'users.update', 'guard_name' => 'admin']);
        Permission::create(['name' => 'users.delete', 'guard_name' => 'admin']);

        // create roles
        $super =  Role::create(['name' => 'super', 'guard_name' => 'admin']);
        $viewer = Role::create(['name' => 'viewer', 'guard_name' => 'admin']);
        $editor = Role::create(['name' => 'editor', 'guard_name' => 'admin']);

        // give per to role
        $super->givePermissionTo(Permission::all());
        $viewer->givePermissionTo(['users.view']);
        $editor->givePermissionTo(['users.view', 'users.update', 'users.delete']);
*/
        // give per to user
        // $user = Admin::find(1);
        // $user->syncRoles('super');
        /*
      $models = ['User'] ;
      $actions = ['store' , 'view' , 'update' , 'delete'];

      $super =  Role::firstOrCreate(['name' => 'super', 'guard_name' => 'admin']);
      foreach($models as $model){
        foreach($actions as $action){
            $permName = "$model.$action" ;
            $permission = Permission::firstOrCreate([
                'name' => $permName ,
                'guard_name' => 'admin' ,
            ]);

            $super->givePermissionTo($permission);
        }
      }
*/

        // $permission = Permission::create(['name' => 'view_users']);
        // $role = Role::create(['name' => 'manager']);

        // $role->givePermissionTo($permission);

        // $admin = Admin::find(1);
        // $admin->assignRole('manager');
    }
}
