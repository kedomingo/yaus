<?php declare(strict_types=1);

namespace App\Services;

use App\Models\Visit;
use App\Repositories\VisitsRepository;
use DateTimeImmutable;
use Illuminate\Database\Eloquent\Collection;

class ReportService
{
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

        $result = $this->repository->getVisits($group, $from, $to);

        if ($group === VisitsRepository::GROUP_DAY && $from->getTimestamp() <= $to->getTimestamp()) {
            return $this->padDates($result, $from, $to);
        }

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

}
