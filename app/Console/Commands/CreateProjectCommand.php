<?php

namespace App\Console\Commands;

use App\Jobs\DownloadGitRepoJob;
use App\Models\Project;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class CreateProjectCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'repo:create {owner} {repo}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download repo by owner repo.';

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
     * @return mixed
     */
    public function handle()
    {
        $owner = $this->argument('owner');
        $repo = $this->argument('repo');

        $project =
            Project::firstOrCreate([
                'owner' => $owner,
                'repo' => $repo,
            ])
        ;

        DownloadGitRepoJob::dispatch($project->id);

        return 0;
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['owner', InputArgument::REQUIRED, 'The owner of the repo'],
            ['repo', InputArgument::REQUIRED, 'The name of the repo'],
        ];
    }
}
