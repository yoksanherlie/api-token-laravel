<?php

namespace Silverbullet\ApiTokenLaravel\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Silverbullet\ApiTokenLaravel\Models\ApiToken;

class GenerateApiToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api-token:generate {name} {code?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate new API token for new service';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $name = $this->argument('name');

        $code = $this->getCode($this->argument('code'), $this->argument('name'));

        if (!$code) {
            $this->error('Service code name already exists!');
            return;
        }

        $token = $this->getToken();

        $apiToken = new ApiToken;
        $apiToken->name = $name;
        $apiToken->code = $code;
        $apiToken->token = $token;
        $apiToken->save();

        $this->info('Generate new token success!');
    }

    /**
     * Check if code exists in api tokens table.
     * Will use name of the service with all letters lowercased if 
     * code is not specified.
     * 
     * @param string $code
     * @param string $name
     * 
     * @return string
     */
    public function getCode($code, $name)
    {
        $generatedCode = $code ? $code : strtolower($name);

        $codeExists = ApiToken::where('code', '=', $code)->exists();

        return $codeExists ? $codeExists : $generatedCode;
    }

    /**
     * Generate new unique token
     * 
     * @param string $code
     * @param string $name
     * 
     * @return string
     */
    public function getToken()
    {
        do {
            $token = Str::random(64);

            $tokenExists = ApiToken::where('token', '=', $token)->exists();
        } while ($tokenExists);

        return $token;
    }
}