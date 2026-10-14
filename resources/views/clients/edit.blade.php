@extends('layouts.app')

@section('title', 'Редактировать клиента')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Редактировать клиента</h2>
    <a href="{{ route('clients.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Назад к списку
    </a>
</div>

<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0">Информация о клиенте</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('clients.update', $client) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Фотография -->
            <div class="mb-4">
                <label for="photo" class="form-label fw-semibold">Фотография клиента</label>
                <div class="d-flex align-items-start gap-3">
                    <div id="photo-preview" class="text-center">
                        @if($client->photo)
                            <img src="{{ asset('uploads/clients/' . $client->photo) }}" 
                                 alt="{{ $client->name }}" 
                                 class="photo-thumb-lg" 
                                 id="current-photo">
                        @else
                            <div class="photo-thumb-lg bg-light border d-flex align-items-center justify-content-center" id="preview-container">
                                <i class="bi bi-person text-muted fs-1"></i>
                            </div>
                        @endif
                    </div>
                    <div class="flex-grow-1">
                        <input type="file" 
                               class="form-control" 
                               id="photo" 
                               name="photo" 
                               accept="image/jpeg,image/png,image/jpg,image/gif"
                               onchange="previewImage(this)">
                        <small class="text-muted">
                            Допустимые форматы: JPEG, PNG, GIF. Максимальный размер: 2 МБ.
                        </small>
                        @if($client->photo)
                            <div class="mt-2">
                                <small class="text-muted">Текущее фото:</small><br>
                                <a href="{{ asset('uploads/clients/' . $client->photo) }}" 
                                   target="_blank" 
                                   class="text-decoration-none">
                                    <i class="bi bi-link-45deg me-1"></i>Открыть текущее фото
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                @error('photo')
                    <div class="text-danger mt-2"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                @enderror
            </div>

            <!-- Имя -->
            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">
                    Имя <span class="text-danger">*</span>
                </label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text" 
                           class="form-control @error('name') is-invalid @enderror" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $client->name) }}"
                           placeholder="Введите имя клиента"
                           required>
                </div>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           id="email" 
                           name="email" 
                           value="{{ old('email', $client->email) }}"
                           placeholder="example@mail.com">
                </div>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Телефон -->
            <div class="mb-3">
                <label for="phone" class="form-label fw-semibold">Телефон</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                    <input type="tel" 
                           class="form-control @error('phone') is-invalid @enderror" 
                           id="phone" 
                           name="phone" 
                           value="{{ old('phone', $client->phone) }}"
                           placeholder="+7 (999) 123-45-67">
                </div>
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Адрес -->
            <div class="mb-4">
                <label for="address" class="form-label fw-semibold">Адрес</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                    <textarea class="form-control @error('address') is-invalid @enderror" 
                              id="address" 
                              name="address" 
                              rows="2"
                              placeholder="Введите адрес">{{ old('address', $client->address) }}</textarea>
                </div>
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Кнопки -->
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg me-1"></i>Обновить
                </button>
                <a href="{{ route('clients.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-lg me-1"></i>Отмена
                </a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function previewImage(input) {
    const previewContainer = document.getElementById('photo-preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewContainer.innerHTML = '<img src="' + e.target.result + '" class="photo-thumb-lg" alt="Фото">';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
@endsection
