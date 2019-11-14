@if (Auth::guard('web')->check())
    <p class="text-success">
        You are logged in as <strong>USER</strong>
    </p>
@endif

@if (Auth::guard('admin')->check())
    <p class="text-success">
        You are logged in as <strong>ADMIN</strong>
    </p>
@endif