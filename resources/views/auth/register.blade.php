@extends('layouts.app')

@section('content')
    <div class="section-div-1">
        <div class="register-div">
           <form action="{{ route('register') }}" method="post">
                @csrf
    	        <div class="form-div">
                    <label for="name" class="register-label">Name</label>
                    <input type="text" name="name" id="name" placeholder="Your name" 
                    class="register-input @error('name') register-input-error @enderror"  value="{{ old('name') }}">
                    
                    @error('name')
                        <div class="error">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-div">
                    <label for="username" class="register-label">Username</label>
                    <input type="text" name="username" id="username" placeholder="Username" 
                    class="register-input @error('username') register-input-error @enderror" value="{{ old('username') }}">

                    @error('username')
                        <div class="error">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-div">
                    <label for="email" class="register-label">Email</label>
                    <input type="text" name="email" id="email" placeholder="Your Email" 
                    class="register-input @error('email') register-input-error @enderror" value="{{ old('email') }}">
                
                    @error('email')
                        <div class="error">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-div">
                    <label for="password" class="register-label">Password</label>
                    <input type="password" name="password" id="password" placeholder="Choose a password" 
                    class="register-input @error('password') register-input-error @enderror" value="{{ old('password') }}">
                
                    @error('password')
                        <div class="error">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-div">
                    <label for="password_confirmation" class="register-label">Password again</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Repeat your password" 
                    class="register-input @error('password_confirmation') register-input-error @enderror" value="{{ old('password_confirmation') }}">
                
                    @error('password_confirmation')
                        <div class="error">
                            {{ $message }}
                        </div>
                    @enderror
                </div>   
                
                <div>
                    <button type="submit" class="register-button">
                    Register
                    </button>                               
                </div>

           </form>
        </div>
    </div>
@endsection
