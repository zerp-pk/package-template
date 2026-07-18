<?php

namespace Zerp\ExamplePackage\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Zerp\ExamplePackage\Models\ExamplePackageItem;
use Zerp\ExamplePackage\Http\Requests\StoreExamplePackageItemRequest;
use Zerp\ExamplePackage\Http\Requests\UpdateExamplePackageItemRequest;

class ExamplePackageItemController extends Controller
{
    public function index()
    {
        if(Auth::user()->can('manage-example-package')){
            $items = ExamplePackageItem::select('id', 'name', 'description', 'is_active', 'created_at')
                ->where(function($q) {
                    if(Auth::user()->can('manage-any-example-package')) {
                        $q->where('created_by', creatorId());
                    } elseif(Auth::user()->can('manage-own-example-package')) {
                        $q->where('creator_id', Auth::id());
                    } else {
                        $q->whereRaw('1 = 0');
                    }
                })
                ->when(request('name'), fn($q) => $q->where('name', 'like', '%' . request('name') . '%'))
                ->when(request('is_active') !== null, fn($q) => $q->where('is_active', request('is_active')))
                ->when(request('sort'), fn($q) => $q->orderBy(request('sort'), request('direction', 'asc')), fn($q) => $q->latest())
                ->paginate(request('per_page', 10))
                ->withQueryString();

            return Inertia::render('ExamplePackage/Items/Index', [
                'items' => $items,
            ]);
        }
        return back()->with('error', __('Permission denied'));
    }

    public function store(StoreExamplePackageItemRequest $request)
    {
        if(Auth::user()->can('create-example-package')){
            $validated = $request->validated();

            $validated['is_active'] = $request->boolean('is_active', true);

            $item = new ExamplePackageItem();
            $item->name = $validated['name'];
            $item->description = $validated['description'];
            $item->is_active = $validated['is_active'];
            $item->creator_id = Auth::id();
            $item->created_by = creatorId();
            $item->save();

            return redirect()->route('example-package.items.index')->with('success', __('Item created successfully.'));
        }
        return redirect()->route('example-package.items.index')->with('error', __('Permission denied'));
    }

    public function update(UpdateExamplePackageItemRequest $request, ExamplePackageItem $item)
    {
        if(Auth::user()->can('edit-example-package')){
            $validated = $request->validated();

            $validated['is_active'] = $request->boolean('is_active', true);

            $item->name = $validated['name'];
            $item->description = $validated['description'];
            $item->is_active = $validated['is_active'];
            $item->save();

            return back()->with('success', __('Item updated successfully.'));
        }
        return redirect()->route('example-package.items.index')->with('error', __('Permission denied'));
    }

    public function destroy(ExamplePackageItem $item)
    {
        if(Auth::user()->can('delete-example-package')){
            $item->delete();

            return back()->with('success', __('Item deleted successfully.'));
        }
        return redirect()->route('example-package.items.index')->with('error', __('Permission denied'));
    }
}