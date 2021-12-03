# README

- Adding a model and migration
1. Make model and migration
    - sail artisan make:model -m (model_name) 
    - Or just migration: sail artisan make:migration (migration_name)
2. Editing model
    - Fill in the $filled, $protected, and $cast arrays with the appropriate fields for the database
3. Editing migration
    - Fill in the up() function with what is in the database.
    - Schema::table('users', function ($table) { });
        - This alters an exisitng table called users
    - Schema::create('users', function (Blueprint $table) { });
        - This create a new table called users 
    - Inside of the Schema/table functions, add all the database definition language. For instance, $table->smallInteger('role');
    will create a column called 'role' which is a small integer.
    - In the down function, drop the table or rename columns, etc.
        - Schema::dropIfExists('table_name');
        - Schema::table('table_name', function (Blueprint $table) {
            $table->renameColumn('old_name', 'new-name');
        });
4. Run migration
    - sail artisan migrate
        - Runs migration / calls the up() function
    - In migration, down() function undues the migration, while up() creates it
    - sail artisan migrate:rollback 
        - Undues migration / calls the down() function

- Making a Seeder
    - These are used to seed the database with data 
1. Make seeder
    - sail artisan make:seeder seeder_name
    - Add this import to the top:
        - use Illuminate\Support\Facades\DB;
2. Run seeder
    - sail artisan db:seed --class=SeederFileName
    - Or, rerun migrations and seed again:
        - sail artisan migrate:fresh --seed

