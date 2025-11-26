@extends('layouts.app')

@section('title', 'Viewer Dashboard')

@section('content')
    <div class="dashboard-container">
        
        @include('components.user-info-card')

        {{-- Student Records Table component --}}
        <x-student-records-table 
            :records="$records" 
            :show-action="false" 
        />
    </div>
@endsection
