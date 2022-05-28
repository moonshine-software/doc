@if(session('message'))
<x-alert title="Уведомление" color="bg-darkblue">
    {{ session('message') }}
</x-alert>
@endif