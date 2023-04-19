@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-title">
            </div>
            <div class="card-body">
                <div class="">
                    <form class="w-px-500 p-3 p-md-3 add-task" action="{{ route('task.update') }}" method="post">
                        @csrf
                        <input type="hidden" name="task_id" value="{{ $task->id }}">
                        <div class="mb-3 form-group">
                            <label for="exampleInputEmail1" class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" id="title"
                                aria-describedby="emailHelp" value="{{ $task->title ?? '' }}">

                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 form-group">
                            <label for="exampleInputPassword1" class="form-label">Description</label>
                            <input type="text" name="description" value="{{ $task->description ?? '' }}"
                                class="form-control" id="description">

                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 form-group">
                            <label for="exampleInputPassword1" class="form-label">Due date</label>
                            <input type="date" name="due_date" value="{{ $task->due_date ?? '' }}" class="form-control"
                                id="due_date">

                            @error('due_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 form-group">
                            <label for="exampleInputPassword1" class="form-label">Priority</label>
                            <select name="priority" id="priority" class="form-control">
                                <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
                                <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium
                                </option>
                                <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                            </select>

                            @error('priority')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 form-group">
                            <label for="select2Multiple" class="form-label">Assigned To</label>
                            <select class="form-control select2" id="type" multiple name="user_ids[]" id="user_ids"
                                required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ (old('user_ids') != null && in_array($user->id, old('user_ids'))) ||
                                        (isset($task) &&
                                            in_array(
                                                $user->id,
                                                $task->users()->pluck('user_id')->toArray(),
                                            ))
                                            ? 'selected'
                                            : '' }}>
                                        {{ $user->name }}</option>
                                @endforeach
                            </select>


                            @error('user_ids')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary" id="btn-submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.select2').select2({
            theme: "classic",
        });
    </script>
@endsection
