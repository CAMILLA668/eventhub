<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Registration;
use App\Services\RegistrationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $registrations = auth()
           ->user()
           ->registrations()
           ->with(['event.category'])
           ->latest('registered_at')
           ->get();

        return view('registrations.index', compact('registrations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Event $event, RegistrationService $service): RedirectResponse
    {
        try{
            $service->register(auth()->user(), $event);
        } catch (\DomainException $exception) {

            return back()
               ->with('error', $exception->getMessage());
        }

        return redirect()
            ->route('events.show', $event)
            ->with(
            'success',
            'Inscrição realizada com sucesso.'
          );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Registration $registration, RegistrationService $service): RedirectResponse
    {
        try {
            $service->cancel(auth()->user(), $registration);
        } catch (\DomainException $exception) {
            return back()
              ->with('error', $exception->getMessage());
        }

        return redirect()
           ->route('registrations.index')
           ->with(
              'success',
              'Inscrição cancelada com sucesso.'
           );
    }
}
