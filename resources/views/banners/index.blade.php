<!-- resources/views/banners/index.blade.php -->

@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="d-flex align-items-center mb-4">
        <img src="{{ URL('images/banner.png') }}" class="img-fluid mr-3" width="50" height="50" alt="Banner Icon">
        <h1 class="" style=" color: #052415;">Banners</h1>
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

    <!-- Display the list of banners in a table view -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Payload</th>
                <th>Photo</th>
                <th>Size</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($banners as $banner)
                <tr>
                    <td>{{ $banner->id }}</td>
                    <td>{{ $banner->name }}</td>
                    <td>{{ $banner->description }}</td>
                    <td>{{ $banner->payload }}</td>
                    <td>
                    <img src="{{ asset('storage/' . $banner->photo) }}" alt="Banner Photo" style="max-width: 100px; max-height: 100px;">


                    </td>
                    <td>{{ $banner->size }}</td>
                    <td>{{ $banner->status }}</td>
                    <td>
                        <!-- Button to trigger show modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#showBannerModal{{ $banner->id }}">
                            Show
                        </button>

                        <!-- Button to trigger edit modal -->
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                            data-bs-target="#editBannerModal{{ $banner->id }}">
                            Edit
                        </button>

                        <!-- Form to trigger delete action -->
                        <form action="{{ route('banners.destroy', $banner->id) }}" method="post"
                            style="display:inline;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this banner?')">Delete</button>
                        </form>
                    </td>
                </tr>

                <!-- Show Banner Modal -->
                <div class="modal fade" id="showBannerModal{{ $banner->id }}" tabindex="-1"
                    aria-labelledby="showBannerModalLabel{{ $banner->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="showBannerModalLabel{{ $banner->id }}">Show Banner</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Your show content goes here -->
                                <p><strong>Name:</strong> {{ $banner->name }}</p>
                                <p><strong>Description:</strong> {{ $banner->description }}</p>
                                <p><strong>Payload:</strong> {{ $banner->payload }}</p>
                                <p><strong>Photo:</strong> <img src="{{ env('APP_URL') . '/storage/' . $banner->photo }}" alt="Banner Photo"
                                        style="max-width: 100px; max-height: 100px;"></p>
                                <p><strong>Size:</strong> {{ $banner->size }}</p>
                                <p><strong>Status:</strong> {{ $banner->status }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Banner Modal -->
                <div class="modal fade" id="editBannerModal{{ $banner->id }}" tabindex="-1"
                    aria-labelledby="editBannerModalLabel{{ $banner->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editBannerModalLabel{{ $banner->id }}">Edit Banner</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Your edit form goes here -->
                                <form method="post" action="{{ route('banners.update', $banner->id) }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label for="editName{{ $banner->id }}" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="editName{{ $banner->id }}"
                                            name="name" value="{{ $banner->name }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="editDescription{{ $banner->id }}"
                                            class="form-label">Description</label>
                                        <textarea class="form-control" id="editDescription{{ $banner->id }}"
                                            name="description" rows="3" required>{{ $banner->description }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="editPayload{{ $banner->id }}" class="form-label">Payload</label>
                                        <input type="text" class="form-control" id="editPayload{{ $banner->id }}"
                                            name="payload" value="{{ $banner->payload }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="editPhoto{{ $banner->id }}" class="form-label">Photo</label>
                                        <input type="file" class="form-control" id="editPhoto{{ $banner->id }}"
                                            name="photo" accept="image/*">
                                    </div>

                                    <div class="mb-3">
                                        <label for="editSize{{ $banner->id }}" class="form-label">Size</label>
                                        <select class="form-select" id="editSize{{ $banner->id }}" name="size"
                                            required>
                                            <option value="S" {{ $banner->size === 'S' ? 'selected' : '' }}>Small</option>
                                            <option value="M" {{ $banner->size === 'M' ? 'selected' : '' }}>Medium</option>
                                            <option value="L" {{ $banner->size === 'L' ? 'selected' : '' }}>Large</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="editStatus{{ $banner->id }}" class="form-label">Status</label>
                                        <select class="form-select" id="editStatus{{ $banner->id }}" name="status"
                                            required>
                                            <option value="ACTIVE" {{ $banner->status === 'ACTIVE' ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="INACTIVE"
                                                {{ $banner->status === 'INACTIVE' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update Banner</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>

    <!-- Button to trigger create modal -->
    <button class="btn pmd-btn-fab pmd-ripple-effect btn-light pmd-btn-raised fixed-bottom-right circular-btn" data-bs-toggle="modal" data-bs-target="#createBannerModal">
    <i class="material-icons pmd-sm">
        <img src="images/plus.png" alt="Brand Image" class="circular-img" style="width: 32px; height: 40px; cursor: pointer;" >
    </i>
</button>

    <!-- Create Banner Modal -->
    <div class="modal fade" id="createBannerModal" tabindex="-1" aria-labelledby="createBannerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createBannerModalLabel">Create Banner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Your create form goes here -->
                    <form method="post" action="{{ route('banners.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="createName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="createName" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="createDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="createDescription" name="description"
                                rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="createPayload" class="form-label">Payload</label>
                            <input type="text" class="form-control" id="createPayload" name="payload" required>
                        </div>

                        <div class="mb-3">
                            <label for="createPhoto" class="form-label">Upload Photo</label>
                            <input type="file" class="form-control" id="createPhoto" name="photo" accept="image/*" required>
                        </div>

                        <div class="mb-3">
                            <label for="createSize" class="form-label">Size</label>
                            <select class="form-select" id="createSize" name="size" required>
                                <option value="S">Small</option>
                                <option value="M" selected>Medium</option>
                                <option value="L">Large</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="createStatus" class="form-label">Status</label>
                            <select class="form-select" id="createStatus" name="status" required>
                                <option value="ACTIVE" selected>Active</option>
                                <option value="INACTIVE">Inactive</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Save Banner</button>
</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
