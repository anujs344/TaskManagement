
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Task') }}
        </h2>
    </x-slot>
    <h1>Edit To-Do</h1>
    <form action="{{ route('todos.update', $todo) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="{{ $todo->title }}" required>
        <label for="description">Description</label>
        <textarea name="description" id="description">{{ $todo->description }}</textarea>
        <label for="due_date">Due Date</label>
        <input type="date" name="due_date" id="due_date" value="{{ $todo->due_date }}">
        <label for="completion_status">Completion Status</label>
        <select name="completion_status" id="completion_status">
            <option value="0" {{ $todo->completion_status == '0' ? 'selected' : '' }}>Pending</option>
            <option value="1" {{ $todo->completion_status == '1' ? 'selected' : '' }}>Completed</option>
        </select>
        <label for="comments">Comments</label>
        <textarea name="comments" id="comments">{{ $todo->comments }}</textarea>
        <button type="submit">Update</button>
    </form>
    <x-app-layout>
