<!--edit  Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Task</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body modal-data">
                <form action="{{ route('task.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="task_id" id="taskId">
                    <div class="mb-3 form-group">
                        <label for="exampleInputEmail1" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" id="edit_title"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="exampleInputPassword1" class="form-label">Description</label>
                        <input type="text" name="description" class="form-control" id="edit_description">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="exampleInputPassword1" class="form-label">Due date</label>
                        <input type="date" name="due_date" class="form-control" id="edit_due_date">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="exampleInputPassword1" class="form-label">Priority</label>
                        <select name="priority" id="edit_priority" class="form-control">
                            <option value="high">High</option>
                            <option value="medium">Medium</option>
                            <option value="low">Low</option>
                        </select>
                    </div>
                    <div class="mb-3 form-group">
                        <label for="select2Multiple" class="form-label">Assigned To</label>

                        <select class="form-control select2" id="edit_user_ids" multiple name="user_ids[]" required>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>

                    </div>
                    <button type="submit" class="btn btn-primary" id="btn-submit">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="close_modal">اغلاق</button>
            </div>
        </div>
    </div>
</div>
