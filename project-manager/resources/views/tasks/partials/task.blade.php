<div class="card mb-3">
    <div class="card-body">
        <div class="form-group">
            <label for="task_name">Nama Task:</label>
            <input type="text" class="form-control" name="task_name[]" value="{{ $task->task_name ?? '' }}" required>
        </div>

        <div class="form-group">
            <label for="assigned_to">Diberikan kepada:</label>
            <input type="text" class="form-control" name="assigned_to[]" value="{{ $task->assigned_to ?? '' }}" required>
        </div>

        <div class="form-group">
            <label for="task_status">Status Task:</label>
            <select class="form-control" name="task_status[]">
                <option value="Pending" {{ (isset($task) && $task->status == 'Pending') ? 'selected' : '' }}>Pending</option>
                <option value="Completed" {{ (isset($task) && $task->status == 'Completed') ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <div class="form-group">
            <label for="due_date">Tanggal Deadline:</label>
            <input type="date" class="form-control" name="due_date[]" value="{{ $task->due_date ?? '' }}">
        </div>
    </div>
</div>