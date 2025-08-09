@extends('layouts.app')

@section('content')

<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
    </div>

    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Blog Lists</h5>
        <a href="{{ route('blog.create') }}" class="btn btn-primary">Create Blog</a>
      </div>

      <div class="card-body">
        <div class="row mb-3">
          <div class="col-lg-5 col-md-8">
            <form action="{{ route('blog.index') }}" method="GET" class="d-flex">
              <div class="input-group w-100">
                <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                <input type="text" class="form-control" value="{{ request('search') }}" name="search" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31">
                <button type="submit" class="btn btn-primary">Search</button>
              </div>
            </form>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-hover table-striped align-middle mb-0" style="min-width: 700px;">
            <thead class="table-light sticky-top">
              <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Image</th>
                <th>Create Time</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($blogs as $key => $blog)
              <tr>
                <td><strong>{{ $loop->iteration }}</strong></td>
                <td>{{ $blog->title }}</td>
                <td>{{ $blog->slug }}</td>
                <td>
                  <img src="{{ $blog->image }}" style="width: 90px; height: 50px; object-fit: cover;" alt="{{ $blog->title }}">
                </td>
                <td>{{ $blog->created_at->diffForHumans() }}</td>
                <td>
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{ route('blog.edit', $blog->slug) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a></li>
                      <li>
                        <form action="{{ route('blog.destroy', $blog->id) }}" method="POST" id="delete-form">
                          @csrf
                          @method('DELETE')
                          <button id="delete-button" type="submit" class="dropdown-item text-danger"><i class="bx bx-trash me-1"></i> Delete</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div class="mt-3 d-flex justify-content-center">
          {{ $blogs->links() }}
        </div>
      </div>
    </div>
  </div>
  <!-- / Content -->
</div>

@endsection
