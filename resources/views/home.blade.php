<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container mt-5 home">

        <style>
            @font-face {
                font-family: 'Bernoru';
                /* Include the path to the Bernoru font file in the src property */
                src: url('path-to-Bernoru-font.woff') format('woff');
                /* Add other font formats if needed (e.g., woff2, ttf) */
            }

            .admin {
                font-family: 'Bernoru', sans-serif;
            }
        </style>

        <h1 class="admin">
            <img src="{{ URL('images/manager.png') }}" class="img-fluid mr-3" width="50" height="50"
                alt="Contact List Image">
            Admin Panel
        </h1>

        <div class="mt-4">
        <a href="{{ route('users.index') }}" class="btn btn-lg" style="background-color: #fcc80a; color: #052415;">Users</a>
            <a href="{{ route('products.index') }}"class="btn btn-lg" style="background-color: #fcc80a; color:#052415;">Products</a>
            <a href="{{ route('brands.index') }}" class="btn btn-lg" style="background-color: #fcc80a; color: #052415;">Brands</a>
            <a href="{{ route('categories.index') }}" class="btn btn-lg" style="background-color:#fcc80a; color:#052415;">Categories</a>
           <a href="{{ route('contacts.index') }}" class="btn btn-lg" style="background-color: #fcc80a; color:#052415;">Contacts</a>
            <a href="{{ route('orders.index') }}" class="btn btn-lg" style="background-color: #fcc80a; color: #052415;">Orders</a>
            <a href="{{ route('banners.index') }}" class="btn btn-lg" style="background-color: #fcc80a; color: #052415;">Banners</a>


        </div>
    </div>
@endsection
