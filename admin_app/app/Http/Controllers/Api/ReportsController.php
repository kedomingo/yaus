<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ApiRuntimeException;
use App\Http\Controllers\Controller;
use App\Repositories\VisitsRepository;
use App\Services\ReportService;
use DateTimeImmutable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReportsController extends Controller
{

    private ReportService $reportService;

    /**
     * ReportsController constructor.
     * @param ReportService $reportService
     */
    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function getVisits(Request $request): JsonResponse
    {
        $from = !empty($request->get('from'))
            ? new DateTimeImmutable($request->get('from'))
            : new DateTimeImmutable(date('Y-m-d H:i:s', strtotime('-1 week')));

        $to = !empty($request->get('to'))
            ? new DateTimeImmutable($request->get('to'))
            : null;

        $group = $request->get('group') ?? VisitsRepository::GROUP_DAY;

        if (!in_array($group, VisitsRepository::VALID_GROUPS)) {
            throw new ApiRuntimeException(
                sprintf(
                    "Invalid report group criterion: %s. Valid values are: %s",
                    $group,
                    implode(', ', VisitsRepository::VALID_GROUPS)
                )
            );
        }

        return new JsonResponse(
            $this->reportService->getVisits(
                $group,
                $from,
                $to
            )
        );
    }

    public function getBrowsers(Request $request): JsonResponse
    {
        $from = !empty($request->get('from'))
            ? new DateTimeImmutable($request->get('from'))
            : new DateTimeImmutable(date('Y-m-d H:i:s', strtotime('-1 week')));

        $to = !empty($request->get('to'))
            ? new DateTimeImmutable($request->get('to'))
            : new DateTimeImmutable();


        return new JsonResponse(
            $this->reportService->getVisits(
                VisitsRepository::GROUP_BROWSER,
                $from,
                $to
            )
        );
    }
}
