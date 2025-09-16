@extends('layouts.app')

@section('title', 'Register')

@section('styles')
<style>
    
    /* Custom styling for the file input to match other fields */
    .file-input-wrapper {
        @apply relative w-full border-2 rounded-full;
        border-color: #fce0e8;
    }
    .file-input {
        @apply relative opacity-0 w-full h-full cursor-pointer;
    }
    .file-input-label {
        @apply absolute top-0 left-0 right-0 bottom-0 flex items-center pl-12 pr-4 py-3 text-gray-400;
    }
    .file-input-label .placeholder {
        @apply flex-1 text-gray-500;
    }
    .file-input-label .icon {
        @apply text-gray-400;
    }
    .file-input:focus + .file-input-label {
        @apply ring-2 ring-pink-500;
    }
</style>
@endsection


@section('content')
<div class="flex flex-col md:flex-row w-full max-w-6xl rounded-3xl overflow-hidden">
    <!-- left section -->
    <div class="flex-1 p-8 md:p-16 flex flex-col justify-center items-center mt-0 text-center">
        <h1 class="text-4xl sm:text-5xl font-extrabold text-pink-700 mb-0">ONLINE EDUCATION</h1>
        <p class="text-gray-600 max-w-sm mb-8">Create your account and start your journey with us.</p>
        
        <svg class="w-full h-auto max-w-md" viewBox="0 0 800 600" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="250" y="150" width="450" height="300" rx="20" fill="#E8F5E9" stroke="#4CAF50" stroke-width="5"/>
            <path d="M400 450L450 480H350L400 450Z" fill="#4CAF50"/>
            <rect x="300" y="200" width="350" height="30" rx="15" fill="#C8E6C9" stroke="#4CAF50" stroke-width="3"/>
            <rect x="300" y="250" width="300" height="30" rx="15" fill="#C8E6C9" stroke="#4CAF50" stroke-width="3"/>
            <rect x="300" y="300" width="320" height="30" rx="15" fill="#C8E6C9" stroke="#4CAF50" stroke-width="3"/>
            <rect x="300" y="350" width="280" height="30" rx="15" fill="#C8E6C9" stroke="#4CAF50" stroke-width="3"/>
            
            <circle cx="200" cy="500" r="50" fill="#D1D5DB"/>
            <path d="M150 500L175 400L225 400L250 500Z" fill="#D1D5DB"/>
            <path d="M220 400L250 350L280 380" stroke="#4B5563" stroke-width="5" stroke-linecap="round"/>
            <path d="M260 365L270 375" stroke="#4B5563" stroke-width="5" stroke-linecap="round"/>
            <path d="M190 400C190 380 210 380 210 400" stroke="#4B5563" stroke-width="5"/>
            
            <rect x="50" y="450" width="150" height="100" rx="10" fill="#E8F5E9" stroke="#4CAF50" stroke-width="3"/>
            <circle cx="125" cy="480" r="15" fill="#4CAF50"/>
            <rect x="80" y="505" width="90" height="10" rx="5" fill="#4CAF50"/>
        </svg>
    </div>


    <!-- right section -->
    <div class="flex-1 p-4 md:p-10 flex items-center justify-center bg-white rounded-3xl md:rounded-l-none md:rounded-r-3xl">
        <div class="w-full max-w-sm">
            <h2 class="text-4xl font-bold text-center text-gray-800 mb-2">USER REGISTRATION</h2>
            <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="relative mb-4">
                    <input type="text" id="name"  placeholder="Name"
                           class="w-full pl-12 pr-4 py-2 rounded-full border-2 focus:outline-none focus:ring-2 focus:ring-pink-500 transition-colors @error('name') is-invalid @enderror"  name="name" value="{{ old('name') }}" required autofocus
                           style="border-color: #fce0e8;">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                        <i class="fas fa-user"></i>
                    </span>
                </div>

                <div class="relative mb-4">
                    <input type="email" id="email" name="email" placeholder="Email Address"
                           class="w-full pl-12 pr-4 py-2 rounded-full border-2 focus:outline-none focus:ring-2 focus:ring-pink-500 transition-colors @error('email') is-invalid @enderror" value="{{ old('email') }}" required
                           style="border-color: #fce0e8;">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                        <i class="fas fa-envelope"></i>
                    </span>
                </div>

                <div class="relative mb-4">
                    <input type="text" id="city" name="city" placeholder="City"
                           class="w-full pl-12 pr-4 py-2 rounded-full border-2 focus:outline-none focus:ring-2 focus:ring-pink-500 transition-colors @error('city') is-invalid @enderror" value="{{ old('city') }}"
                           style="border-color: #fce0e8;">
                    @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                        <i class="fas fa-city"></i>
                    </span>
                </div>

                <div class="relative mb-4">
                    <input type="text" id="cnic" name="cnic" placeholder="CNIC"
                           class="w-full pl-12 pr-4 py-2 rounded-full border-2 focus:outline-none focus:ring-2 focus:ring-pink-500 transition-colors @error('cnic') is-invalid @enderror" value="{{ old('cnic') }}"
                           style="border-color: #fce0e8;">
                    @error('cnic')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                        <i class="fas fa-id-card"></i>
                    </span>
                </div>

                <div class="relative mb-4">
                    <div class="file-input-wrapper">
                        <input type="file" id="image" name="image" class="mb-2 file-input @error('image') is-invalid @enderror" value="{{ old('image') }}">
                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <label for="image" class="file-input-label">
                            <span class="icon absolute left-4"><i class="fas fa-camera"></i></span>
                            <span class="placeholder">Choose Profile Image</span>
                        </label>
                    </div>
                </div>

                <div class="relative mb-4">
                    <input type="password" id="password" name="password" placeholder="Password"
                           class="w-full pl-12 pr-4 py-2 rounded-full border-2 focus:outline-none focus:ring-2 focus:ring-pink-500 transition-colors @error('password') is-invalid @enderror"
                           style="border-color: #fce0e8;">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                        <i class="fas fa-lock"></i>
                    </span>
                </div>

                <div class="relative mb-4">
                    <input type="password" id="password-confirm" name="password_confirmation" placeholder="Confirm Password"
                           class="w-full pl-12 pr-4 py-2 rounded-full border-2 focus:outline-none focus:ring-2 focus:ring-pink-500 transition-colors"
                           style="border-color: #fce0e8;">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                        <i class="fas fa-lock"></i>
                    </span>
                </div>
                
                <div class="flex justify-center">
                    <button type="submit"
                             class="w-full py-2 text-lg font-bold text-white rounded-full bg-pink-500 hover:bg-pink-600 transition-colors focus:outline-none focus:ring-2 focus:ring-pink-500">
                        REGISTER
                    </button>
                </div>

                <div class="text-center mt-2">
                    <a href="#" class="text-sm font-medium text-gray-600 hover:text-pink-500">Already have an account?</a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection