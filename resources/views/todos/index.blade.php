
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Task') }}
        </h2>
    </x-slot>
    <h1>Your To-Dos</h1>
    <a href="{{ route('todos.create') }}">Create New To-Do</a>
    <ul>
        @foreach($todos as $todo)
            <li>
                <a href="{{ route('todos.edit', $todo) }}">{{ $todo->title }}</a>
                <form action="{{ route('todos.destroy', $todo) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
    <x-app-layout>
