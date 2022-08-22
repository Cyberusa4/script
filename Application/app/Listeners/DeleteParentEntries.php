<?php

namespace App\Listeners;

use App\Events\FileEntryDeleted;
use App\Models\FileEntry;

class DeleteParentEntries
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
     * @param  \App\Events\FileEntryDeleted  $event
     * @return void
     */
    public function handle(FileEntryDeleted $event)
    {
        $fileEntry = $event->fileEntry;
        if ($fileEntry->type == "folder") {
            $childrenEntries = FileEntry::where([['user_id', userAuthInfo()->id], ['path_ids', 'like', '%' . hashid($fileEntry->id) . '%']])->notExpired()->onlyTrashed()->get();
            foreach ($childrenEntries as $childEntry) {
                if ($childEntry->type != "folder") {
                    $handler = $childEntry->storageProvider->handler;
                    $handler::delete($childEntry->path);
                    $childEntry->forceDelete();
                } else {
                    $$childEntry->forceDelete();
                }
            }
            $fileEntry->forceDelete();
        } else {
            $handler = $fileEntry->storageProvider->handler;
            $handler::delete($fileEntry->path);
            $fileEntry->forceDelete();
        }
    }
}
