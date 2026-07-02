<?php

namespace Zerp\ExamplePackage\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Zerp\ExamplePackage\Models\ExamplePackageItem;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if(Auth::user()->can('manage-example-package')){
            $totalItems = ExamplePackageItem::where('created_by', creatorId())->count();
            $activeItems = ExamplePackageItem::where('created_by', creatorId())->where('is_active', true)->count();
            $recentItems = ExamplePackageItem::where('created_by', creatorId())->latest()->take(5)->get();

            return Inertia::render('ExamplePackage/Index', [
                'stats' => [
                    'total_items' => $totalItems,
                    'active_items' => $activeItems,
                    'inactive_items' => $totalItems - $activeItems,
                ],
                'recent_items' => $recentItems,
                'message' => __('ExamplePackage Dashboard - Manage your items efficiently.')
            ]);
        }
        return back()->with('error', __('Permission denied'));
    }
}