<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name' => 'Administrador',
            ],
            [
                'name' => 'Vecino' ,
            ]
        ]);

        DB::table('ticket_states')->insert([
            [
                'name' => 'Nuevo',
            ],
            [
                'name' => 'En progreso' ,
            ],
            [
                'name' => 'Resuelto',
            ],
            [
                'name' => 'Cerrado',
            ]
        ]);
    }
}
