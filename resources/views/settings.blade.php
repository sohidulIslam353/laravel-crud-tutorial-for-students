@extends('layouts.app')
@section('content')
@push('styles')
<style>
   
</style>
@endpush 
<div class="container" id="profile-page">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="card">
                <div class="card-header"> Change Your Password</div>

                <div class="card-body">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                    </div>
                    @error('current_password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                     <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Retype Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                    @error('password_confirmation')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

@endpush


