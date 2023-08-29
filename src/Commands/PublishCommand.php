<?php

namespace AlexGh12\ChangeLog\Commands;


use Illuminate\Console\Command;

class PublishCommand extends Command
{
    protected $signature = 'ChangeLog:publish';

    protected $description = 'Publish ChangeLog configuration';

    public function handle()
    {
		$this->call('vendor:publish', ['--tag' => 'ChangeLog:config', '--force' => true]);
    }
}
