<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\File;
use Carbon\CarbonImmutable;
use Illuminate\Pagination\LengthAwarePaginator;
use Intervention\Image\Facades\Image;

if (!function_exists('public_path')) {
    /**
     * Return the path to public dir
     *
     * @param null $path
     *
     * @return string
     */
    function public_path($path = null)
    {
        return rtrim(app()->basePath('public/' . $path), '/');
    }
}

if (!function_exists('rupiah_format')) {
    function rupiah_format($number)
    {
        return "Rp. " . number_format($number, 0, ',', '.');
    }
}

if (!function_exists('idr')) {
    function idr($number)
    {
        return 'IDR ' . rupiah_format($number);
    }
}

if (!function_exists('df')) {
    function df($var)
    {
        header('Content-type: text/text');
        print_r($var);
        die;
    }
}

if (!function_exists('dm')) {
    function dm($var)
    {
        header('Content-type: text/text');
        print_r($var->toArray());
        die;
    }
}

if (!function_exists('dbl')) {
    function dbl()
    {
        DB::connection()->enableQueryLog();
    }
}

if (!function_exists('dbq')) {
    function dbq()
    {
        df(DB::getQueryLog());
    }
}

if (!function_exists('metaPagination')) {
    function metaPagination($data)
    {
        if (!$data) {
            $data = new LengthAwarePaginator(0, 0, 10);
        }

        return [
            'pagination' => [
                'total'         => $data->total(),
                'count'         => $data->count(),
                'per_page'      => $data->perPage(),
                'current_page'  => $data->currentPage(),
                'total_pages'   => $data->lastPage(),
                'has_more_page' => $data->hasMorePages(),
            ],
        ];
    }
}

if (!function_exists('rand_char')) {
    function rand_char($digits = 5)
    {
        return substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", $digits)), 0, 5);
    }
}

if (!function_exists('vincentyGreatCircleDistance')) {
    function vincentyGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
    {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $lonDelta = $lonTo - $lonFrom;
        $a = pow(cos($latTo) * sin($lonDelta), 2) + pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
        $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

        $angle = atan2(sqrt($a), $b);
        return $angle * $earthRadius; // to meter
    }
}

if (!function_exists('setFileUrl')) {
    function setFileUrl($file)
    {
        if (!$file) {
            return null;
        }
        return env('APP_URL') . '/' . $file;
    }
}

if (!function_exists('storeFile')) {
    function storeFile($path, $file)
    {
        return ($file && $path) ? Storage::disk('s3')->putFile($path, $file) : false;
    }
}

if (!function_exists('storeFileUrl')) {
    function storeFileUrl($path, $file)
    {
        if ($file && $path) {
            $temp = 'tmp/' . Str::random(40);
            Storage::put($temp, file_get_contents($file));
            $result = storeFile($path, new File(storage_path('app/' . $temp)));
            Storage::delete($temp);
            return $result;
        }
    }
}

if (!function_exists('deleteFile')) {
    function deleteFile($path)
    {
        return ($path) ? Storage::disk('s3')->delete($path) : false;
    }
}

if (!function_exists('carbonServerToClient')) {
    function carbonServerToClient($dateTime, $parseFormat = null, $of = null)
    {
        if ($of) {
            if ($parseFormat) return CarbonImmutable::createFromFormat($parseFormat, $dateTime, config('app.server_timezone'))->$of()->timezone(config('app.client_timezone'));
            return CarbonImmutable::parse($dateTime, config('app.server_timezone'))->$of()->timezone(config('app.client_timezone'));
        }

        if ($parseFormat) return CarbonImmutable::createFromFormat($parseFormat, $dateTime, config('app.server_timezone'))->timezone(config('app.client_timezone'));
        return CarbonImmutable::parse($dateTime, config('app.server_timezone'))->timezone(config('app.client_timezone'));
    }
}

if (!function_exists('carbonClientToServer')) {
    function carbonClientToServer($dateTime, $parseFormat = null, $of = null)
    {
        if ($of) {
            if ($parseFormat) return CarbonImmutable::createFromFormat($parseFormat, $dateTime, config('app.client_timezone'))->$of()->timezone(config('app.server_timezone'));
            return CarbonImmutable::parse($dateTime, config('app.client_timezone'))->$of()->timezone(config('app.server_timezone'));
        }

        if ($parseFormat) return CarbonImmutable::createFromFormat($parseFormat, $dateTime, config('app.client_timezone'))->timezone(config('app.server_timezone'));
        return CarbonImmutable::parse($dateTime, config('app.client_timezone'))->timezone(config('app.server_timezone'));
    }
}

