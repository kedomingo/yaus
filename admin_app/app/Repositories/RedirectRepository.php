<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Redirect;
use DB;
use Illuminate\Database\Eloquent\Collection;

class RedirectRepository
{
    public function getRedirects(): Collection
    {
        return Redirect::all();
    }

    public function findRedirectById(int $id): ?Redirect
    {
        return Redirect::find($id);
    }

    public function findRedirectByUri(string $uri): ?Redirect
    {
        return Redirect::where('uri', '=', $uri)->first();
    }

    /**
     * @param string $uri
     * @param string $destination
     * @param bool   $isActive
     *
     * @return Redirect
     */
    public function createRedirect(string $uri, string $destination, bool $isActive): Redirect
    {
        $entity = new Redirect(
            [
                'uri' => $uri,
                'destination' => $destination,
                'is_active' => $isActive
            ]
        );
        $entity->save();

        return $entity;
    }

    /**
     * @param int    $id
     * @param string $uri
     * @param string $destination
     * @param bool   $isActive
     *
     * @return Redirect|null
     */
    public function updateRedirect(int $id, string $uri, string $destination, bool $isActive): ?Redirect
    {
        $entity = Redirect::find($id);
        if ($entity === null) {
            return null;
        }
        $entity->uri = $uri;
        $entity->destination = $destination;
        $entity->is_active = $isActive;
        $entity->save();

        return $entity;
    }
}
