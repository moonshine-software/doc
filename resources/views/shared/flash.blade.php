@if(session('message'))
<x-alert title="Уведомление" color="bg-purple">
    {{ session('message') }}
</x-alert>
@endif