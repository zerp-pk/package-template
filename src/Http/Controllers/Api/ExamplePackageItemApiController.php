<?php

namespace Zerp\ExamplePackage\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Zerp\ExamplePackage\Http\Resources\ExamplePackageItemResource;
use Zerp\ExamplePackage\Models\ExamplePackageItem;

/**
 * Sample module API controller. Copy this shape for real endpoints:
 *
 * - Return a JsonResource / ResourceCollection with a typed return declaration,
 *   so Scramble infers the response schema from the resource with no
 *   annotations. That is the whole point of shipping resources.
 * - The TenantScoped model already limits rows to the current tenant, so no
 *   created_by filtering is needed here.
 * - ApiResponseTrait is available (used below only for error cases) when you
 *   need the shared {success, message, data} envelope, as the core auth API does.
 */
class ExamplePackageItemApiController extends Controller
{
    use ApiResponseTrait;

    public function index(): AnonymousResourceCollection
    {
        $items = ExamplePackageItem::latest()->paginate(request('per_page', 10));

        return ExamplePackageItemResource::collection($items);
    }
}
