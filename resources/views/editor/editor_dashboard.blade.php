@extends('layouts.app')

@section('title', 'Editor Dashboard')

@section('content')
<div class="dashboard-container">

    {{-- User Info Card --}}
    @include('components.user-info-card')

    {{-- Student Records Table --}}
    <x-student-records-table 
        :records="$records" 
        :show-action="true" 
    />

</div>
@endsection
