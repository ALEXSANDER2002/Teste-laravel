@extends('layouts.app')

@section('title', 'Visualizar Tarefa')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="bi bi-eye"></i> Detalhes da Tarefa</h4>
                <span class="badge bg-{{ $task->status_badge_class }} fs-6">
                    {{ $task->status_label }}
                </span>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <h5 class="text-muted">Título</h5>
                    <p class="fs-4">{{ $task->title }}</p>
                </div>

                <div class="mb-4">
                    <h5 class="text-muted">Descrição</h5>
                    @if($task->description)
                        <p>{{ $task->description }}</p>
                    @else
                        <p class="text-muted fst-italic">Nenhuma descrição fornecida.</p>
                    @endif
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5 class="text-muted">Data de Criação</h5>
                        <p>
                            <i class="bi bi-calendar-plus"></i> 
                            {{ $task->created_at->format('d/m/Y H:i') }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-muted">Última Atualização</h5>
                        <p>
                            <i class="bi bi-calendar-check"></i> 
                            {{ $task->updated_at->format('d/m/Y H:i') }}
                        </p>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Voltar
                    </a>
                    <div>
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary me-2">
                            <i class="bi bi-pencil"></i> Editar
                        </a>
                        <form action="{{ route('tasks.destroy', $task) }}" 
                              method="POST" 
                              class="d-inline"
                              onsubmit="return confirm('Tem certeza que deseja excluir esta tarefa?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash"></i> Excluir
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


