<?php

namespace App\Http\Templates;

use App\Http\Templates\Traits\Components;

class FilesTemplate
{
    use Components;

    public static function item($item)
    {
        if ($item->type == "folder") {
            return static::folderTemplate($item);
        } elseif ($item->type == "file") {
            return static::fileTemplate($item);
        } elseif ($item->type == "pdf") {
            return static::pdfTemplate($item);
        } elseif ($item->type == "image") {
            return static::imageTemplate($item);
        } else {
            return '';
        }
    }

    protected static function folderTemplate($folder)
    {
        $template = '<div class="file-manager-files-item">
        <div class="file-manager-files-item-select">
            <input type="checkbox" class="filemanager-select-file-checkbox" data-id="' . hashid($folder->id) . '" hidden />
            <div class="select-icon">
                <i class="fa fa-check"></i>
            </div>
        </div>
        <a href="' . route('filemanager.showFolder', hashid($folder->id)) . '" class="file-manager-files-item-icon">
            <i class="fa fa-folder"></i>
        </a>
        <div class="file-manager-files-item-title">
            <a href="' . route('filemanager.showFolder', hashid($folder->id)) . '" class="file-manager-files-item-name">' . $folder->name . '</a>
            <span class="file-manager-files-item-text">
                ' . static::singleOrMultipleFolders($folder->total_folders) . ', ' . static::singleOrMultipleFiles($folder->total_files) . '
            </span>
        </div>
        <div class="file-manager-files-item-meta">
            <time class="file-manager-files-item-date">' . vDate($folder->created_at) . '</time>
            <div class="file-option">
                <div class="file-option-button">
                    <i class="fa fa-ellipsis-v"></i>
                </div>
                <div class="file-option-menu">
                    <a class="filemanager-rename-file link"
                       data-filename="' . $folder->name . '"
                       data-link="' . route('filemanager.rename', hashid($folder->id)) . '">
                        <i class="far fa-edit"></i>
                        ' . lang('Rename', 'file manager') . '
                    </a>
                    <a class="link text-danger trash-file file-option-divider" data-link="' . route('filemanager.trash.single', hashid($folder->id)) . '">
                        <i class="far fa-trash-alt"></i>
                        ' . lang('Move to Trash', 'file manager') . '
                    </a>
                </div>
            </div>
        </div>
        </div>';
        return $template;
    }

    protected static function imageTemplate($image)
    {
        $template = '<div class="file-manager-files-item">
        <div class="file-manager-files-item-select">
            <input type="checkbox" class="filemanager-select-file-checkbox" data-id="' . hashid($image->id) . '" hidden />
            <div class="select-icon">
                <i class="fa fa-check"></i>
            </div>
        </div>
        <div class="file-manager-files-item-icon">
            <img src="' . route('secure.file', hashid($image->id)) . '" title="' . $image->name . '" alt="' . $image->name . '" />
        </div>
        <div class="file-manager-files-item-title">
            <div class="file-manager-files-item-name">' . $image->name . '</div>
            <span class="file-manager-files-item-text">
               ' . static::singleOrMultipleDownloads($image->downloads) . ', ' . formatBytes($image->size) . '
            </span>
        </div>
        <div class="file-manager-files-item-meta">
            ' . static::fileLocked($image) . '
            <time class="file-manager-files-item-date">' . vDate($image->created_at) . '</time>
            <div class="file-option">
                <div class="file-option-button">
                    <i class="fa fa-ellipsis-v"></i>
                </div>
                <div class="file-option-menu">
                    <a class="link" href="' . route('file.preview', $image->shared_id) . '" target="_blank">
                        <i class="fa fa-eye"></i>
                        ' . lang('Preview', 'file manager') . '
                    </a>
                    <a class="filemanager-share-file link" data-link="' . route('filemanager.share', $image->shared_id) . '">
                        <i class="fa fa-share-alt"></i>
                        ' . lang('Share', 'file manager') . '
                    </a>
                    <a class="link" href="' . route('file.download', $image->shared_id) . '" target="_blank">
                        <i class="fas fa-download"></i>
                        ' . lang('Download', 'file manager') . '
                    </a>
                    <a class="filemanager-rename-file link file-option-divider"
                       data-filename="' . $image->name . '"
                       data-link="' . route('filemanager.rename', hashid($image->id)) . '">
                        <i class="far fa-edit"></i>
                        ' . lang('Rename', 'file manager') . '
                    </a>
                    <a class="filemanager-file-protection link" data-link="' . route('filemanager.protection', hashid($image->id)) . '">
                        <i class="fa fa-lock"></i>
                        ' . lang('Protection', 'file manager') . '
                    </a>
                    <a class="link text-danger trash-file file-option-divider" data-link="' . route('filemanager.trash.single', hashid($image->id)) . '">
                        <i class="far fa-trash-alt"></i>
                        ' . lang('Move to Trash', 'file manager') . '
                    </a>
                </div>
            </div>
        </div>
        </div>';
        return $template;
    }

