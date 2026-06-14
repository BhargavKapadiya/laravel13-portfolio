<?php

namespace App\Helpers;

use Throwable;
use DOMDocument;
use Carbon\Carbon;
use App\Models\Blog;
use App\Models\Country;
use App\Models\Category;
use App\Models\SystemSetting;
use Illuminate\Support\Facades\File;
use App\Services\NotificationService;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class Helper
{
    // return assets path (like http://localhost/project/public/css or js or static images)
    public static function assets($path, $secure = null)
    {
        if (config('app.env') == "local") {
            return app('url')->asset($path, $secure);
        } else if (config('app.env') == "staging") {
            return app('url')->asset($path, $secure);
        } else if (config('app.env') == "production") {
            return app('url')->asset($path, $secure);
        }
        return app('url')->asset("public/" . $path, $secure);
    }

    // return documents (like flag ) relative path (like http://localhost/project/public)
    public static function media($path, $secure = null)
    {
        if (config('app.env') == "local") {
            return app('url')->asset($path, $secure);
        } else if (config('app.env') == "staging") {
            return app('url')->asset($path, $secure);
        } else if (config('app.env') == "production") {
            return app('url')->asset($path, $secure);
        }
        return app('url')->asset("public/" . $path, $secure);
    }

    // Upload Images, Documents, Videos, etc.
    public static function uploadFile($fileData = Null, $path = Null, $filename = Null, $oldFilename = null)
    {
        if (!is_null($fileData)) {
            if (config('app.env') == "local") {
                $fileData->move(public_path() . $path, $filename);

                if (!is_null($oldFilename) && file_exists(public_path() . $path . $oldFilename)) {
                    unlink(public_path() . $path . $oldFilename);
                }
            } else if (config('app.env') == "staging") {
                $fileData->move(public_path() . $path, $filename);

                if (!is_null($oldFilename) && file_exists(public_path() . $path . $oldFilename)) {
                    unlink(public_path() . $path . $oldFilename);
                }
            } else if (config('app.env') == "production") {
                $fileData->move(public_path() . $path, $filename);

                if (!is_null($oldFilename) && file_exists(public_path() . $path . $oldFilename)) {
                    unlink(public_path() . $path . $oldFilename);
                }
            }

            self::optimizeImage($path, $filename);

            return self::assets($path . $filename);
        }
        return false;
    }

    // Delete a File
    public static function deleteFile($path = Null, $filename = Null)
    {
        if (!is_null($filename) && !empty($filename)) {
            if (config('app.env') == "local") {
                if (file_exists(public_path() . $path . $filename)) {
                    unlink(public_path() . $path . $filename);
                }
            } else if (config('app.env') == "staging") {
                if (file_exists(public_path() . $path . $filename)) {
                    unlink(public_path() . $path . $filename);
                }
            } else if (config('app.env') == "production") {
                if (file_exists(public_path() . $path . $filename)) {
                    unlink(public_path() . $path . $filename);
                }
            }
        }
        return true;
    }

    // Delete a File
    public static function deleteDirectory($path = Null)
    {
        if (!is_null($path)) {
            if (config('app.env') == "local") {
                if (is_dir(public_path() . $path)) {
                    File::deleteDirectory(public_path() . $path);
                }
            } else if (config('app.env') == "staging") {
                if (is_dir(public_path() . $path)) {
                    File::deleteDirectory(public_path() . $path);
                }
            } else if (config('app.env') == "production") {
                if (is_dir(public_path() . $path)) {
                    File::deleteDirectory(public_path() . $path);
                }
            }
        }
        return true;
    }

    // Check file exists or not - return absolute path (Full path like - var/wwww/html/project/public) with filename
    public static function checkFileExists($path, $filename)
    {
        if (config('app.env') == "local") {
            if (file_exists(public_path() . $path . $filename)) {
                return public_path() . $path . $filename;
            }
        } else if (config('app.env') == "staging") {
            if (file_exists(public_path() . $path . $filename)) {
                return public_path() . $path . $filename;
            }
        } else if (config('app.env') == "production") {
            if (file_exists(public_path() . $path . $filename)) {
                return public_path() . $path . $filename;
            }
        }
        return "";
    }

    // Copy file from one location to another location
    public static function copyFile($sourceFilepath = Null, $destinationFilepath = null, $filename = null, $isDeleteSourceFile = true)
    {
        if (!is_null($sourceFilepath) && !is_null($destinationFilepath) && !is_null($filename)) {
            if (config('app.env') == "local") {
                if (file_exists(public_path() . $sourceFilepath . $filename)) {
                    copy(public_path() . $sourceFilepath . $filename, public_path() . $destinationFilepath . $filename);
                    if ($isDeleteSourceFile) {
                        unlink(public_path() . $sourceFilepath . $filename);
                    }
                }
            } else if (config('app.env') == "staging") {
                if (file_exists(public_path() . $sourceFilepath . $filename)) {
                    copy(public_path() . $sourceFilepath . $filename, public_path() . $destinationFilepath . $filename);
                    if ($isDeleteSourceFile) {
                        unlink(public_path() . $sourceFilepath . $filename);
                    }
                }
            } else if (config('app.env') == "production") {
                if (file_exists(public_path() . $sourceFilepath . $filename)) {
                    copy(public_path() . $sourceFilepath . $filename, public_path() . $destinationFilepath . $filename);
                    if ($isDeleteSourceFile) {
                        unlink(public_path() . $sourceFilepath . $filename);
                    }
                }
            }
        }
        return true;
    }

    // Optimize image size
    public static function optimizeImage($path, $filename)
    {
        try {
            if ($pathToImage = self::checkFileExists($path, $filename)) {
                $optimizerChain = OptimizerChainFactory::create();
                $optimizerChain->optimize($pathToImage);
            }
        } catch (Throwable $e) {
            report('Helper ' . $e);
        }
    }

    // Create image thumbnail
    public static function createThumbnail($path, $filename)
    {
        try {
            if ($pathToImage = self::checkFileExists($path, $filename)) {
                $filePath = self::assets($path . $filename);
                $ext =  pathinfo(parse_url($filePath, PHP_URL_PATH), PATHINFO_EXTENSION);
                $width = 60;
                $height = 60;

                list($width_orig, $height_orig) = getimagesize($filePath);

                $new_width  =   $width;
                $new_height =   floor($height_orig * ($new_width / $width_orig));
                $crop_x     =   0;
                $crop_y     =   ceil(($height - $width) / 2);
                $ratio_orig = $width_orig / $height_orig;
                $height = $height;
                $width = $width;

                $image_p = imagecreatetruecolor($width, $height);

                if ($ext == 'jpeg' || $ext == 'jpg' || exif_imagetype($filePath) === 2) {
                    $image = imagecreatefromjpeg($filePath);
                } else if ($ext == 'png' || exif_imagetype($filePath) === 3) {
                    $image = imagecreatefrompng($filePath);
                } else if ($ext == 'webp' || exif_imagetype($filePath) === 18) {
                    $image = imagecreatefromwebp($filePath);
                }

                imagecopyresampled($image_p, $image, 0, 0, $crop_x, $crop_y, $new_width, $new_height, $width_orig, $height_orig);

                if ($ext == 'jpeg' || $ext == 'jpg' || exif_imagetype($filePath) === 2) {
                    imagejpeg($image_p, public_path() . $path . 'thumb/' . $filename, 100);
                } else if ($ext == 'png' || exif_imagetype($filePath) === 3) {
                    imagepng($image_p, public_path() . $path . 'thumb/' . $filename, 9);
                } else if ($ext == 'webp' || exif_imagetype($filePath) === 18) {
                    imagewebp($image_p, public_path() . $path . 'thumb/' . $filename, 9);
                }
            }
        } catch (Throwable $e) {
            report('Helper ' . $e);
        }
    }

    public static function getHumanReadableFormat($datetime, $format = "")
    {
        $datetime = Carbon::createFromTimeStamp(strtotime($datetime));
        if ($format != "") {
            return $datetime->format($format);
        }
        if ($datetime->isToday()) {
            return 'Today';
        } else if ($datetime->isYesterday()) {
            return 'Yesterday';
        } else if ($datetime->diffInDays(Carbon::now()) < 7) {
            return $datetime->diffForHumans();
        }
        return $datetime->format('d/m/Y');
    }

    public static function replaceImagePath($text = "", $path)
    {
        $htmlDom = new DOMDocument();
        $htmlDom->loadHTML($text);
        $imageTags = $htmlDom->getElementsByTagName('img');
        if (!empty($imageTags)) {
            foreach ($imageTags as $imageTag) {
                $imgSrc = $imageTag->getAttribute('src');
                if ($imgSrc) {
                    $file = pathinfo($imgSrc);
                    $filename = $file['basename'];
                    self::copyFile(config('constant.temp_file_url'), $path, $filename);
                }
            }
            $text = str_replace(config('constant.temp_file_url'), $path, $text);
        }

        $inputTags = $htmlDom->getElementsByTagName('input');
        if (!empty($inputTags)) {
            foreach ($inputTags as $inputTag) {
                $imgType = $inputTag->getAttribute('type');
                if ($imgType == "image") {
                    $imgSrc = $inputTag->getAttribute('src');
                    if ($imgSrc) {
                        $file = pathinfo($imgSrc);
                        $filename = $file['basename'];
                        self::copyFile(config('constant.temp_file_url'), $path, $filename);
                    }
                }
            }
            $text = str_replace(config('constant.temp_file_url'), $path, $text);
        }

        return $text;
    }

    // Get all Settings
    public static function getSetting($id = 1)
    {
        $Setting = SystemSetting::select('*');
        if (!is_null($id)) {
            $Setting->where('id', $id);
        }
        return $Setting->first();
    }

    // Get all countries
    public static function getCountry($params = [])
    {
        $records = Country::select('*')
            ->when((isset($params['status'])), function ($query) use ($params) {
                $query->where('status', $params['status']);
            }, function ($query) {
                $query->where('status', 1);
            })->when((isset($params['isd_code'])), function ($query) use ($params) {
                $query->orderBy('isd_code', $params['isd_code']);
            });

        if (isset($params['id']) && !empty($params['id'])) {
            return $records->where('id', $params['id'])->first();
        }
        return $records->get();
    }

    // Get all categories
    public static function getCategory($params = [])
    {
        $categories = Category::select('*');
        if (isset($params['id']) && !empty($params['id'])) {
            return $categories->where('id', $params['id'])->first();
        }
        return $categories->get();
    }

    // Create slug for url
    public static function createSlug($title, $id = null, $type = "blog")
    {
        // Normalize the title
        $slug = $title;

        $i = 1;
        $new_slug = $slug;

        while (self::getRelatedSlugs($new_slug, $id, $type)) {
            $new_slug = $slug . '-' . $i;
            $i++;
        }

        return $new_slug;
    }

    // check slug already exists
    public static function getRelatedSlugs($slug, $id = null, $type = "blog")
    {
        if ($type == "blog") {
            $data = Blog::select('slug');
        } else {
            $data = null;
        }
        if ($data != null) {
            $data->where('slug', 'like', $slug . '%');
            if ($id != null) {
                $data->where('id', '<>', $id);
            }
            return $data->exists();
        }
        return false;
    }

    /**
     * Convert In Html
     *
     * @param  mixed $msg
     * @return void
     */
    public static function convertInHtml($msg = "")
    {
        $url = '@(http(s)?)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@';
        $msg = preg_replace(
            $url,
            '<a href="http$2://$4" target="_blank">$0</a>',
            $msg
        );
        $msg = str_ireplace(
            array("\r\n\t", '\r\n\t', "\r\n", '\r\n', "\n", '\n', "\t", '\t'),
            '<br/>',
            $msg
        );
        return $msg;
    }

    /**
     * Get Prefix Based On Extension
     *
     * @param  mixed $ext
     * @return void
     */
    public static function getPrefixBasedOnExtension($ext = "")
    {
        $prefix = "";
        if (in_array($ext, ['png', 'jpeg', 'jpg', 'svg', 'gif'])) {
            $prefix = "IMG";
        } else if (in_array($ext, ['mp4', 'mkv', 'webm', 'mov'])) {
            $prefix = "VID";
        } else if (in_array($ext, ['pdf'])) {
            $prefix = "PDF";
        } else if (in_array($ext, ['doc', 'docx'])) {
            $prefix = "DOC";
        }
        return $prefix;
    }

    /**
     * Find Distance
     *
     * @param  mixed $latitude
     * @param  mixed $longitude
     * @return void
     */
    public static function findDistance($latitude, $longitude)
    {
        return "(6371 * acos(cos(radians($latitude))
        * cos(radians(latitude))
        * cos(radians(longitude)
        - radians($longitude))
        + sin(radians($latitude))
        * sin(radians(latitude))))";
    }

    /**
     * Social Media Share Url
     *
     * @param  mixed $type
     * @param  mixed $link
     * @param  mixed $message
     * @param  mixed $param
     * @return void
     */
    public static function socialMediaShareUrl($type, $link, $message, $param = '')
    {
        $url = '';
        switch ($type) {
            case 'fb':
                $url = config('constant.facebook_share_url');
                $url = str_replace('{href}', $link, $url);
                $url = str_replace('{redirect_uri}', $link, $url);
                $url = str_replace('{quote}', $message, $url);
                break;
            case 'twit':
                $url = config('constant.twitter_share_url');
                $url = str_replace('{url}', $link, $url);
                $url = str_replace('{text}', $message, $url);
                break;

            default:
                break;
        }
        return $url;
    }

    /**
     * groupByDate
     *
     * @param  mixed $records
     * @return void
     */
    public static function groupByDate($records)
    {
        return $records->groupBy(function ($item) {
            $createdAt = Carbon::parse($item->created_at);
            if ($createdAt->isToday()) {
                return 'TODAY';
            } elseif ($createdAt->isYesterday()) {
                return 'YESTERDAY';
            } elseif ($createdAt->isCurrentWeek()) {
                return 'THIS WEEK';
            } elseif ($createdAt->format('W') == Carbon::now()->subWeek()->format('W')) {
                return 'LAST WEEK';
            } elseif ($createdAt->isCurrentMonth()) {
                return 'THIS MONTH';
            } elseif ($createdAt->format('m-Y') == Carbon::now()->subMonth()->format('m-Y')) {
                return 'LAST MONTH';
            } else {
                return 'OLDER';
            }
        });
    }

    /**
     * getFileSize
     *
     * @param  mixed $attachment
     * @return void
     */
    public static function getFileSize($attachment)
    {
        return self::convertToReadableSize(filesize($attachment));
    }

    /**
     * convertToReadableSize
     *
     * @param  mixed $size
     * @return void
     */
    public static function convertToReadableSize($size)
    {
        $base = log($size) / log(1024);
        $suffix = array("", "KB", "MB", "GB", "TB");
        $f_base = floor($base);
        return round(pow(1024, $base - floor($base)), 1) . $suffix[$f_base];
    }

    /**
     * get notifications
     *
     * @param  mixed $size
     * @return void
     */
    public static function getNotification($params = array())
    {
        try {
            return NotificationService::getNotification($params);
        } catch (Throwable $e) {
            report($e);
            return "";
        }
    }

    /**
     * Encrypted ID
     *
     * @param  mixed $id
     * @return mixed
     */
    public static function getEncryptedId($id)
    {
        $encrypted_string = openssl_encrypt($id, config('services.encryption.type'), config('services.encryption.secret'), 0, config('services.encryption.encryption_iv'));
        return base64_encode($encrypted_string);
    }

    /**
     * Decrypt Encrypted ID
     *
     * @param  mixed $id
     * @return mixed
     */
    public static function getDecryptedId($secret)
    {
        return openssl_decrypt(base64_decode($secret), config('services.encryption.type'), config('services.encryption.secret'), 0, config('services.encryption.encryption_iv'));
    }
}
