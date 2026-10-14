<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EventCOntroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $events = Event::with('category')
              ->withCount([
                'registrations as confirmed_registrations_count' => fn($query) =>
                    $query->where(
                     'status',
                     'confirmed'
               ),
           ])
           ->orderByDesc('start_at')
           ->get();

        return view(
            'admin.events.index',
            compact('events')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::orderBy('name')
           ->get();

        return view(
            'admin.events.create',
            compact('categories')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request): RedirectResponse
    {
        Event::create($request->validated());

        return redirect()
           ->route('admin.events.index')
           ->with(
            'success',
            "Evento criado com sucesso."
           );
    }

    /**
     * Display the specified resource.
     */
    public function edit(Event $event): View
    {
        if($event->hashStarted()) {
            return redirect()
              ->route('admin.events.index')
              ->with(
                 'error',
                 'Eventos que já começaram não podem ser editados.'
              );
        }

        $categories = Category::orderBY('name')
          ->get();

        return view(
            'admin.evnets.edit',
            compact('event', 'categories')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, Event $event): RedirectResponse
    {
        if($event->hashStarted()) {
            return redirect()
               ->route('admin.events.index')
               ->with(
                  'error',
                  'Eventos que já começaram não podem ser alterados.'
               );
        }

        $event->update($request->validated());

        return redirect()
          ->route('admin.events.index')
          ->with(
              'success',
              'Evento atualizado com sucesso.'
          );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event): RedirectResponse
    {
        if($event->registrations()->exists()) {
             return back()->with(
                 'error',
                 'Eventos que possuem inscrições não podem ser excluídos. Cancele o evento.'
             );
        }

        $event->delete();

        return redirect()
          ->route('admin.events.index')
          ->with(
             'success',
             'Evento excluído com sucesso.'
          );
    }

    public  function participants(Event $event): View
    {
        event->load(['category', 'registrations'
               => fn($query) 
               => $query
                  ->with('user')
                  ->orderByDesc('registered_at'),
        ]);

        $confirmedCount = $event
            ->registrations()
            ->where('status', 'confirmed')
            ->count();

        return view(
            'admin.events.participants',
            compact('event', 'confirmedCount')
        );
    }
}