    protected static function pdfTemplate($pdf)
    {
        $template = '<div class="file-manager-files-item">
        <div class="file-manager-files-item-select">
            <input type="checkbox" class="filemanager-select-file-checkbox" data-id="' . hashid($pdf->id) . '" hidden />
            <div class="select-icon">
                <i class="fa fa-check"></i>
            </div>
        </div>
        <div class="file-manager-files-item-icon">' . fileIcon($pdf->extension, 'vi-sm') . '</div>
        <div class="file-manager-files-item-title">
            <div class="file-manager-files-item-name">' . $pdf->name . '</div>
            <span class="file-manager-files-item-text">
                ' . static::singleOrMultipleDownloads($pdf->downloads) . ', ' . formatBytes($pdf->size) . '
            </span>
        </div>
        <div class="file-manager-files-item-meta">
           ' . static::fileLocked($pdf) . '
           <time class="file-manager-files-item-date">' . vDate($pdf->created_at) . '</time>
            <div class="file-option">
                <div class="file-option-button">
                    <i class="fa fa-ellipsis-v"></i>
                </div>
                <div class="file-option-menu">
                    <a class="link" href="' . route('file.preview', $pdf->shared_id) . '" target="_blank">
                        <i class="fa fa-eye"></i>
                        ' . lang('Preview', 'file manager') . '
                    </a>
                    <a class="filemanager-share-file link" data-link="' . route('filemanager.share', $pdf->shared_id) . '">
                        <i class="fa fa-share-alt"></i>
                        ' . lang('Share', 'file manager') . '
                    </a>
                    <a class="link" href="' . route('file.download', $pdf->shared_id) . '" target="_blank">
                        <i class="fas fa-download"></i>
                        ' . lang('Download', 'file manager') . '
                    </a>
                    <a class="filemanager-rename-file link file-option-divider"
                       data-filename="' . $pdf->name . '"
                       data-link="' . route('filemanager.rename', hashid($pdf->id)) . '">
                        <i class="far fa-edit"></i>
                        ' . lang('Rename', 'file manager') . '
                    </a>
                    <a class="filemanager-file-protection link" data-link="' . route('filemanager.protection', hashid($pdf->id)) . '">
                        <i class="fa fa-lock"></i>
                        ' . lang('Protection', 'file manager') . '
                    </a>
                    <a class="link text-danger trash-file file-option-divider" data-link="' . route('filemanager.trash.single', hashid($pdf->id)) . '">
                        <i class="far fa-trash-alt"></i>
                        ' . lang('Move to Trash', 'file manager') . '
                    </a>
                </div>
            </div>
        </div>
        </div>';
        return $template;
    }

    protected static function fileTemplate($file)
    {
        $template = '<div class="file-manager-files-item">
        <div class="file-manager-files-item-select">
            <input type="checkbox" class="filemanager-select-file-checkbox" data-id="' . hashid($file->id) . '" hidden />
            <div class="select-icon">
                <i class="fa fa-check"></i>
            </div>
        </div>
        <div class="file-manager-files-item-icon">' . fileIcon($file->extension, 'vi-sm') . '</div>
        <div class="file-manager-files-item-title">
            <div class="file-manager-files-item-name">' . $file->name . '</div>
            <span class="file-manager-files-item-text">
                ' . static::singleOrMultipleDownloads($file->downloads) . ', ' . formatBytes($file->size) . '
            </span>
        </div>
        <div class="file-manager-files-item-meta">
           ' . static::fileLocked($file) . '
           <time class="file-manager-files-item-date">' . vDate($file->created_at) . '</time>
            <div class="file-option">
                <div class="file-option-button">
                    <i class="fa fa-ellipsis-v"></i>
                </div>
                <div class="file-option-menu">
                    <a class="filemanager-share-file link" data-link="' . route('filemanager.share', $file->shared_id) . '">
                        <i class="fa fa-share-alt"></i>
                        ' . lang('Share', 'file manager') . '
                    </a>
                    <a class="link" href="' . route('file.download', $file->shared_id) . '" target="_blank">
                        <i class="fas fa-download"></i>
                        ' . lang('Download', 'file manager') . '
                    </a>
                    <a class="filemanager-rename-file link file-option-divider"
                       data-filename="' . $file->name . '"
                       data-link="' . route('filemanager.rename', hashid($file->id)) . '">
                        <i class="far fa-edit"></i>
                        ' . lang('Rename', 'file manager') . '
                    </a>
                    <a class="filemanager-file-protection link" data-link="' . route('filemanager.protection', hashid($file->id)) . '">
                        <i class="fa fa-lock"></i>
                        ' . lang('Protection', 'file manager') . '
                    </a>
                    <a class="link text-danger trash-file file-option-divider" data-link="' . route('filemanager.trash.single', hashid($file->id)) . '">
                        <i class="far fa-trash-alt"></i>
                        ' . lang('Move to Trash', 'file manager') . '
                    </a>
                </div>
            </div>
        </div>
        </div>';
        return $template;
    }

    public static function fileManagerSidebarFolderTemplate($folder)
    {
        return '<a href="' . route('filemanager.showFolder', hashid($folder->id)) . '" class="file-manager-folder">
        <div class="file-manager-folder-icon">
            <i class="fa fa-folder"></i>
        </div>
        <span class="file-manager-folder-title">' . $folder->name . '</span>
        </a>';
    }

}
