<?php
namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class ImageUploadService {

  public static function fileUploadWithDirCreate($path, $file, $title, $onlyFileName = false, $defaultFileName = null) {

    $rand = Carbon::now()->timestamp . rand(10000, 99999);
    if (!File::exists($path)) {
      mkdir(public_path($path), 0777, true);
    }
    if (!$defaultFileName) {
      $fileName = trim($title) . '_' . $rand . '.' . $file->getClientOriginalExtension();
    } else {
      $fileName = $defaultFileName;
    }
    $file->move(public_path($path), $fileName);
    $path = $path . $fileName;
    if ($onlyFileName) {
      return $fileName;
    }
    return $path;

  }
}