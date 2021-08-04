<?php declare(strict_types=1);

namespace Redir\app;

use Redir\app\services\RedirectProvider;
use Redir\app\services\VisitService;

class App
{
    private RedirectProvider $redirectProvider;
    private VisitService $visitService;

    /**
     * App constructor.
     * @param RedirectProvider $redirectProvider
     * @param VisitService     $visitService
     */
    public function __construct(RedirectProvider $redirectProvider, VisitService $visitService)
    {
        $this->redirectProvider = $redirectProvider;
        $this->visitService = $visitService;
    }

    public function execute()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri_parts = parse_url($uri);
        $redirect = $this->redirectProvider->findRedirectByUri($uri_parts['path']);

        $this->visitService->recordVisit($uri_parts['path'], $redirect !== null ? $redirect->getId() : null);
        if ($redirect !== null) {
            $this->redirectProvider->recordHit($redirect);

            header('Location: ' . $redirect->getDestination());
            exit;
        }

        header('Location: ' . $_ENV['APP_URL']);
        exit;
    }
}
