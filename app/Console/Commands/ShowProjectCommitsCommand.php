<?php

namespace App\Console\Commands;

use App\Models\Project;
use Illuminate\Console\Command;

class ShowProjectCommitsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'repo:commits {owner} {repo}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show repo Commits list';

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

        /** @var Project $project */
        $project =
            Project::where([
                'owner' => $owner,
                'repo' => $repo,
            ])
            ->first()
        ;

        if (!$project) {
            $this->line('project not found.');

            return 1;
        }

        $this->line('project has ' . $project->commits->count() . ' commits');

        $result = $this->choice('show the commits?', ['yes', 'no'], 'yes');

        if ('no' == $result) {
            $this->line('Bye.');

            return 1;
        }

        $headers = ['Id', 'Hash', 'Comment'];
        $offset = 0;

        while (true) {
            $commits = $project->commits()->limit(20)->offset($offset)->get()->toArray();
            $this->table($headers, $commits);

            if (count($commits) < 20) {
                $this->line('The last page.');

                break;
            }

            $result = $this->choice('show next page?', ['yes', 'no'], 'yes');

            if ('no' == $result) {
                break;
            }

            $offset += 20;
        }

        $this->line('Bye.');

        return 0;
    }
}
