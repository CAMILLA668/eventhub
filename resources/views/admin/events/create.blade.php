@extends('layouts.app')

@section('title', 'Novo evento')

@section('content')

    <h1 class="h3 mb-4">
        Novo evento
    </h1>

    <div class="card">
        <div class="card-body">
            <form
                method="POST"
                action="{{ route('admin.events.store') }}"
            >
                @csrf

                @include(
                    'admin.events._form',
                    ['submitLabel' => 'Cadastrar evento']
                )
            </form>
        </div>
    </div>

@endsection
