<?php

namespace Zerp\ExamplePackage\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Typing the fields one per line is what lets Scramble generate a real response
 * schema for /docs/example-package instead of an opaque object. Mirror the
 * model's actual types; add a resource like this for every model an endpoint
 * returns.
 *
 * @mixin \Zerp\ExamplePackage\Models\ExamplePackageItem
 */
class ExamplePackageItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'is_active' => (bool) $this->is_active,
            'created_at' => $this->created_at,
        ];
    }
}
