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
        // $this->call(UsersTableSeeder::class);
        $this->call(ApprovalsTableSeeder::class);
        $this->call(UserDetailsTableSeeder::class);
        $this->call(UserJabatansTableSeeder::class);
        $this->call(UserRekanansTableSeeder::class);
        $this->call(UserGroupsTableSeeder::class);
        $this->call(MappingperusahaansTableSeeder::class);
        $this->call(ItempekerjaansTableSeeder::class);
        $this->call(DocumentTypesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(CategoryDetailsTableSeeder::class);
        $this->call(CategoryProjectsTableSeeder::class);
        $this->call(RekanansTableSeeder::class);
        $this->call(RekananGroupsTableSeeder::class);
        $this->call(SpkRetensisTableSeeder::class);
        $this->call(VosTableSeeder::class);
        $this->call(PtsTableSeeder::class);
        $this->call(ProjectPtsTableSeeder::class);
        $this->call(ItempekerjaanDetailsTableSeeder::class);
    }
}
