@extends('layouts.app')

@section('title', 'Participantes')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3">
                {{ $event->title }}
            </h1>

            <p class="text-muted mb-0">
                Lista de participantes
            </p>
        </div>

        <a
            href="{{ route('admin.events.index') }}"
            class="btn btn-secondary"
        >
            Voltar
        </a>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-bg-primary">
                <div class="card-body">
                    <div class="small">
                        Capacidade
                    </div>

                    <div class="fs-3">
                        {{ $event->capacity }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-bg-success">
                <div class="card-body">
                    <div class="small">
                        Confirmados
                    </div>

                    <div class="fs-3">
                        {{ $confirmedCount }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-bg-secondary">
                <div class="card-body">
                    <div class="small">
                        Vagas disponíveis
                    </div>

                    <div class="fs-3">
                        {{ $event->capacity - $confirmedCount }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Participante</th>
                        <th>E-mail</th>
                        <th>Status</th>
                        <th>Data da inscrição</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($event->registrations as $registration)
                        <tr>
                            <td>
                                {{ $registration->user->name }}
                            </td>

                            <td>
                                {{ $registration->user->email }}
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
                                {{ $registration->registered_at->format('d/m/Y H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td
                                colspan="4"
                                class="text-center py-4"
                            >
                                Nenhuma inscrição.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
