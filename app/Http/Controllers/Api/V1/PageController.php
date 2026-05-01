<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageIndexRequest;
use App\Http\Requests\PageShowRequest;
use App\Http\Resources\PageResource;
use App\Services\PageService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PageController extends Controller
{
    public function __construct(private readonly PageService $pages) {}

    public function index(PageIndexRequest $request): AnonymousResourceCollection
    {
        return PageResource::collection(
            $this->pages->publishedPaginated(
                $request->validated(),
                (int) $request->integer('per_page', 15),
            ),
        );
    }

    public function show(PageShowRequest $request, string $slug): PageResource
    {
        $page = $this->pages->findPublishedBySlug($slug);

        abort_if($page === null, 404);

        return PageResource::make($page);
    }
}
