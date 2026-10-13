@extends('layouts.app')

@section('title', 'Nova categoria')

@section('content')
    <h1 class="h3 mb-4">
        Nova categoria
    </h1>

    <div class="card">
        <div class="card-body">
            <form
                method="POST"
                action="{{ route('admin.categories.store') }}"
            >
                @csrf

                <div class="mb-3">
                    <label class="form-label">
                        Nome
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name') }}"
                        required
                    >
                </div>

                <button class="btn btn-primary">
                    Salvar
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

