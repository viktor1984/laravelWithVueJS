<?php

namespace App\Jobs;

use App\Models\Commit;
use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class DownloadGitRepoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 1;

    /**
     * @var Project
     */
    private $project;

    /**
     * Create a new job instance.
     *
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->project = Project::findOrFail($id);
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \Exception
     */
    public function handle()
    {
        $this->project->status = Project::STATUS_PENDING;
        $this->project->save();

        $output = [];
        $secret = md5($this->project->owner . $this->project->repo . time());
        $destination = 'storage/app/repos/' . $secret;

        Storage::makeDirectory('repos/' . $secret);

        $command = vsprintf(
            'git clone https://github.com/%s/%s.git %s 2>&1',
            [
                escapeshellcmd($this->project->owner),
                escapeshellcmd($this->project->repo),
                escapeshellcmd($destination)
            ]
        );

        $result = exec($command);

        RemoveFolderJob::dispatch('repos/' . $secret . '/')
            ->delay(now()->addMinutes(5))
        ;

        if (false !== strpos($result, 'fatal')) {
            $this->generateError();
        }

        chdir($destination);
        unset($output);

        exec('git status', $output);

        if (empty($output)) {
            $this->generateError();
        }

        unset($output);

        exec('git log --oneline | sed \'s/^ \+/&HEAD~/\'', $output);

        if (!empty($output)) {
            $this->project->commits()->delete();
            $commits = [];

            foreach ($output as $item) {
                $parts = explode(' ', $item);
                $hash = array_shift($parts);
                $comment = implode(' ', $parts);

                if (mb_strlen($comment) > 50) {
                    $comment = mb_substr($comment, 0, 50);
                }

                $commits[] = new Commit(compact('hash', 'comment'));
            }

            $this->project->commits()->saveMany($commits);
            $this->project->status = Project::STATUS_SUCCESS;
            $this->project->save();
        }
    }

    /**
     * @throws \Exception
     */
    protected function generateError()
    {
        $this->project->status = Project::STATUS_FAIL;
        $this->project->save();

        throw new \Exception('Failed on cloning the repo ' .
            $this->project->owner .
            '/' .
            $this->project->repo
        );
    }
}
