# Steps required to get your application up and running
$ sudo apt install composer php php-sqlite3 sqlite3

setting php.ini timezone extension langage

# 1. Check your database settings
Edit the Laravel .env file to set the connection information for the database you want to use.

Example .env file
env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
DB_CONNECTION: The database driver you want to use (mysql, pgsql, sqlite, etc.).
DB_DATABASE: Database name.
DB_USERNAME: Database user name.
DB_PASSWORD: Database password.
If you use SQLite:
If you use SQLite, set it as follows:

env
DB_CONNECTION=sqlite
DB_DATABASE=/path/to/database.sqlite
For DB_DATABASE in .env, specify the full path to the SQLite file.
If the file does not exist, create it manually:

$ touch database/database.sqlite

# 2. Create a migration file
If you want to add a new table or column, create a migration file.

Migration creation command

$ php artisan make:migration create_table_name_table
Example: To create a users table

$ php artisan make:migration create_users_table
When you run the command, a new migration file will be created in the database/migrations folder.

# 3. Edit the migration file
Edit the migration file you created to define the table structure.

Migration file example
php

public function up()
{
Schema::create('users', function (Blueprint $table) {
$table->id(); // Auto-increment primary key
$table->string('name'); // Username
$table->string('email')->unique(); // Unique email address
$table->timestamp('email_verified_at')->nullable(); // Email verification date and time
$table->string('password'); // Password
$table->timestamps(); // created_at, updated_at
});
}

public function down()
{
Schema::dropIfExists('users');
}

# 4. Run migration
Run migration to reflect changes in the database.

Command to run

$ php artisan migrate

After execution, the specified table will be created in the database.

# 5. Check your migrations
After running, you can check the current status of your migrations with the following command:

$ php artisan migrate:status

$ 6. Reset existing migrations (optional)
If you want to reset and re-run all migrations, use the following command:

Reset and re-run

$ php artisan migrate:refresh
To completely reset your database:

$ php artisan migrate:reset
$ php artisan migrate

# 7. Insert dummy data (optional)
If you want to insert dummy data, use a seeder.

Create a seeder

$ php artisan make:seeder UsersTableSeeder
Edit the seeder file
Edit the database/seeders/UsersTableSeeder.php file:

php

public function run()
{
DB::table('users')->insert([
'name' => 'John Doe',
'email' => 'johndoe@example.com',
'password' => bcrypt('password'),
]);
}

Run a seeder

$ php artisan db:seed --class=UsersTableSeeder

# another setting

$ rm composer.lock

$ composer install

$ composer update

$ php artisan optimize:clear

# run server

$ php artisan serve --port=8005

