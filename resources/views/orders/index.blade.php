
@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded-xl shadow-md border border-gray-100">

    <!-- Alerta de Sucesso -->
    @if(session('success'))
        <div id="alert-message"
             class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm flex justify-between items-center">

            <p class="font-medium">
                {{ session('success') }}
            </p>

            <button type="button"
                    onclick="document.getElementById('alert-message').remove()"
                    class="text-green-700 font-bold px-2">
                &times;
            </button>
        </div>
    @endif

    <!-- Componente Livewire -->
    <livewire:orders.order-search />

</div>
@endsection