if (!function_exists('carbonStateClient')) {
    function carbonStateClient($state, $of = null)
    {
        if ($of) return CarbonImmutable::$state(config('app.client_timezone'))->$of()->timezone(config('app.server_timezone'));
        return CarbonImmutable::$state(config('app.client_timezone'))->timezone(config('app.server_timezone'));
    }
}

if (!function_exists('setDayName')) {
    function setDayName($dayId)
    {
        switch ($dayId) {
            case CarbonImmutable::SUNDAY:
                return 'Sunday';
                break;
            case CarbonImmutable::MONDAY:
                return 'Monday';
                break;
            case CarbonImmutable::TUESDAY:
                return 'Tuesday';
                break;
            case CarbonImmutable::WEDNESDAY:
                return 'Wednesday';
                break;
            case CarbonImmutable::THURSDAY:
                return 'Thursday';
                break;
            case CarbonImmutable::FRIDAY:
                return 'Friday';
                break;
            case CarbonImmutable::SATURDAY:
                return 'Saturday';
                break;
            default:
                break;
        }
    }
}

if (!function_exists('encodePolyline')) {
    function encodePolyline($points)
    {
        $points = flattenPolyline($points);
        $encodedString = '';
        $index = 0;
        $previous = array(0, 0);
        foreach ($points as $number) {
            $number = (float) ($number);
            $number = (int) round($number * pow(10, 6));
            $diff = $number - $previous[$index % 2];
            $previous[$index % 2] = $number;
            $number = $diff;
            $index++;
            $number = ($number < 0) ? ~($number << 1) : ($number << 1);
            $chunk = '';
            while ($number >= 0x20) {
                $chunk .= chr((0x20 | ($number & 0x1f)) + 63);
                $number >>= 5;
            }
            $chunk .= chr($number + 63);
            $encodedString .= $chunk;
        }
        return $encodedString;
    }
}

if (!function_exists('decodePolyline')) {
    function decodePolyline($string)
    {
        $points = array();
        $index = $i = 0;
        $previous = array(0, 0);
        while ($i < strlen($string)) {
            $shift = $result = 0x00;
            do {
                $bit = ord(substr($string, $i++)) - 63;
                $result |= ($bit & 0x1f) << $shift;
                $shift += 5;
            } while ($bit >= 0x20);
            $diff = ($result & 1) ? ~($result >> 1) : ($result >> 1);
            $number = $previous[$index % 2] + $diff;
            $previous[$index % 2] = $number;
            $index++;
            $points[] = $number * 1 / pow(10, 6);
        }
        return array_chunk($points, 2);
    }
}

if (!function_exists('flattenPolyline')) {
    function flattenPolyline($array)
    {
        $flatten = array();
        array_walk_recursive(
            $array, // @codeCoverageIgnore
            function ($current) use (&$flatten) {
                $flatten[] = $current;
            }
        );
        return $flatten;
    }
}

if (!function_exists('calculateRating')) {
    function calculateRating($inputRating, $totalCurrentRating, $currentRating)
    {
        $newRating = ($currentRating * $totalCurrentRating) + $inputRating;
        return $newRating / ($totalCurrentRating + 1);
    }
}

if (!function_exists('calculateIndexId')) {
    function calculateIndexId($data)
    {
        if (count($data) === 0) {
            return [
                'id'    => 1,
                'index' => 0,
            ];
        }

        $lastIndex = count($data) - 1;

        return [
            'id'    => $data[$lastIndex]['id'] + 1,
            'index' => $lastIndex + 1
        ];
    }
}

if (!function_exists('monthlySubscriptionRange')) {
    function monthlySubscriptionRange($dateStart = '')
    {
        $dateStart = $dateStart == '' ? CarbonImmutable::now()->format('Y-m-d H:i:s') : $dateStart;
        return CarbonImmutable::parse($dateStart)->addDays(30)->format('Y-m-d H:i:s');
    }
}

if (!function_exists('yearlySubscriptionRange')) {
    function yearlySubscriptionRange($dateStart = '')
    {
        $dateStart = $dateStart == '' ? CarbonImmutable::now()->format('Y-m-d H:i:s') : $dateStart;
        return CarbonImmutable::parse($dateStart)->addDays(365)->format('Y-m-d H:i:s');
    }
}

if (!function_exists('resizeImage')) {
    function resizeImage($imageFile, $width = '300', $height = null)
    {
        if (is_object($imageFile)) {
            $imageResize = Image::make($imageFile->getRealPath());
        } elseif (is_string($imageFile)) {
            $imageResize = Image::make($imageFile);
        }

        return $imageResize->resize($width, $height);
    }
}

