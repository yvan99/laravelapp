<h1>Login form</h1>
<form action="{{ route("user.login")}}" method="post">
    @csrf
    <input type="email" name="email" id="" value="{{ old('email') }}">
    @error("email")
        <span>{{$message}}</span>
    @enderror
    <input type="password" name="password">

    <input type="checkbox" name="remember_me" >
    <button type="submit">Login</button>
</form>