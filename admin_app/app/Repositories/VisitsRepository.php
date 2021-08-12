<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Visit;
use DateTimeImmutable;
use DB;

class VisitsRepository
{
    public const GROUP_DAY = 'day';
    public const GROUP_URI = 'uri';
    public const GROUP_BROWSER = 'browser';
    public const GROUP_OS = 'os';
    public const GROUP_DEVICE_TYPE = 'device_type';
    public const GROUP_COUNTRY = 'country';

    public const VALID_GROUPS = [
        self::GROUP_DAY,
        self::GROUP_URI,
        self::GROUP_BROWSER,
        self::GROUP_OS,
        self::GROUP_DEVICE_TYPE,
        self::GROUP_COUNTRY,
    ];

    public function getVisits(string $group, DateTimeImmutable $from, DateTimeImmutable $to = null)
    {
        $qb = Visit::where('create_day', '>=', $from->format('Y-m-d H:i:s'));
        $qb->where('create_day', '<=', $to->format('Y-m-d H:i:s'));


        switch ($group) {
            case self::GROUP_DAY:
                $qb->groupBy(DB::raw('DATE_FORMAT(created, "%Y-%m-%d")'))
                    ->select(DB::raw('DATE_FORMAT(created, "%Y-%m-%d") AS date'), DB::raw('count(1) AS count'));

                break;

            case self::GROUP_URI:
                $qb->groupBy('uri')
                    ->select('uri', DB::raw('count(1) AS count'));

                break;

            case self::GROUP_BROWSER:
                $qb->groupBy('browser')
                    ->select('browser', DB::raw('count(1) AS count'));

                break;

            case self::GROUP_OS:
                $qb->groupBy('platform')
                    ->select('platform', DB::raw('count(1) AS count'));

                break;

            case self::GROUP_DEVICE_TYPE:
                $qb->groupBy('device_type')
                    ->select('device_type', DB::raw('count(1) AS count'));

                break;

            case self::GROUP_COUNTRY:
                $qb->groupBy('country')
                    ->select('country', DB::raw('count(1) AS count'));

                break;

            default:
                throw new \RuntimeException('Unknown group condition: ' . $group);
        }

        return $qb->get();
    }
}
