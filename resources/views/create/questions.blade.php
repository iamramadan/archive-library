@extends('layout.entry')
@section('title','Create Questionaires')
@section('heading','Create Questionaires')
@push('scripts')
<style>
  .animate-loading {
    animation: loadingBar 2s linear infinite;
  }
</style>
@endpush
@push('links')
    <style>
  @keyframes loadingBar {
    0% {
      transform: translateX(-100%);
    }
    100% {
      transform: translateX(100%);
    }
  }
</style>
@endpush
@section('main')
    <main class="max-w-3xl mx-auto p-4">
        <div class="w-full my-10 mx-auto bg-white shadow-lg rounded-xl p-6 hover:shadow-xl transition-shadow duration-300">
        <div class="w-12 h-1 bg-blue-500 rounded-full mx-auto mb-4"></div>
        <h2 class="text-2xl font-semibold text-gray-800 text-center mb-2">
            {{$questionaire->name}}
        </h2>
        <p class="text-gray-600 text-center">
            {{$questionaire->goal}}
        </p>
        </div>
        @livewire('create-questions',['id'=>$id])
    </main>
@endsection
