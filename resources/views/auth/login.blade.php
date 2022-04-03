@extends('layouts.app')

@section('content')
    <div class="section-div-1">
        <div class="register-div">
            @if (session('status'))
                <div class="login-error">
                {{ session('status') }}
                </div>
            @endif



           <form action="{{ route('login') }}" method="post">
                @csrf
    	        
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
                    <input type="password" name="password" id="password" placeholder="Your password" 
                    class="register-input @error('password') register-input-error @enderror" value="{{ old('password') }}">
                
                    @error('password')
                        <div class="error">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-div">
                    <div class="remember-me">
                        <input type="checkbox" name="remember" id="remember" class="mr-2 mb-1">
                        <label for="remember">Remember me</label>
                    </div>
                </div>
                
                <div>
                    <button type="submit" class="register-button">
                    Log in
                    </button>                               
                </div>

           </form>
        </div>
    </div>
@endsection
