<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Creo nuevos registros de roles

        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Blogger']);
     
        //Creo los permisos para cada accion que quiero limitar o permitir
        Permission::create(['name' => 'admin.home'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'admin.users.index'])->syncRoles([$role1]);; //ver Usuarios
        Permission::create(['name' => 'admin.users.edit'])->syncRoles([$role1]);; //Editar usuarios
        Permission::create(['name' => 'admin.users.update'])->syncRoles([$role1]);; //Actualizar Usuarios

        Permission::create(['name' => 'admin.categories.index'])->syncRoles([$role1, $role2]);; //ver Categorias
        Permission::create(['name' => 'admin.categories.create'])->syncRoles([$role1, $role2]);; //Crear categoria
        Permission::create(['name' => 'admin.categories.edit'])->syncRoles([$role1, $role2]);; //Editar Categorias
        Permission::create(['name' => 'admin.categories.destroy'])->syncRoles([$role1, $role2]);; //Eliminar Categorias

        Permission::create(['name' => 'admin.tags.index'])->syncRoles([$role1, $role2]);; //ver Etiquetas
        Permission::create(['name' => 'admin.tags.create'])->syncRoles([$role1, $role2]);; //Crear Etiquetas
        Permission::create(['name' => 'admin.tags.edit'])->syncRoles([$role1, $role2]);; //Editar Etiquetas
        Permission::create(['name' => 'admin.tags.destroy'])->syncRoles([$role1, $role2]);; //Eliminar Etiquetas

        Permission::create(['name' => 'admin.posts.index'])->syncRoles([$role1, $role2]);; //ver Post
        Permission::create(['name' => 'admin.posts.create'])->syncRoles([$role1, $role2]);; //Crear Post
        Permission::create(['name' => 'admin.posts.edit'])->syncRoles([$role1, $role2]);; //Editar Post
        Permission::create(['name' => 'admin.posts.destroy'])->syncRoles([$role1, $role2]);; //Eliminar Post
        
        //Asigno permisos a un rol especifico
        //$role1->permissions()->attach([]);
    }
}
