<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PDO;
use PDOException;

class CreateDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command creates a new database.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $pdo = new PDO(
                sprintf(
                    'mysql:host=%s;port=%d;',
                    config('database.connections.mysql.host'),
                    config('database.connections.mysql.port')
                ),
                config('database.connections.mysql.username'),
                config('database.connections.mysql.password')
            );
            $pdo->exec(
                sprintf(
                    'CREATE DATABASE IF NOT EXISTS %s CHARACTER SET %s COLLATE %s;',
                    config('database.connections.mysql.database'),
                    config('database.connections.mysql.charset'),
                    config('database.connections.mysql.collation')
                )
            );
            $this->info(sprintf('Successfully created %s database', config('database.connections.mysql.database')));
            return 0;
        } catch (PDOException $exception) {
            $this->error(sprintf('Failed to create %s database, %s', config('database.connections.mysql.database'), $exception->getMessage()));
            return 1;
        }
    }
}
