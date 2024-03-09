<!-- resources/views/categories/index.blade.php -->

@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <div class="d-flex align-items-center mb-4">
            <img src="{{ URL('images/brand-image.png') }}" class="img-fluid mr-3" width="50" height="50"
                alt="Contact List Image">
            <h1 class="" style=" color: #052415;">Brands</h1>
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
            <form action="{{ route('brands.index') }}" method="get" class="mb-3">
                <div class="row align-items-center">
                    <div class="col-md-6 mb-3">
                        <div class="input-group" style="width: 100%;">
                            <input type="text" class="form-control" placeholder="Search by name" name="search"
                                value="{{ old('search', request('search')) }}">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3 d-flex">
                        <!-- Dropdown for Status Tabs -->
                        <div class="input-group" style="width: 70%; margin-left: 10px;">
                            <select class="form-select" id="statusFilter" name="status">
                                <option value="" disabled selected>Filter by Status</option>
                                <option value="all" {{ old('status', request('status')) == 'all' ? 'selected' : '' }}>All
                                </option>
                                <option value="ACTIVE" {{ old('status', request('status')) == 'ACTIVE' ? 'selected' : '' }}>
                                    Active</option>
                                <option value="INACTIVE"
                                    {{ old('status', request('status')) == 'INACTIVE' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="ml-auto mr-5">
                            <button class="btn btn-outline " style="background-color: #fcc80a;"
                                type="submit">Search</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>






        <!-- Include Raised Floating Action Button -->
        <button class="btn pmd-btn-fab pmd-ripple-effect btn-light pmd-btn-raised fixed-bottom-right circular-btn"
            data-bs-toggle="modal" data-bs-target="#createBrandModal">
            <i class="material-icons pmd-sm">
                <img src="images/plus.png" alt="Brand Image" class="circular-img"
                    style="width: 32px; height: 40px; cursor: pointer;">
            </i>
        </button>

        <!-- Create Brand Modal -->
        <div class="container mt-5">
            <div class="modal fade" id="createBrandModal" tabindex="-1" aria-labelledby="createBrandModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createBrandModalLabel">Create Brand</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Your create form goes here -->
                            <form method="post" action="{{ route('brands.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label for="contact_id" class="form-label">Contact ID:</label>
                                    <select class="form-select" id="contact_id" name="contact_id" required>
                                        <!-- Populate the options dynamically based on your brands data -->
                                        @foreach ($contacts as $contact)
                                            <option value="{{ $contact->id }}">{{ $contact->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="name" class="form-label">Brand Name:</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label for="photo" class="form-label">Brand Photo</label>
                                    <input type="file" class="form-control" id="photo" name="photo"
                                        accept="image/*" required>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Brand Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Save Brand</button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Display the list of brands in a table view -->

        <tbody>
            <div class="row ">
                @foreach ($brands as $brand)
                    <!-- Edit button to trigger edit modal -->

                            <div class="col-sm-6 col-md-4 col-lg-3 brand-card" style="margin-bottom: 185px;">
             <a href="#" class="card-link">
             <div class=" card" style="margin-bottom: 185px; @if($brand->status == 'INACTIVE') background-color: #FAA0A0; @endif">
            <!-- ... (existing code) ... -->
            <!-- Button in the top-right corner, pushed a bit down -->

            <div class="card-body text-center" data-bs-toggle="modal" data-bs-target="#viewBrandModal{{ $brand->id }}">

                    <span class="material-symbols-outlined" data-bs-toggle="modal" data-bs-target="#viewBrandModal{{ $brand->id }}">
                    Verified
                    </span>

                    <h4 class="card-title text-left pl-2"><a class="text-dark" href="#" style="font-size: 1rem;">{{ $brand->name }}</a></h4>
                    <h4 class="card-title text-left pl-2"><a class="text-dark" href="#" style="font-size: 1rem;">{{ $brand->contact_id }}</a></h4>
<p>

                                        <button type="button" class="btn btn-sm position-absolute top-0 end-0 edit-btn"
                                            style="z-index: 1;">
                                            <img src="{{ asset('images/edit.png') }}" alt="Button Icon"
                                                style="max-width: 20px; max-height: 20px;" data-bs-toggle="modal"
                                                data-bs-target="#editBrandModal{{ $brand->id }}">
                                        </button>
                                </div>
                            </div>
                    </div>
                    </a>
                @endforeach
        </tbody>


        <div class="pagination-container">
            <nav aria-label="Page navigation">
                <ul class="pagination">

                    {{-- Previous Page Link --}}
                    @if ($brands->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link" aria-hidden="true">&laquo;</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $brands->previousPageUrl() }}" rel="prev"
                                aria-label="@lang('pagination.previous')">&laquo;</a>
                        </li>
                    @endif

                    {{-- Page Numbers --}}
                    @foreach ($brands->getUrlRange(1, $brands->lastPage()) as $page => $url)
                        <li class="page-item {{ $brands->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($brands->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $brands->nextPageUrl() }}" rel="next"
                                aria-label="@lang('pagination.next')">&raquo;</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link" aria-hidden="true">&raquo;</span>
                        </li>
                    @endif

                </ul>
            </nav>
        </div>



        <!-- View Brand Modal -->
        @foreach ($brands as $brand)
            <div class="modal fade" id="viewBrandModal{{ $brand->id }}" tabindex="-1"
                aria-labelledby="viewBrandModalLabel{{ $brand->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewBrandModalLabel{{ $brand->id }}">View Brand</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Name:</strong> {{ $brand->name }}</p>
                            <p><strong>Contact ID:</strong> {{ $brand->contact_id }}</p>
                            <p><strong>Description:</strong> {{ $brand->description }}</p>
                            <p><strong>Status:</strong> {{ $brand->status }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Edit Brand Modals -->
        @foreach ($brands as $brand)
            <div class="modal fade" id="editBrandModal{{ $brand->id }}" tabindex="-1"
                aria-labelledby="editBrandModalLabel{{ $brand->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editBrandModalLabel{{ $brand->id }}">Edit Brand</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Your edit form goes here -->
                            <form method="post" action="{{ route('brands.update', $brand->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="contact_id" class="form-label">Contact ID:</label>
                                    <select class="form-select" id="contact_id" name="contact_id" required>
                                        <!-- Populate the options dynamically based on your brands data -->
                                        @foreach ($contacts as $contact)
                                            <option value="{{ $contact->id }}">{{ $contact->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="editName" class="form-label">Brand Name:</label>
                                    <input type="text" class="form-control" id="editName" name="name"
                                        value="{{ $brand->name }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="editPhoto" class="form-label">Brand Photo</label>
                                    <input type="file" class="form-control" id="editPhoto" name="photo"
                                        accept="image/*" required>
                                </div>

                                <div class="mb-3">
                                    <label for="editDescription" class="form-label">Brand Description</label>
                                    <textarea class="form-control" id="editDescription" name="description" rows="3">{{ $brand->description }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="editStatus" class="form-label">Status:</label>
                                    <select class="form-select" id="editStatus" name="status">
                                        <option value="ACTIVE" {{ $brand->status == 'active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="INACTIVE" {{ $brand->status == 'inactive' ? 'selected' : '' }}>
                                            Inactive</option>
                                    </select>
                                </div>
                                <div class="button-container">
                                    <button type="submit" class="btn btn-primary float-end">Update Brand</button>
                            </form>
                            <form action="{{ route('brands.destroy', $brand->id) }}" method="post"
                                style="display:inline;">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger "
                                    onclick="return confirm('Are you sure you want to delete this brand?')">Delete</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
    </div>
    @endforeach
    </div>
@endsection
