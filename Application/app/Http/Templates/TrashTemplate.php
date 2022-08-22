<?php

namespace App\Http\Templates;

use App\Http\Templates\Traits\Components;

class TrashTemplate
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
        <div class="file-manager-files-item-icon">
            <i class="fa fa-folder"></i>
        </div>
        <div class="file-manager-files-item-title">
            <div class="file-manager-files-item-name">' . $folder->name . '</div>
            <span class="file-manager-files-item-text">' . vDate($folder->created_at) . '</span>
        </div>
        <div class="file-manager-files-item-meta">
            <time class="file-manager-files-item-date">' . $folder->deleted_at->diffForHumans() . '</time>
            <div class="file-option">
                <div class="file-option-button">
                    <i class="fa fa-ellipsis-v"></i>
                </div>
                <div class="file-option-menu">
                    <a class="filemanager-trash-restore-file link" data-url="' . route('filemanager.trash.restore', hashid($folder->id)) . '">
                        <i class="fas fa-redo"></i>
                        ' . lang('Restore', 'file manager') . '
                    </a>
                    <a class="filemanager-trash-delete-file link text-danger file-option-divider" data-url="' . route('filemanager.trash.delete', hashid($folder->id)) . '">
                        <i class="far fa-trash-alt"></i>
                        ' . lang('Delete Forever', 'file manager') . '
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
            <span class="file-manager-files-item-text">' . vDate($image->created_at) . '</span>
        </div>
        <div class="file-manager-files-item-meta">
            ' . static::fileLocked($image) . '
            <time class="file-manager-files-item-date">' . $image->deleted_at->diffForHumans() . '</time>
            <div class="file-option">
                <div class="file-option-button">
                    <i class="fa fa-ellipsis-v"></i>
                </div>
                <div class="file-option-menu">
                    <a class="filemanager-trash-restore-file link" data-url="' . route('filemanager.trash.restore', hashid($image->id)) . '">
                        <i class="fas fa-redo"></i>
                        ' . lang('Restore', 'file manager') . '
                    </a>
                    <a class="filemanager-trash-delete-file link text-danger file-option-divider" data-url="' . route('filemanager.trash.delete', hashid($image->id)) . '">
                        <i class="far fa-trash-alt"></i>
                        ' . lang('Delete Forever', 'file manager') . '
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
            <span class="file-manager-files-item-text">' . vDate($pdf->created_at) . '</span>
        </div>
        <div class="file-manager-files-item-meta">
           ' . static::fileLocked($pdf) . '
           <time class="file-manager-files-item-date">' . $pdf->deleted_at->diffForHumans() . '</time>
            <div class="file-option">
                <div class="file-option-button">
                    <i class="fa fa-ellipsis-v"></i>
                </div>
                <div class="file-option-menu">
                    <a class="filemanager-trash-restore-file link" data-url="' . route('filemanager.trash.restore', hashid($pdf->id)) . '">
                        <i class="fas fa-redo"></i>
                        ' . lang('Restore', 'file manager') . '
                    </a>
                    <a class="filemanager-trash-delete-file link text-danger file-option-divider" data-url="' . route('filemanager.trash.delete', hashid($pdf->id)) . '">
                        <i class="far fa-trash-alt"></i>
                        ' . lang('Delete Forever', 'file manager') . '
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
            <span class="file-manager-files-item-text">' . vDate($file->created_at) . '</span>
        </div>
        <div class="file-manager-files-item-meta">
           ' . static::fileLocked($file) . '
           <time class="file-manager-files-item-date">' . $file->deleted_at->diffForHumans() . '</time>
            <div class="file-option">
                <div class="file-option-button">
                    <i class="fa fa-ellipsis-v"></i>
                </div>
                <div class="file-option-menu">
                    <a class="filemanager-trash-restore-file link" data-url="' . route('filemanager.trash.restore', hashid($file->id)) . '">
                        <i class="fas fa-redo"></i>
                        ' . lang('Restore', 'file manager') . '
                    </a>
                    <a class="filemanager-trash-delete-file link text-danger file-option-divider" data-url="' . route('filemanager.trash.delete', hashid($file->id)) . '">
                        <i class="far fa-trash-alt"></i>
                        ' . lang('Delete Forever', 'file manager') . '
                    </a>
                </div>
            </div>
        </div>
        </div>';
        return $template;
    }
}
