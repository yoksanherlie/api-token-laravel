<?php

namespace Silverbullet\ApiTokenLaravel\Console;

use Illuminate\Console\Command;
use Silverbullet\ApiTokenLaravel\Models\ApiToken;

class ListApiToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api-token:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all API tokens';

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
     * @return void
     */
    public function handle()
    {
        $this->table(['ID', 'Name', 'Code', 'Token', 'Created At', 'Updated At'], ApiToken::all());
    }
}