<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Models\FileEntry;

class CreateDefaultFolders
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        if (settings('default_folders')) {
            $user = $event->user;
            $folders = explode(',', settings('default_folders'));
            foreach ($folders as $folder) {
                $fileEntry = new FileEntry;
                $fileEntry->ip = vIpInfo()->ip;
                $fileEntry->user_id = $user->id;
                $fileEntry->name = $folder;
                $fileEntry->filename = $folder;
                $fileEntry->type = "folder";
                $fileEntry->path_ids = hashid($fileEntry->getNextId(), 'short');
                $fileEntry->save();
            }
        }
    }
}
