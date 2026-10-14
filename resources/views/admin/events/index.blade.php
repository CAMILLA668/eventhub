@extends('layouts.app')

@section('title', 'Gerenciar eventos')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3">
                Gerenciar eventos
            </h1>

            <p class="text-muted mb-0">
                Área administrativa
            </p>
        </div>

        <div>
            <a
                href="{{ route('admin.categories.index') }}"
                class="btn btn-outline-secondary"
            >
                Categorias
            </a>

            <a
                href="{{ route('admin.events.create') }}"
                class="btn btn-primary"
            >
                Novo evento
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Evento</th>
                        <th>Categoria</th>
                        <th>Data</th>
                        <th>Inscritos</th>
                        <th>Situação</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($events as $event)
                        <tr>
                            <td>
                                {{ $event->title }}
                            </td>

                            <td>
                                {{ $event->category->name }}
                            </td>

                            <td>
                                {{ $event->start_at->format('d/m/Y H:i') }}
                            </td>

                            <td>
                                {{ $event->confirmed_registrations_count }}
                                / {{ $event->capacity }}
                            </td>

                            <td>
                                @if($event->status === 'canceled')
                                    <span class="badge text-bg-danger">
                                        Cancelado
                                    </span>
                                @elseif($event->hasFinished())
                                    <span class="badge text-bg-secondary">
                                        Encerrado
                                    </span>
                                @elseif($event->hasStarted())
                                    <span class="badge text-bg-warning">
                                        Em andamento
                                    </span>
                                @else
                                    <span class="badge text-bg-success">
                                        Agendado
                                    </span>
                                @endif
                            </td>

                            <td class="text-end">
                                <a
                                    href="{{ route(
                                        'admin.events.participants',
                                        $event
                                    ) }}"
                                    class="btn btn-sm btn-outline-dark"
                                >
                                    Participantes
                                </a>

                                @if(!$event->hasStarted())
                                    <a
                                        href="{{ route(
                                            'admin.events.edit',
                                            $event
                                        ) }}"
                                        class="btn btn-sm btn-outline-primary"
                                    >
                                        Editar
                                    </a>
                                @endif

                                @if(!$event->registrations()->exists())
                                    <form
                                        method="POST"
                                        action="{{ route(
                                            'admin.events.destroy',
                                            $event
                                        ) }}"
                                        class="d-inline"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Excluir este evento?')"
                                        >
                                            Excluir
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td
                                colspan="6"
                                class="text-center py-4"
                            >
                                Nenhum evento cadastrado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
