<?php

namespace AlexGh12\ChangeLog\Commands;


use Illuminate\Console\Command;
class PublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ChangeLog:publish';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish ChangeLog configuration';


    /**
     * Execute the console command.
     */
    public function handle()
    {
		$this->call('vendor:publish', ['--tag' => 'ChangeLog:config', '--force' => true]);

    }
}
