@extends('layouts.app')

@section('title', 'Карточка клиента: ' . $client->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0"><i class="bi bi-person-badge me-2">Карточка клиента</h2>
    <div>
        <a href="{{ route('clients.edit', $client) }}" class="btn btn-warning me-2">
            <i class="bi bi-pencil me-1"></i>Редактировать
        </a>
        <a href="{{ route('clients.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Назад к списку
        </a>
    </div>
</div>

<div class="row">
    <!-- Фотография -->
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-header bg-white text-center">
                <h5 class="mb-0">Фотография</h5>
            </div>
            <div class="card-body text-center">
                @if($client->photo)
                    <img src="{{ asset('uploads/clients/' . $client->photo) }}" 
                         alt="{{ $client->name }}" 
                         class="photo-thumb-lg img-fluid mb-3">
                    <br>
                    <a href="{{ asset('uploads/clients/' . $client->photo) }}" 
                       target="_blank" 
                       class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-zoom-in me-1"></i>Открыть в полном размере
                    </a>
                @else
                    <div class="photo-thumb-lg bg-light border d-flex align-items-center justify-content-center mx-auto">
                        <i class="bi bi-person text-muted fs-1"></i>
                    </div>
                    <p class="text-muted mt-3">Фотография не загружена</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Информация -->
    <div class="col-md-8 mb-4">
        <div class="card h-100">
            <div class="card-header bg-white">
                <h5 class="mb-0">Информация</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th style="width: 180px;">
                                <i class="bi bi-person me-2 text-muted"></i>Имя:
                            </th>
                            <td class="fw-semibold">{{ $client->name }}</td>
                        </tr>
                        <tr>
                            <th>
                                <i class="bi bi-envelope me-2 text-muted"></i>Email:
                            </th>
                            <td>
                                @if($client->email)
                                    <a href="mailto:{{ $client->email }}" class="text-decoration-none">
                                        {{ $client->email }}
                                    </a>
                                @else
                                    <span class="text-muted">Не указан</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <i class="bi bi-telephone me-2 text-muted"></i>Телефон:
                            </th>
                            <td>
                                @if($client->phone)
                                    <a href="tel:{{ $client->phone }}" class="text-decoration-none">
                                        {{ $client->phone }}
                                    </a>
                                @else
                                    <span class="text-muted">Не указан</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <i class="bi bi-geo-alt me-2 text-muted"></i>Адрес:
                            </th>
                            <td>
                                @if($client->address)
                                    {{ $client->address }}
                                @else
                                    <span class="text-muted">Не указан</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <i class="bi bi-calendar me-2 text-muted"></i>Дата добавления:
                            </th>
                            <td>{{ $client->created_at->format('d.m.Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>
                                <i class="bi bi-clock me-2 text-muted"></i>Последнее обновление:
                            </th>
                            <td>{{ $client->updated_at->format('d.m.Y H:i') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white">
                <form action="{{ route('clients.destroy', $client) }}" 
                      method="POST" 
                      onsubmit="return confirm('Вы уверены, что хотите удалить этого клиента? Все данные будут удалены безвозвратно.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i>Удалить клиента
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
