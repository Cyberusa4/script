<?php

namespace App\Http\Methods;

use App\Models\FileEntry;
use App\Models\Plan;
use App\Models\UploadSettings;
use Auth;
use Carbon\Carbon;

class SubscriptionManager
{
    public static function registredUserSubscriptionDetails($user)
    {
        $data = static::NON_SUBSCRIBE;
        if (licenceType(2)) {
            if ($user->subscription) {
                $data = [
                    "is_subscribed" => ($user->subscription) ? true : false,
                    "is_lifetime" => ($user->subscription->plan->interval == 3) ? true : false,
                    "is_canceled" => (!$user->subscription->status) ? true : false,
                    "is_expired" => ($user->subscription->plan->interval != 3) ? isExpiry($user->subscription->expiry_at) : false,
                    "dates" => [
                        "subscribing" => vDate($user->subscription->created_at),
                        "expiration" => vDate($user->subscription->expiry_at),
                        "updating" => vDate($user->subscription->updated_at),
                        "original" => [
                            "subscribing" => $user->subscription->created_at,
                            "expiration" => $user->subscription->expiry_at,
                            "updating" => $user->subscription->updated_at,
                        ],
                    ],
                    "days" => [
                        "remining" => static::reminingDays($user->subscription->expiry_at),
                    ],
                    "plan" => $user->subscription->plan,
                    "formates" => [
                        'price' => priceSymbol($user->subscription->plan->price),
                        'storage_space' => static::storageSpace($user->subscription->plan->storage_space),
                        'file_size' => static::maxFileSize($user->subscription->plan->file_size),
                        'files_duration' => static::filesDuration($user->subscription->plan->files_duration),
                    ],
                    "storage" => [
                        "used" => [
                            "number" => static::getClientUsedSpace(),
                            "format" => formatBytes(static::getClientUsedSpace()),
                        ],
                        "remining" => [
                            "number" => $user->subscription->plan->storage_space ? ($user->subscription->plan->storage_space-static::getClientUsedSpace()) : null,
                            "format" => $user->subscription->plan->storage_space ? formatBytes(($user->subscription->plan->storage_space-static::getClientUsedSpace())) : null,
                        ],
                        "fullness" => static::storageFullness($user->subscription->plan),
                    ],
                ];
            }
        } else {
            $uploadSetting = UploadSettings::where('symbol', 'users')->first();
            $data = [
                "is_subscribed" => true,
                "is_lifetime" => false,
                "is_canceled" => false,
                "is_expired" => false,
                "plan" => $uploadSetting,
                "formates" => [
                    'storage_space' => static::storageSpace($uploadSetting->storage_space),
                    'file_size' => static::maxFileSize($uploadSetting->file_size),
                    'files_duration' => static::filesDuration($uploadSetting->files_duration),
                ],
                "storage" => [
                    "used" => [
                        "number" => static::getClientUsedSpace(),
                        "format" => formatBytes(static::getClientUsedSpace()),
                    ],
                    "remining" => [
                        "number" => $uploadSetting->storage_space ? ($uploadSetting->storage_space-static::getClientUsedSpace()) : null,
                        "format" => $uploadSetting->storage_space ? formatBytes(($uploadSetting->storage_space-static::getClientUsedSpace())) : null,
                    ],
                    "fullness" => static::storageFullness($uploadSetting),
                ],
            ];
        }
        return $data;
    }

    public static function unregistredUserSubscriptionDetails()
    {
        $data = static::NON_SUBSCRIBE;
        if (licenceType(2)) {
            $plan = Plan::whereFree()->where('require_login', 0)->first();
            if (!is_null($plan)) {
                $data = [
                    "is_subscribed" => true,
                    "is_lifetime" => true,
                    "is_canceled" => false,
                    "is_expired" => false,
                    "plan" => $plan,
                    "formates" => [
                        'price' => priceSymbol($plan->price),
                        'storage_space' => static::storageSpace($plan->storage_space),
                        'file_size' => static::maxFileSize($plan->file_size),
                        'files_duration' => static::filesDuration($plan->files_duration),
                    ],
                    "storage" => [
                        "used" => [
                            "number" => static::getClientUsedSpace(),
                            "format" => formatBytes(static::getClientUsedSpace()),
                        ],
                        "remining" => [
                            "number" => $plan->storage_space ? ($plan->storage_space-static::getClientUsedSpace()) : null,
                            "format" => $plan->storage_space ? formatBytes(($plan->storage_space-static::getClientUsedSpace())) : null,
                        ],
                        "fullness" => static::storageFullness($plan),
                    ],
                ];
            }
        } else {
            $uploadSetting = UploadSettings::where([['symbol', 'guests'], ['status', 1]])->first();
            if (!is_null($uploadSetting)) {
                $data = [
                    "is_subscribed" => true,
                    "is_lifetime" => true,
                    "is_canceled" => false,
                    "is_expired" => false,
                    "plan" => $uploadSetting,
                    "formates" => [
                        'storage_space' => static::storageSpace($uploadSetting->storage_space),
                        'file_size' => static::maxFileSize($uploadSetting->file_size),
                        'files_duration' => static::filesDuration($uploadSetting->files_duration),
                    ],
                    "storage" => [
                        "used" => [
                            "number" => static::getClientUsedSpace(),
                            "format" => formatBytes(static::getClientUsedSpace()),
                        ],
                        "remining" => [
                            "number" => $uploadSetting->storage_space ? ($uploadSetting->storage_space-static::getClientUsedSpace()) : null,
                            "format" => $uploadSetting->storage_space ? formatBytes(($uploadSetting->storage_space-static::getClientUsedSpace())) : null,
                        ],
                        "fullness" => static::storageFullness($uploadSetting),
                    ],
                ];
            }
        }
        return $data;
    }

    private const NON_SUBSCRIBE = [
        "is_subscribed" => false,
        "plan" => [
            'advertisements' => true,
        ],
    ];

    protected static function reminingDays($date)
    {
        return Carbon::now()->diffInDays(Carbon::parse($date), false);
    }

    protected static function storageSpace($storageSpace)
    {
        if (is_null($storageSpace)) {
            return "∞";
        } else {
            return formatBytes($storageSpace);
        }
    }

    protected static function maxFileSize($maxFileSize)
    {
        if (is_null($maxFileSize)) {
            return lang('Unlimited');
        } else {
            return formatBytes($maxFileSize);
        }
    }

    protected function filesDuration($filesDuration)
    {
        if (is_null($filesDuration)) {
            return lang('Unlimited time');
        } else {
            return formatDays($filesDuration);
        }
    }

    protected static function getClientUsedSpace()
    {
        if (Auth::user()) {
            $usedSpace = FileEntry::where('user_id', Auth::user()->id)->withTrashed()->sum('size');
        } else {
            $usedSpace = FileEntry::where([['ip', vIpInfo()->ip], ['user_id', null]])->withTrashed()->sum('size');
        }
        return intval($usedSpace);
    }

    protected static function storageFullness($plan)
    {
        $fullnessPercentage = $plan->storage_space ? (static::getClientUsedSpace() * 100) / $plan->storage_space : 0;
        return round($fullnessPercentage, 0);
    }

}
