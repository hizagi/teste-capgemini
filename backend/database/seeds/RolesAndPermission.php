<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $this->createPermissions();
        $this->createRoles();
        $this->sync();
    }

    private function createPermissions()
    {
        $permissions = [];

        // accounts
        $permissions = array_merge($permissions, [
            'account.index',
            'account.show',
            'account.update',
            'account.destroy',
            'account.deposit',
            'account.withdraw',
        ]);

        // users
        $permissions = array_merge($permissions, [
            'user.index',
            'user.store',
            'user.show',
            'user.update',
            'user.destroy',
        ]);

        // transactions
        $permissions = array_merge($permissions, [
            'transaction.index',
            'transaction.store',
            'transaction.show',
            'transaction.update',
            'transaction.destroy',
        ]);

        foreach ($permissions as $name) {
            Permission::firstOrCreate(['name' => $name]);
        }

        $this->command->info(count($permissions) . ' permissions were created.');
    }

    private function createRoles()
    {
        $roles = ['admin', 'defaultUser'];

        foreach ($roles as $name) {
            Role::firstOrCreate(['name' => $name]);
        }
        $this->command->info(count($roles) . ' roles were created');
    }

    private function sync()
    {

        $this->syncPermissions('defaultUser', [ // permissões do usuário padrão
            'account.index',
            'account.show',
            'account.deposit',
            'account.withdraw',
        ]);

        $this->syncPermissions('admin', Permission::all()->pluck('name')->toArray()); // administrador tem todas as permissões
    }

    private function syncPermissions($role, $permissions, $inheritance = [])
    {
        $role = Role::findByName($role);
        $permissions = array_merge($permissions, $this->getInheritedPermissions($inheritance));
        $role->syncPermissions($permissions);
        dump($role->name, $permissions);
    }

    private function getInheritedPermissions($roles)
    {
        $permissions = [];
        foreach ($roles as $role) {
            $role = Role::findByName($role);
            foreach ($role->permissions()->get() as $permission) {
                $permissions[] = $permission->name;
            }
        }
        return $permissions;
    }
}
