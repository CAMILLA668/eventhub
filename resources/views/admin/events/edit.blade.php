@extends('layouts.app')

@section('title', 'Editar evento')

@section('content')

    <h1 class="h3 mb-4">
        Editar evento
    </h1>

    <div class="card">
        <div class="card-body">
            <form
                method="POST"
                action="{{ route('admin.events.update', $event) }}"
            >
                @csrf
                @method('PUT')

                @include(
                    'admin.events._form',
                    ['submitLabel' => 'Atualizar evento']
                )
            </form>
        </div>
    </div>

@endsection