if (!function_exists('saveFile')) {
    function saveFile($file, $path, $filename = '')
    {
        $filename    = $filename ? $filename : $file->getClientOriginalName();
        $path        = "files/{$path}";
        $updloadPath = public_path($path);

        if (!file_exists($updloadPath)) {
            mkdir($updloadPath, 0775, true);
        }

        $file->move($updloadPath, $filename);

        return "{$path}/{$filename}";
    }
}

if (!function_exists('saveCompressImage')) {
    function saveCompressImage($imageFile, $path, $filename = '', $quality = 30)
    {
        if (is_object($imageFile)) {
            $imageResize = Image::make($imageFile->getRealPath())->encode('jpg');
        } elseif (is_string($imageFile)) {
            $imageFile = explode(',', $imageFile);
            $imageFile = $imageFile[count($imageFile) - 1];

            $imageResize = Image::make($imageFile);
        }

        $filename    = $filename ? $filename : $imageFile->getClientOriginalName();
        $path        = "images/{$path}";
        $updloadPath = public_path($path);

        if (!file_exists($updloadPath)) {
            mkdir($updloadPath, 0775, true);
        }

        $updloadPath = "{$updloadPath}/{$filename}.jpg";

        $imageResize->save($updloadPath, $quality);

        return "{$path}/{$filename}.jpg";
    }
}

if (!function_exists('timeToSeconds')) {
    function timeToSeconds($strTime)
    {
        sscanf($strTime, "%d:%d:%d", $hours, $minutes, $seconds);
        $timeSeconds = isset($hours) ? $hours * 3600 + $minutes * 60 + $seconds : $minutes * 60 + $seconds;

        return (int) $timeSeconds;
    }
}

if (!function_exists('duration')) {
    function duration($jamSelesai, $jamMulai)
    {
        $jamSelesai = CarbonImmutable::parse($jamSelesai);
        $jamMulai = CarbonImmutable::parse($jamMulai);

        if ($jamSelesai < $jamMulai) {
            $jamSelesai = $jamSelesai->addDay(1);
        }

        return $jamSelesai->diffInSeconds($jamMulai);
    }
}

if (!function_exists('isTwoTimeRangeOverlap')) {
    function isTwoTimeRangeOverlap($time1Start, $time1End, $time2Start, $time2End)
    {
        if ($time1Start < $time1End) {
            $time1Start = CarbonImmutable::parse($time1Start);
            $time1End   = CarbonImmutable::parse($time1End);
        } else {
            $time1Start = CarbonImmutable::parse($time1Start);
            $time1End   = CarbonImmutable::parse($time1End)->addDay(1);
        }

        if ($time2Start < $time2End) {
            $time2Start = CarbonImmutable::parse($time2Start);
            $time2End   = CarbonImmutable::parse($time2End);
        } else {
            $time2Start = CarbonImmutable::parse($time2Start);
            $time2End   = CarbonImmutable::parse($time2End)->addDay(1);
        }

        if ($time1Start <= $time2End && $time1End >= $time2Start) { // overlap
            return true;
        }

        return false;
    }
}

if (!function_exists('downloadHeader')) {
    function downloadHeader($filename)
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');
        header('Access-Control-Allow-Headers: Content-Type, Content-Disposition, Cache-Control, Authorization, X-Requested-With, X-CSRF-TOKEN, Access-Control-Expose-Headers, X-Timezone, X-Localization, Access-Control-Request-Headers, Access-Control-Request-Method');
        header('Content-Type: application/vnd.ms-excel');
        header('Access-Control-Expose-Headers: Content-Disposition');
        header("Content-Disposition: attachment;filename={$filename}");
        header('Cache-Control: max-age=0');
    }
}

if (!function_exists('timeAddMinutes')) {
    function timeAddMinutes($startTime, $endTime, $timeStep)
    {

        $startTime  = new \DateTime($startTime);
        $endTime    = new \DateTime($endTime);
        $timeArray  = array();

        while ($startTime <= $endTime) {
            $timeArray[] = $startTime->format('H:i');
            $startTime->add(new \DateInterval('PT' . $timeStep . 'M'));
        }

        return $timeArray;
    }
}

if (!function_exists('getMonth')) {
    function getMonthName($month)
    {
        $dateObj = DateTime::createFromFormat('!m', $month);
        return CarbonImmutable::parse($dateObj);
    }
}

if (!function_exists('asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param  string  $path
     * @param  bool    $secure
     * @return string
     */
    function asset($path, $secure = null)
    {
        return app('url')->asset($path, $secure);
    }
}
