<?php

namespace App\Services;


use App\Exceptions\CustomUploadException;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadService
{
    /**
     * @param UploadedFile $file
     * @param string|NULL $uploadPath
     * @param string|NULL $for
     * @param string|NULL $fileName
     * @return string
     * @throws CustomUploadException
     */
    public static function save(
        UploadedFile $file,
        string       $uploadPath = NULL,
        string       $for = NULL,
        string       $fileName = NULL,
    ): string
    {
        if (!Storage::disk('public')->exists($uploadPath)) {
            Storage::disk('public')->makeDirectory($uploadPath);
            chmod(storage_path('app/public/' . $uploadPath), 0777);
        }

        if ($for && !self::validate($file, $for)) {
            throw new CustomUploadException('An error occurred while uploading the file. File extension and type do not match.');
        }
        $name = $file->getClientOriginalName();
        $ext = $file->extension();
        $originalName = pathinfo($name, PATHINFO_FILENAME);
        $currentDate = Carbon::now()->format('d_m_Y');
        if (!$fileName) {
            $fileName = Str::slug($originalName) . '_' . Str::random(5) . '_' . $currentDate;
        }
        if (Storage::disk('public')->exists($uploadPath . '/' . $fileName)) {
            $fileName = Str::slug($originalName) . '_' . Str::random(5) . '_' . $currentDate . '_' . time();
        }
        $fileName .= '.' . $ext;
        return 'storage/' . Storage::disk('public')->putFileAs($uploadPath, $file, $fileName);
    }

    /**
     * @param UploadedFile $file
     * @param string $for
     * @return bool
     */
    private static function validate(UploadedFile $file, string $for): bool
    {
        $allowedFileMimes = SettingsService::getAllowedFiles($for);
        $allowedFileMimeTypes = SettingsService::getAllowedFileMimeTypes($for);
        $mimeType = $file->getClientMimeType();
        $ext = $file->getClientOriginalExtension();

        $fileInfo = new \finfo(FILEINFO_MIME_TYPE);
        $realMimeType = $fileInfo->file($file->getRealPath());

        if (!in_array($ext, $allowedFileMimes['types'])) {
            return false;
        }

        if (!in_array($mimeType, $allowedFileMimeTypes)) {
            return false;
        }

        if (!in_array($realMimeType, $allowedFileMimeTypes)) {
            return false;
        }
        return true;
    }
}
