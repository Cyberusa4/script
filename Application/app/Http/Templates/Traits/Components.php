<?php

namespace App\Http\Templates\Traits;

trait Components
{
    private static function singleOrMultipleFolders($totalFolders)
    {
        if ($totalFolders == 0 || $totalFolders > 1) {
            $totalFolders = str_replace('{count}', $totalFolders, lang('{count} folders', 'file manager'));
        } else {
            $totalFolders = str_replace('{count}', $totalFolders, lang('{count} folder', 'file manager'));
        }
        return $totalFolders;
    }

    private static function singleOrMultipleFiles($totalFiles)
    {
        if ($totalFiles == 0 || $totalFiles > 1) {
            $totalFiles = str_replace('{count}', $totalFiles, lang('{count} files', 'file manager'));
        } else {
            $totalFiles = str_replace('{count}', $totalFiles, lang('{count} file', 'file manager'));
        }
        return $totalFiles;
    }

    private static function singleOrMultipleDownloads($totalDownloads)
    {
        if ($totalDownloads == 0 || $totalDownloads > 1) {
            $totalDownloads = str_replace('{count}', $totalDownloads, lang('{count} downloads', 'file manager'));
        } else {
            $totalDownloads = str_replace('{count}', $totalDownloads, lang('{count} download', 'file manager'));
        }
        return $totalDownloads;
    }

    private static function fileLocked($fileEntry)
    {
        if ($fileEntry->password) {
            return '<span class="file-manager-files-item-lock"><i class="fa fa-lock"></i></span>';
        }
        return '';
    }

    public function emptyFolderTemplate()
    {
        return '<div class="empty"><h5 class="mb-0">' . lang("This Folder is Empty", "file manager") . '</h5></div>';
    }

    public function noSearchResultsTemplate($searchWord)
    {
        return '<div class="empty"><h5 class="mb-0">' . str_replace('{search_word}', $searchWord, lang('No results for "{search_word}"', 'file manager')) . '</h5></div>';
    }

    public function emptySidebarTemplate()
    {
        return '<div class="empty"> <p class="mb-0">' . lang("You Don't have any folders", "file manager") . '</p> <a data-bs-toggle="modal" data-bs-target="#filemanager-create-folder-modal">' . lang("Create Folder", "file manager") . '</a> </div>';
    }
}
