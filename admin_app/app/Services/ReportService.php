<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Visit;
use App\Repositories\VisitsRepository;
use DateInterval;
use DateTimeImmutable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class ReportService
{
    private const CACHE_LIFETIME = 'PT10M';

    private VisitsRepository $repository;

    /**
     * ReportService constructor.
     * @param VisitsRepository $repository
     */
    public function __construct(VisitsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getVisits(string $group, DateTimeImmutable $from, ?DateTimeImmutable $to = null)
    {
        if ($to === null) {
            $to = new DateTimeImmutable("+1 day");
        }

        $result = $this->getFromCache($group, $from, $to);
        if ($result !== false) {
            return $result;
        }

        $result = $this->repository->getVisits($group, $from, $to);

        if ($group === VisitsRepository::GROUP_DAY && $from->getTimestamp() <= $to->getTimestamp()) {
            $result = $this->padDates($result, $from, $to);
        }
        $key = $this->getCacheKey($group, $from, $to);

        Cache::put($key, $result, new DateInterval(self::CACHE_LIFETIME));

        return $result;
    }


    private function padDates(Collection $result, DateTimeImmutable $from, ?DateTimeImmutable $to = null): Collection
    {
        $dates = [];

        array_map(
            static function ($row) use (&$dates) {
                $dates[$row['date']] = $row['count'];
            },
            $result->toArray()
        );

        $id = 0;
        $new = [];
        for ($i = $from->getTimestamp(), $j = $to->getTimestamp(); $i < $j; $i += 86400) {
            $date = date('Y-m-d', $i);
            if (array_key_exists($date, $dates)) {
                $new[] = new Visit(['id' => $id++, 'date' => $date, 'count' => $dates[$date]]);
            } else {
                $new[] = new Visit(['id' => $id++, 'date' => $date, 'count' => 0]);
            }
        }

        return new Collection($new);
    }

    /**
     * @param string                 $group
     * @param DateTimeImmutable      $from
     * @param DateTimeImmutable|null $to
     *
     * @return bool|Collection|null  Collection or null if in cache, false if not in cache
     */
    private function getFromCache(string $group, DateTimeImmutable $from, ?DateTimeImmutable $to = null)
    {
        $key = $this->getCacheKey($group, $from, $to);

        return Cache::has($key)
            ? Cache::get($key)
            : false;
    }

    private function getCacheKey(string $group, DateTimeImmutable $from, ?DateTimeImmutable $to = null)
    {
        return sprintf('report-%s-%s-%s', $group, $from->format('Y-m-d-H'), $to->format('Y-m-d-H'));
    }
}
