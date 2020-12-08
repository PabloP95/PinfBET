
<!-- SECTION: Registro-->
@extends('layouts.master')
@section('titulo')
<title>Registro</title>
@endsection
<!-- LAYOUT: CENTER -->
<!-- BLOCK: CENTER -->
@section('content')

<form method="post" action="{{ route('register') }}">
    @csrf
    <div class="form-group">
        <label>Username</label>
        <input type="text" name="name" class="form-control p_input">
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control p_input">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control p_input">
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary btn-block enter-btn">Register</button>
    </div>

    <p class="sign-up text-center">Already have an Account?<a href="{{ route('login') }}"> Sign In</a></p>
    <p class="terms">By creating an account you are accepting our<a href="#"> Terms & Conditions</a></p>
</form>

@endsection