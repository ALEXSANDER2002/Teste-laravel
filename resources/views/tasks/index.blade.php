@extends('layouts.app')

@section('title', 'Lista de Tarefas')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2><i class="bi bi-list-check"></i> Lista de Tarefas</h2>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nova Tarefa
        </a>
    </div>
</div>

<!-- Filtros -->
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('tasks.index') }}" method="GET" class="row g-3">
            <div class="col-md-4">
                <label for="status" class="form-label">Filtrar por Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="">Todos</option>
                    <option value="pendente" {{ request('status') === 'pendente' ? 'selected' : '' }}>
                        Pendente
                    </option>
                    <option value="concluida" {{ request('status') === 'concluida' ? 'selected' : '' }}>
                        Concluída
                    </option>
                </select>
            </div>
            <div class="col-md-8 d-flex align-items-end">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="bi bi-funnel"></i> Filtrar
                </button>
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Limpar
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Lista de Tarefas -->
@if($tasks->count() > 0)
    <div class="row">
        @foreach($tasks as $task)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card task-card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title">{{ Str::limit($task->title, 30) }}</h5>
                            <span class="badge bg-{{ $task->status_badge_class }}">
                                {{ $task->status_label }}
                            </span>
                        </div>
                        
                        @if($task->description)
                            <p class="card-text text-muted">
                                {{ Str::limit($task->description, 80) }}
                            </p>
                        @else
                            <p class="card-text text-muted fst-italic">Sem descrição</p>
                        @endif
                        
                        <p class="card-text">
                            <small class="text-muted">
                                <i class="bi bi-calendar"></i> 
                                {{ $task->created_at->format('d/m/Y H:i') }}
                            </small>
                        </p>
                    </div>
                    <div class="card-footer bg-transparent">
                        <div class="btn-group w-100" role="group">
                            <a href="{{ route('tasks.show', $task) }}" 
                               class="btn btn-sm btn-outline-info"
                               title="Visualizar">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('tasks.edit', $task) }}" 
                               class="btn btn-sm btn-outline-primary"
                               title="Editar">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('tasks.destroy', $task) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('Tem certeza que deseja excluir esta tarefa?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-sm btn-outline-danger"
                                        title="Excluir">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Paginação -->
    <div class="d-flex justify-content-center">
        {{ $tasks->links() }}
    </div>
@else
    <div class="alert alert-info text-center">
        <i class="bi bi-info-circle"></i>
        <p class="mb-0">
            @if(request('status'))
                Nenhuma tarefa encontrada com o status "{{ request('status') }}".
            @else
                Nenhuma tarefa cadastrada ainda. 
                <a href="{{ route('tasks.create') }}">Criar primeira tarefa</a>
            @endif
        </p>
    </div>
@endif
@endsection


