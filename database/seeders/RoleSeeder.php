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
        Permission::create(['name' => 'admin.home', 'description' => 'Ver menu Administrador'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'admin.users.index',
                            'description' => 'Ver lista de Usuarios'])->syncRoles([$role1]);; //ver Usuarios
        Permission::create(['name' => 'admin.users.edit',
                             'description' => 'Editar Usuarios'])->syncRoles([$role1]);; //Editar usuarios
 

        Permission::create(['name' => 'admin.categories.index',
                            'description' => 'Ver lista de Categorias'])->syncRoles([$role1, $role2]);; //ver Categorias
        Permission::create(['name' => 'admin.categories.create',
                            'description' => 'Crear categorias'])->syncRoles([$role1, $role2]);; //Crear categoria
        Permission::create(['name' => 'admin.categories.edit',
                            'description' => 'Editar categorias'])->syncRoles([$role1, $role2]);; //Editar Categorias
        Permission::create(['name' => 'admin.categories.destroy',
                            'description' => 'Eliminar Categorias'])->syncRoles([$role1]);; //Eliminar Categorias

        Permission::create(['name' => 'admin.tags.index',
                            'description' => 'Ver lista de Etiquetas'])->syncRoles([$role1, $role2]);; //ver Etiquetas
        Permission::create(['name' => 'admin.tags.create', 
                            'description' => 'Crear Etiquetas'])->syncRoles([$role1, $role2]);; //Crear Etiquetas
        Permission::create(['name' => 'admin.tags.edit', 
                            'description' => 'Editar Etiquetas'])->syncRoles([$role1, $role2]);; //Editar Etiquetas
        Permission::create(['name' => 'admin.tags.destroy', 
                            'description' => 'Eliminar Etiquetas'])->syncRoles([$role1]);; //Eliminar Etiquetas

        Permission::create(['name' => 'admin.posts.index', 
                            'description' => 'Ver lista de Post'])->syncRoles([$role1, $role2]);; //ver Post
        Permission::create(['name' => 'admin.posts.create', 
                            'description' => 'Crear Post'])->syncRoles([$role1, $role2]);; //Crear Post
        Permission::create(['name' => 'admin.posts.edit', 
                            'description' => 'Editar Post'])->syncRoles([$role1, $role2]);; //Editar Post
        Permission::create(['name' => 'admin.posts.destroy', 
                            'description' => 'Eliminar Post'])->syncRoles([$role1, $role2]);; //Eliminar Post
        
        //Asigno permisos a un rol especifico
        //$role1->permissions()->attach([]);
    }
}
