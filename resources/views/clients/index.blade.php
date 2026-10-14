@extends('layouts.app')

@section('title', 'Список клиентов')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0"><i class="bi bi-people me-2"></i>Список клиентов</h2>
    <a href="{{ route('clients.create') }}" class="btn btn-primary">
        <i class="bi bi-person-plus me-1"></i>Добавить клиента
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        @if($clients->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Фото</th>
                        <th>Имя</th>
                        <th>Email</th>
                        <th>Телефон</th>
                        <th>Адрес</th>
                        <th class="text-end">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                    <tr>
                        <td>{{ $clients->firstItem() + $loop->index }}</td>
                        <td>
                            @if($client->photo)
                                <img src="{{ asset('uploads/clients/' . $client->photo) }}" 
                                     alt="{{ $client->name }}" 
                                     class="photo-thumb">
                            @else
                                <div class="photo-thumb bg-secondary d-flex align-items-center justify-content-center">
                                    <i class="bi bi-person text-white fs-4"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('clients.show', $client) }}" class="text-decoration-none fw-semibold">
                                {{ $client->name }}
                            </a>
                        </td>
                        <td>{{ $client->email ?? '-' }}</td>
                        <td>{{ $client->phone ?? '-' }}</td>
                        <td>{{ Str::limit($client->address, 30) ?? '-' }}</td>
                        <td class="text-end">
                            <a href="{{ route('clients.show', $client) }}" 
                               class="btn btn-sm btn-outline-info btn-action me-1" 
                               title="Просмотр">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('clients.edit', $client) }}" 
                               class="btn btn-sm btn-outline-warning btn-action me-1" 
                               title="Редактировать">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('clients.destroy', $client) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('Вы уверены, что хотите удалить этого клиента?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-sm btn-outline-danger btn-action" 
                                        title="Удалить">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-inbox fs-1 text-muted"></i>
            <p class="mt-3 text-muted">Клиенты отсутствуют</p>
            <a href="{{ route('clients.create') }}" class="btn btn-primary">
                <i class="bi bi-person-plus me-1"></i>Добавить первого клиента
            </a>
        </div>
        @endif
    </div>
</div>

@if($clients->count() > 0)
<div class="mt-3">
    {{ $clients->links() }}
</div>
@endif
@endsection
