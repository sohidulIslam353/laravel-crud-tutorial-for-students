@extends('layouts.app')
@section('content')
@push('styles')
<style>
   
</style>
@endpush 
<div class="container" id="profile-page">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">
                Hey , {{ Auth::user()->name }} Your profile is ready!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        console.log("Profile page loaded successfully.");
    });
</script>
@endpush


