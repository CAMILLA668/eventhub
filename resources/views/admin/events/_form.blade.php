<div class="mb-3">
    <label class="form-label">
        Categoria
    </label>

    <select
        name="category_id"
        class="form-select"
        required
    >
        <option value="">
            Selecione...
        </option>

        @foreach($categories as $category)
            <option
                value="{{ $category->id }}"
                @selected(
                    old('category_id', $event->category_id ?? '') == $category->id
                )
            >
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label class="form-label">
        Título
    </label>

    <input
        type="text"
        name="title"
        class="form-control"
        value="{{ old('title', $event->title ?? '') }}"
        required
    >
</div>

<div class="mb-3">
    <label class="form-label">
        Descrição
    </label>

    <textarea
        name="description"
        class="form-control"
        rows="5"
        required
    >{{ old('description', $event->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">
        Local
    </label>

    <input
        type="text"
        name="location"
        class="form-control"
        value="{{ old('location', $event->location ?? '') }}"
        required
    >
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">
            Início
        </label>

        <input
            type="datetime-local"
            name="start_at"
            class="form-control"
            value="{{ old(
                'start_at',
                isset($event)
                    ? $event->start_at->format('Y-m-d\TH:i')
                    : ''
            ) }}"
            required
        >
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">
            Término
        </label>

        <input
            type="datetime-local"
            name="end_at"
            class="form-control"
            value="{{ old(
                'end_at',
                isset($event)
                    ? $event->end_at->format('Y-m-d\TH:i')
                    : ''
            ) }}"
            required
        >
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">
            Capacidade
        </label>

        <input
            type="number"
            name="capacity"
            class="form-control"
            min="1"
            value="{{ old('capacity', $event->capacity ?? 1) }}"
            required
        >
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">
            Situação
        </label>

        <select
            name="status"
            class="form-select"
            required
        >
            <option
                value="scheduled"
                @selected(
                    old(
                        'status',
                        $event->status ?? 'scheduled'
                    ) === 'scheduled'
                )
            >
                Agendado
            </option>

            <option
                value="canceled"
                @selected(
                    old('status', $event->status ?? '') === 'canceled'
                )
            >
                Cancelado
            </option>
        </select>
    </div>
</div>

<button class="btn btn-primary">
    {{ $submitLabel }}
</button>

<a
    href="{{ route('admin.events.index') }}"
    class="btn btn-secondary"
>
    Cancelar
</a>
