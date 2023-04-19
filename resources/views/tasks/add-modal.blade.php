<!--  Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Task</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
                <form class="w-px-500 p-3 p-md-3 add-task" action="{{ route('task.store') }}" method="post">
                    @csrf

                    <div class="mb-3 form-group">
                        <label for="exampleInputEmail1" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" id="title"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="exampleInputPassword1" class="form-label">Description</label>
                        <input type="text" name="description" class="form-control" id="description">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="exampleInputPassword1" class="form-label">Due date</label>
                        <input type="date" name="due_date" class="form-control" id="due_date">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="exampleInputPassword1" class="form-label">Priority</label>
                        <select name="priority" id="priority" class="form-control">
                            <option value="">Select Priority</option>
                            <option value="high">High</option>
                            <option value="medium">Medium</option>
                            <option value="low">Low</option>
                        </select>
                    </div>
                    <div class="mb-3 form-group">
                        <label for="select2Multiple" class="form-label">Assigned To</label>

                        <select class="js-example-basic-singl form-control" multiple name="user_ids[]"
                            id="user_ids" required>

                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>

                    </div>

                    <button type="submit" class="btn btn-primary" id="btn-submit">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
