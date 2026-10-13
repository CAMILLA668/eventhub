@extends('layouts.app')

@section('title', 'Categorias')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">
                Categorias
            </h1>

            <p class="text-muted mb-0">
                Gerenciamento das categorias dos eventos.
            </p>
        </div>

        <a
            href="{{ route('admin.categories.create') }}"
            class="btn btn-primary"
        >
            Nova categoria
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Nome</th>
                            <th>Eventos</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>
                                    {{ $category->name }}
                                </td>

                                <td>
                                    {{ $category->events_count }}
                                </td>

                                <td class="text-end">
                                    <a
                                        href="{{ route('admin.categories.edit', $category) }}"
                                        class="btn btn-sm btn-outline-primary"
                                    >
                                        Editar
                                    </a>

                                    @if($category->events_count === 0)
                                        <form
                                            action="{{ route('admin.categories.destroy', $category) }}"
                                            method="POST"
                                            class="d-inline"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Excluir esta categoria?')"
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
                                    colspan="3"
                                    class="text-center py-4 text-muted"
                                >
                                    Nenhuma categoria cadastrada.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

