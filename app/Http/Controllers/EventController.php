<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Event;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(Request $request): View 
    {
        $query = Event::query()
            ->with('category')
                ->withCount(['registrations as confirmed_registrations_count' =>fn($query) => $query
                   ->where('status', 'confirmed'),])
                      ->where('status', 'scheduled')
                          ->where('start_at', '>', now());

                if($request->filled('search')) {
                    $search = $request->string('search');
                        $query->where(function ($query) use ($search) {
                           $query->where('title','like', "%{$search}%")
                                 ->orWhere('description','like', "%{$search}%");
                   
                });

            };

             if($request->filled('category_id')) {
                 $query->where(
                    'category_id',
                    $request->integer('category_id')
            );
         }

         $events = $query
            ->orderBY('start_at')
            ->paginate(9)
            ->withQueryString();

            $categories = Category::orderBy('name')->get();

            return view('events.index', compact('events', 'categories'));
    }

    public function show(Event $event): view
    {
        $event->load('category');
        $confirmedCount = $event
           ->registrations()
           ->where('status', 'confirmed')
           ->count();

        $registration = auth()
            ->user()
            ->registrations()
            ->where('event_id', $event->id)
            ->first();

        return view('events.show', compact('event', 'confirmedCount', 'registration'));   
    }

       
}

