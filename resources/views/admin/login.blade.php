<!DOCTYPE html>
<html>
<head><title>Login Khusus Admin</title></head>
<body>
    <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Login</button>
    </form>
</body>
</html>
