@extends('layouts.app')

@section('title', 'Minhas inscrições')

@section('content')
    <div class="mb-4">
        <h1 class="h3">
            Minhas inscrições
        </h1>

        <p class="text-muted">
            Eventos nos quais você realizou uma inscrição.
        </p>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Evento</th>
                        <th>Data</th>
                        <th>Local</th>
                        <th>Status</th>
                        <th>Ação</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($registrations as $registration)
                        <tr>
                            <td>
                                <a
                                    href="{{ route('events.show', $registration->event) }}"
                                >
                                    {{ $registration->event->title }}
                                </a>
                            </td>

                            <td>
                                {{ $registration->event->start_at->format('d/m/Y H:i') }}
                            </td>

                            <td>
                                {{ $registration->event->location }}
                            </td>

                            <td>
                                @if($registration->isConfirmed())
                                    <span class="badge text-bg-success">
                                        Confirmada
                                    </span>
                                @else
                                    <span class="badge text-bg-secondary">
                                        Cancelada
                                    </span>
                                @endif
                            </td>

                            <td>
                                @if(
                                    $registration->isConfirmed()
                                    && !$registration->event->hasStarted()
                                )
                                    <form
                                        method="POST"
                                        action="{{ route('registrations.destroy', $registration) }}"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Cancelar inscrição?')"
                                        >
                                            Cancelar
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td
                                colspan="5"
                                class="text-center py-4 text-muted"
                            >
                                Você ainda não possui inscrições.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
