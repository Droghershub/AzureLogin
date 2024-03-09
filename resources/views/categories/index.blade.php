<!-- resources/views/categories/index.blade.php -->

@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="d-flex align-items-center mb-4">
        <img src="{{ URL('images/classification.png') }}" class="img-fluid mr-3" width="50" height="50" alt="Contact List Image">
        <h1 class="" style=" color: #052415;">Categories</h1>
    </div>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if (session('failure'))
    <div class="alert alert-danger">
        <ul>
            @foreach (session('failure')->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- categories.blade.php -->
    <div class="col-12">
        <form action="{{ route('categories.index') }}" method="get" class="mb-3">
            <div class="row align-items-center">
                <div class="col-md-6 mb-3">
                    <div class="input-group" style="width: 100%;">
                        <input type="text" class="form-control" placeholder="Search by name" name="search" value="{{ old('search', request('search')) }}">
                    </div>
                </div>
                <div class="col-md-6 mb-3 d-flex">
                    <!-- Dropdown for Status Tabs -->
                    <div class="input-group" style="width: 70%; margin-left: 10px;">
                        <select class="form-select" id="statusFilter" name="status">
                            <option value="" disabled selected>Filter by Status</option>
                            <option value="all" {{ old('status', request('status')) == 'all' ? 'selected' : '' }}>All</option>
                            <option value="ACTIVE" {{ old('status', request('status')) == 'ACTIVE' ? 'selected' : '' }}>Active</option>
                            <option value="INACTIVE" {{ old('status', request('status')) == 'INACTIVE' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div class="ml-auto mr-5">
                        <button class="btn btn-outline " style="background-color: #fcc80a;" type="submit">Search</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Display categories here -->

    <!-- Button to trigger create modal -->
    <button class="btn pmd-btn-fab pmd-ripple-effect btn-light pmd-btn-raised fixed-bottom-right circular-btn" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
        <i class="material-icons pmd-sm">
            <img src="images/plus.png" alt="Brand Image" class="circular-img" style="width: 32px; height: 40px; cursor: pointer;">
        </i>
    </button>
    <!-- Create Category Modal -->
    <div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createCategoryModalLabel">Create Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Your create form goes here -->
                    <form method="post" action="{{ route('categories.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="form-label">Product Photo</label>
                            <input type="file" class="form-control" id="photo" name="photo" accept="image/*" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description:</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Save Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Display the list of categories in a table view -->

    <div class="row">
        @foreach ($categories as $category)
        <!-- Edit button to trigger edit modal -->
        <div class="col-sm-6 col-md-4 col-lg-3 brand-card" style="margin-bottom: 185px;">
            <a href="#" class="card-link">
                <div class="card" style="margin-bottom: 185px; @if ($category->status == 'INACTIVE') background-color: #FAA0A0; @endif">
                    <!-- Button in the top-right corner, pushed a bit down -->
                    <img class="card-img d-none mx-auto mt-3" style="max-width: 100px; height: 100px;">
                    <div class="card-body text-center" data-bs-toggle="modal" data-bs-target="#viewCategoryModal{{ $category->id }}">
                        <span class="material-symbols-outlined mb-3 " data-bs-toggle="modal" data-bs-target="#viewCategoryModal{{ $category->id }}">category</span>
                        <h4 class="card-title text-left pl-2"><a class="text-dark" href="#" style="font-size: 1rem;">{{ $category->name }}</a></h4>
                        <h4 class="card-title text-left pl-2"><a class="text-dark" href="#" style="font-size: 1rem;">{{ $category->status }}</a></h4>
                        <p>
                            <button type="button" class="btn btn-sm position-absolute top-0 end-0 edit-btn" style="z-index: 1;">
                                <img src="{{ asset('images/edit.png') }}" alt="Button Icon" style="max-width: 20px; max-height: 20px;" data-bs-toggle="modal" data-bs-target="#editCategoryModal{{ $category->id }}">
                            </button>
                        </p>
                    </div>
                </div>
            </a>
        </div>

        <!-- View Category Modal -->
        <div class="modal fade" id="viewCategoryModal{{ $category->id }}" tabindex="-1" aria-labelledby="viewCategoryModalLabel{{ $category->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewCategoryModalLabel{{ $category->id }}">View Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Name:</strong> {{ $category->name }}</p>
                        <p><strong>Description:</strong> {{ $category->description }}</p>
                        <p><strong>Status:</strong> {{ $category->status }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Category Modal -->
        <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1" aria-labelledby="editCategoryModalLabel{{ $category->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCategoryModalLabel{{ $category->id }}">Edit Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Your edit form goes here -->
                        <form method="post" action="{{ route('categories.update', $category->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="editName" class="form-label">Name:</label>
                                <input type="text" class="form-control" id="editName" name="name" value="{{ $category->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="photo" class="form-label">Product Photo</label>
                                <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label for="editDescription" class="form-label">Description:</label>
                                <textarea class="form-control" id="editDescription" name="description" rows="3">{{ $category->description }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="editStatus" class="form-label">Status:</label>
                                <select class="form-select" id="editStatus" name="status">
                                    <option value="ACTIVE" {{ $category->status == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="INACTIVE" {{ $category->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <div>
                                <form>
                                    <!-- Your form elements go here -->
                                    <button type="submit" class="btn btn-primary float-end">Update Category</button>
                                </form>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="post" style="display:inline;">
                                    @csrf
                                    @method('delete')
                                    <div style="display: inline;">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="pagination-container">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($categories->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link" aria-hidden="true">&laquo;</span>
            </li>
            @else
            <li class="page-item">
                <a class="page-link" href="{{ $categories->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&laquo;</a>
            </li>
            @endif

            {{-- Page Numbers --}}
            @foreach ($categories->getUrlRange(1, $categories->lastPage()) as $page => $url)
            <li class="page-item {{ $categories->currentPage() == $page ? 'active' : '' }}">
                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
            </li>
            @endforeach

            {{-- Next Page Link --}}
            @if ($categories->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $categories->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&raquo;</a>
            </li>
            @else
            <li class="page-item disabled">
                <span class="page-link" aria-hidden="true">&raquo;</span>
            </li>
            @endif

        </ul>
    </nav>
</div>

@endsection
