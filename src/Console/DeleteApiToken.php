<?php

namespace Silverbullet\ApiTokenLaravel\Console;

use Illuminate\Console\Command;
use Silverbullet\ApiTokenLaravel\Models\ApiToken;

class DeleteApiToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api-token:delete {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete API token by id';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $id = $this->argument('id');

        $apiToken = ApiToken::find($id);

        if (!$apiToken) {
            $this->error('API token with id ' . $id . ' does not exist.');
            return;
        }

        if ($this->confirm('Are you sure you want to delete API token for "' . $apiToken['code'] . '"?', true)) {
            $apiToken->delete();
            $this->info('Delete token success!');
        }
    }
}