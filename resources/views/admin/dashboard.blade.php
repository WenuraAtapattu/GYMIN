@extends('layouts.app')

@section('title', 'Admin Dashboard - GymIn')

@section('content')
<div class="min-h-screen bg-gray-100">
    @livewire('admin-dashboard')
</div>
@endsection

@push('scripts')
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush