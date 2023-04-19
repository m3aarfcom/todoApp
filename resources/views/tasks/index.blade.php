@extends('layouts.app')


@section('style')
@endsection
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-title">

                @can('create_task')
                    <button type="button" class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add New Task
                    </button>
                @endcan
            </div>
            <div class="card-body">
                <div class="">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Due Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Priority</th>
                                <th scope="col">Users</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @can('read_task')
                                @foreach ($tasks as $task)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $task->title ?? '' }}</td>
                                        <td>{{ $task->description ?? '' }}</td>
                                        <td>{{ $task->due_date ?? '' }}</td>
                                        <td>
                                            <span class="btn btn-{{ $task->status_color }}">
                                                {{ $task->status_name ?? '' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="btn btn-{{ $task->priority_color ?? '' }}">
                                                {{ $task->priority ?? '' }}
                                            </span>
                                        </td>
                                        <td>
                                            @foreach ($task->users as $user)
                                                <span class="btn btn-primary">
                                                    {{ ucwords($user->name) ?? '' }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @can('update_task')
                                                <a href="{{ route('task.edit', $task->id) }}" class="btn btn-success"
                                                    title="Edit"> <i class="fa fa-cog"></i> </a>
                                                <a class="btn btn-warning" title="send mail"
                                                    href="{{ route('task.send', $task->id) }}">
                                                    <i class="fa fa-paper-plane"></i>
                                                </a>
                                            @endcan

                                            @can('delete_task')
                                                <a class="btn btn-danger" href="{{ route('task.delete', $task->id) }}">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            @endcan

                                            @can('toggle_task')
                                                @if ($task->status != 1 && $task->status != 2)
                                                    <a class="btn btn-warning" title="in progress"
                                                        href="{{ route('task.toggle', ['id' => $task->id, 'status' => 'in_progress']) }}">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                @endif
                                                @if ($task->status == 1 || $task->status != 2)
                                                    <a class="btn btn-info" title="mark as completed"
                                                        href="{{ route('task.toggle', ['id' => $task->id, 'status' => 'completed']) }}">
                                                        <i class="fa fa-check"></i>
                                                    </a>
                                                @endif
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            @endcan
                        </tbody>
                    </table>

                </div>

            </div>
        </div>

    </div>
    <!-- Button trigger modal -->


    @include('tasks.add-modal')
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script script src="{{ asset('js/task.js') }}"></script>
@endsection
