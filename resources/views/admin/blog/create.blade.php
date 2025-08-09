@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>{{ session('success') }}</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
          <div class="col-lg-12 col-md-8 mb-4 order-0">
            <div class="card">
                <h5 class="card-header">Create Blog Post</h5>
                <a href="{{ route('blog.index') }}" class="btn btn-primary m-3" style="float: right; width: 14%;">Manage Blog</a>
                <div class="col-xxl">
                  <div class="card mb-4">
                    <div class="card-body">
                      <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                      @csrf 
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Blog Title</label>
                          <div class="col-sm-10">
                            <input type="text" name="title" class="form-control" required placeholder="Blog Title">
                          </div>
                          @error('title')
                            <span class="text-danger">{{ $message }}</span> 
                          @enderror
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-company">Image</label>
                          <div class="col-sm-10">
                            <input type="file" class="form-control" name="image" >
                          </div>
                           @error('image')
                            <span class="text-danger">{{ $message }}</span> 
                          @enderror
                        </div>
                       
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-message">Description</label>
                          <div class="col-sm-10">
                            <textarea id="basic-default-message" name="description" class="form-control" placeholder="write blog description" required></textarea>
                          </div>
                           @error('description')
                            <span class="text-danger">{{ $message }}</span> 
                          @enderror
                        </div>
                        <div class="row justify-content-end">
                          <div class="col-sm-10">
                            <button type="submit" class="btn btn-success">Submit</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    <!-- / Content -->
  </div>
      
@endsection
