@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="d-flex align-items-center mb-4">
            <img src="{{ URL('images/user.png') }}" class="img-fluid mr-3" width="50" height="50"
                alt="Contact List Image">
            <h1 class="" style=" color: #052415;">Users</h1>
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


        <form action="{{ route('users.index') }}" method="get" class="mb-3">
            <div class="row align-items-center">
                <div class="col-md-4 mb-3">
                    <div class="input-group" style="width: 100%;">
                        <input type="text" class="form-control" placeholder="Search by name" name="search"
                            value="{{ request('search') }}">
                    </div>
                </div>

                <!-- Dropdown for Roles -->
                <div class="col-md-4 mb-3">
                    <div class="input-group" style="width: 100%;">
                        <select class="form-select" id="roleFilter" name="role">
                            <option value="" disabled selected>Filter by Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}" {{ $role == request('role') ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Dropdown for Status Tabs -->
                <div class="col-md-4 mb-3">
                    <div class="input-group" style="width: 100%;">
                        <select class="form-select" id="statusFilter" name="status">
                            <option value="" disabled selected>Filter by Status</option>
                            <option value="all" {{ old('status', request('status')) == 'all' ? 'selected' : '' }}>All
                            </option>
                            <option value="ACTIVE" {{ old('status', request('status')) == 'ACTIVE' ? 'selected' : '' }}>
                                Active</option>
                            <option value="INACTIVE"
                                {{ old('status', request('status')) == 'INACTIVE' ? 'selected' : '' }}>Inactive</option>
                            <option value="BANNED"
                                {{ old('status', request('status')) == 'BANNED' ? 'selected' : '' }}>Banned</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-0 mb-3 d-flex justify-content-end">
                <button class="btn btn-outline " style="background-color: #fcc80a;" type="submit">Search</button>
            </div>
        </form>


        <!-- Button to trigger create modal -->
        <button class="btn pmd-btn-fab pmd-ripple-effect btn-light pmd-btn-raised fixed-bottom-right circular-btn"
            data-bs-toggle="modal" data-bs-target="#createUserModal">
            <i class="material-icons pmd-sm">
                <img src="images/create-user.png" alt="Brand Image" class="circular-img"
                    style="width: 35px; height: 42px; cursor: pointer;">
            </i>
        </button>


        <!-- Create User Modal -->
        <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createUserModalLabel">Create User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Your create form goes here -->
                        <form method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone:</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="mb-3">
                                <label for="photo" class="form-label">User Photo</label>
                                <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status:</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="ACTIVE">Active</option>
                                    <option value="INACTIVE">Inactive</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="roles" class="form-label">Roles:</label>
                                <select class="form-select" id="roles" name="roles[]" multiple>
                                    @foreach ($backendRoles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Add more fields as needed -->
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Display the list of users in a table view -->

        <tbody>
            <div class="row ">
                @foreach ($users as $user)
                    <div class="col-sm-6 col-md-4 col-lg-3 brand-card" style="margin-bottom: 185px;">
                        <a href="#" class="card-link">
                            <div class=" card"
                                style="margin-bottom: 185px; @if ($user->status == 'INACTIVE') background-color: #FAA0A0; @endif">
                                <!-- Button in the top-right corner, pushed a bit down -->
                                <img class="card-img d-none mx-auto mt-3" style="max-width: 100px; height: 100px;">

            <div class="card-body text-center" data-bs-toggle="modal"data-bs-target="#viewUserModal{{ $user->id }}">
            <span class="mb-3 rounded-square"  data-bs-toggle="modal" data-bs-target="#viewUserModal{{ $user->id }}">
    <span class="material-symbols-outlined">
        account_circle
    </span>
</span>


                    <h4 class="card-title text-left pl-2"><a class="text-dark" href="#" style="font-size: 1rem;">{{ $user->name }}</a></h4>
                    <h4 class="card-title text-left pl-2"><a class="text-dark" href="#" style="font-size: 1rem;">{{ $user->phone }}</a></h4>
                    <h4 class="card-title text-left pl-2"><a class="text-dark" href="#" style="font-size: 1rem;"> {{ $user->roles ? implode(', ', $user->roles->pluck('name')->toArray()) : '' }}</a></h4>

                                    <button type="button" class="btn btn-sm position-absolute top-0 end-0 edit-btn"
                                        style="z-index: 1;">
                                        <img src="{{ asset('images/edit.png') }}" alt="Button Icon"
                                            style="max-width: 20px; max-height: 20px;" data-bs-toggle="modal"
                                            data-bs-target="#editUserModal{{ $user->id }}">
                                    </button>
                                </div>
                            </div>
                    </div>
                    </a>
                    <!-- View User Modal -->
                    <div class="modal fade" id="viewUserModal{{ $user->id }}" tabindex="-1"
                        aria-labelledby="viewUserModalLabel{{ $user->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewUserModalLabel{{ $user->id }}">View User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Add your fields to display the user details -->
                                    <p><strong>Name:</strong> {{ $user->name }}</p>
                                    <p><strong>Email:</strong> {{ $user->email }}</p>
                                    <p><strong>Phone:</strong> {{ $user->phone }}</p>
                                    <p><strong>Status:</strong> {{ $user->status }}</p>
                                    <p><strong>Roles:</strong>
                                        {{ $user->roles ? implode(', ', $user->roles->pluck('name')->toArray()) : '' }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
        </tbody>
        </table>

        <div class="pagination-container">
            <nav aria-label="Page navigation">
                <ul class="pagination">

                    {{-- Previous Page Link --}}
                    @if ($users->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link" aria-hidden="true">&laquo;</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $users->previousPageUrl() }}" rel="prev"
                                aria-label="@lang('pagination.previous')">&laquo;</a>
                        </li>
                    @endif

                    {{-- Page Numbers --}}
                    @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                        <li class="page-item {{ $users->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($users->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $users->nextPageUrl() }}" rel="next"
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

        <!-- Edit User Modals -->
        @foreach ($users as $user)
            <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1"
                aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">Edit User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Your edit form goes here -->
                            <form method="post" action="{{ route('users.update', $user->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name:</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $user->name }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ $user->email }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone:</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        value="{{ $user->phone }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="photo" class="form-label">User Photo</label>
                                    <input type="file" class="form-control" id="photo" name="photo"
                                        accept="image/*">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editStatus" class="form-label">Status:</label>
                                    <select class="form-select" id="editStatus" name="status" required>
                                        <option value="ACTIVE" {{ $user->status == 'active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="INACTIVE" {{ $user->status == 'inactive' ? 'selected' : '' }}>
                                            Inactive</option>
                                        <option value="BANNED" {{ $user->status == 'BANNED' ? 'selected' : '' }}>Banned</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="editRoles" class="form-label">Roles:</label>
                                    <select class="form-select" id="editRoles" name="roles[]" multiple required>
                                        @foreach ($backendRoles as $role)
                                            <option value="{{ $role->id }}"
                                                {{ in_array($role->id, $user->roles->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Add more fields as needed -->
                                <div class="button-container">
                                    <button type="submit" class="btn btn-primary float-end">Update user</button>
                            </form>
                            <form action="{{ route('users.destroy', $user->id) }}" method="post"
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
