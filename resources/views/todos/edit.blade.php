
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Filtered Task') }}
        </h2>
    </x-slot>
    
    {{$todo}}
    <x-app-layout>
