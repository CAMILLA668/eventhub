@extends('layouts.app')

@section('title', 'Editar categoria')

@section('content')
    <h1 class="h3 mb-4">
        Editar categoria
    </h1>

    <div class="card">
        <div class="card-body">
            <form
                method="POST"
                action="{{ route('admin.categories.update', $category) }}"
            >
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">
                        Nome
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name', $category->name) }}"
                        required
                    >
                </div>

                <button class="btn btn-primary">
                    Atualizar
                </button>

                <a
                    href="{{ route('admin.categories.index') }}"
                    class="btn btn-secondary"
                >
                    Cancelar
                </a>
            </form>
        </div>
    </div>
@endsection

