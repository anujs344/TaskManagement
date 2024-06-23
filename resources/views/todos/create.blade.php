<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Task') }}
        </h2>
    </x-slot>

    <!-- Toast Container -->
    <div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 100px;">
        <div id="toast-container" style="position: absolute; top: 0; right: 0;"></div>
    </div>
  
    <div class="d-flex justify-content-center">
        <button type="button" class="btn btn-primary mb-5 p-10" data-bs-toggle="modal" data-bs-target="#createModal">
            Create Task
        </button>
    </div>
    
    
    <nav class="navbar navbar-light bg-light">
        <form class="d-flex ms-auto" id="searchbox">
            <input class="form-control me-2" type="text" placeholder="Search by ID" aria-label="Search" name="searchbar" required>
            <button class="btn btn-outline-success viewBtn" type="submit" >Search</button>
        </form>
    </nav>
    <!-- Create Task Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Add Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="createTaskForm">
                    @csrf
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Title</span>
                            <input type="text" class="form-control" name="title" placeholder="Enter Title of Task..." aria-label="Title" aria-describedby="basic-addon1" >
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Description</span>
                            <textarea class="form-control" aria-label="With textarea" name="description"></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon2">Due Date</span>
                            <input type="date" class="form-control" aria-describedby="basic-addon2" name="due_date">
                        </div>
                        <label for="basic-url" class="form-label">Status</label>
                        <div class="input-group mb-3">
                            <select class="form-select" aria-label="Default select example" name="completion_status">
                                <option value="0" selected>Pending</option>
                                <option value="1">Completed</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Task Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editTaskForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editTaskId">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Title</span>
                            <input type="text" class="form-control" name="title" id="editTaskTitle" aria-label="Title" aria-describedby="basic-addon1" >
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Description</span>
                            <textarea class="form-control" aria-label="With textarea" name="description" id="editTaskDescription"></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon2">Due Date</span>
                            <input type="date" class="form-control" aria-describedby="basic-addon2" name="due_date" id="editTaskDueDate">
                        </div>
                        <label for="basic-url" class="form-label">Status</label>
                        <div class="input-group mb-3">
                            <select class="form-select" aria-label="Default select example" name="completion_status" id="editTaskStatus">
                                <option value="0">Pending</option>
                                <option value="1">Completed</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Task Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">View Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Title: <span id="viewTaskTitle"></span></h5>
                    <p>Description: <span id="viewTaskDescription"></span></p>
                    <p>Due Date: <span id="viewTaskDueDate"></span></p>
                    <p>Status: <span id="viewTaskStatus"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <h1  class="display-7 fw-bold">Your Tasks</h1>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($todos as $todo)
                <tr>
                    <th scope="row">{{ $todo->id }}</th>
                    <td>{{ $todo->title }}</td>
                    <td>
                        <button type="button" class="btn btn-warning editBtn" data-id="{{ $todo->id }}">Edit</button>
                        <button type="button" class="btn btn-primary viewBtn" data-id="{{ $todo->id }}">View</button>
                        {{-- <form class="d-inline deleteForm" action="{{ route('todos.delete', $todo->id) }}" method="post">
                            @csrf --}}
               
                            <button type="submit" class="btn btn-danger deleteBtn"  data-id="{{ $todo->id }}">Delete</button>
                        {{-- </form> --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    <script>
        function showToast(message) {
                var toastHTML = `
                    <div class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body text-danger">
                                ${message}
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                `;
                $('#toast-container').append(toastHTML);

                // Find the newly added toast element
                var toastElement = $('#toast-container').children('.toast:last');
                toastElement.toast({ delay: 5000 });
                // Bind close event when the close button is clicked
                toastElement.find('.btn-close').on('click', function() {
                    toastElement.toast('hide'); // Hide the toast when the close button is clicked
                });

                // Show the toast
                toastElement.toast('show');
            }
        $(document).ready(function() {
            // AJAX setup to include CSRF token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Create Task
            $('#createTaskForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "{{ route('todos.store') }}",
                    data: $(this).serialize(),
                    success: function(response) {
                        showToast('Task created successfully.');
                        location.reload();
                       
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            // Edit Task - show modal with existing data
            $('.editBtn').on('click', function() {
                var id = $(this).data('id');
                $.get('/todos/' + id, function(todo) {
                    $('#editTaskId').val(todo.id);
                    $('#editTaskTitle').val(todo.title);
                    $('#editTaskDescription').val(todo.description);
                    $('#editTaskDueDate').val(todo.due_date);
                    $('#editTaskStatus').val(todo.completion_status);
                    $('#editModal').modal('show');
                });
            });

            // Update Task
            $('#editTaskForm').on('submit', function(e) {
                e.preventDefault();
                var id = $('#editTaskId').val();
                $.ajax({
                    type: "PUT",
                    url: '/todos/' + id,
                    data: $(this).serialize(),
                    success: function(response) {
                        showToast('Task Edited successfully.');
                   
                        location.reload();
                        
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            // View Task
            $('.viewBtn').on('click', function() {
                var id = $(this).data('id');
                $.get('/todos/' + id, function(todo) {
                    $('#viewTaskTitle').text(todo.title);
                    $('#viewTaskDescription').text(todo.description);
                    $('#viewTaskDueDate').text(todo.due_date);
                    $('#viewTaskStatus').text(todo.completion_status == '1' ? 'Completed' : 'Pending');
                    $('#viewTaskComments').text(todo.comments);
                    $('#viewModal').modal('show');
                });
            });

            // Delete Task
            $('.deleteBtn').on('click', function() {
                var id = $(this).data('id');
                $.ajax({
                    type: "DELETE",
                    url: '/todos/' + id,
                    success: function(response) {
                        showToast('Task deleted successfully.');
                        location.reload();
                        
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            $('#searchbox').on('submit', function(e) {
                e.preventDefault();
                var id = $('input[name="searchbar"]').val();
                $.ajax({
                    type: "GET",
                    url: '/todos/exists/' + id,
                    success: function(response) {
                        $.get('/todos/' + id)
                            .done(function(todo) {
                                // Update UI elements with todo data
                                $('#viewTaskTitle').text(todo.title);
                                $('#viewTaskDescription').text(todo.description);
                                $('#viewTaskDueDate').text(todo.due_date);
                                $('#viewTaskStatus').text(todo.completion_status == '1' ? 'Completed' : 'Pending');
                                $('#viewTaskComments').text(todo.comments);
                                $('#viewModal').modal('show');
                            })
                            .fail(function() {
                                // Handle AJAX error (e.g., task not found)
                                showToast('Task not Exist.');
                               console.clear();
                            });
                        
                    },
                    error: function(error) {
                        showToast('Task not Exist.');
                        // location.reload();
                    }
                });
            });

        });
    </script>
</x-app-layout>
