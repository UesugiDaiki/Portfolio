@include('components.admin_html_head')

<body>
    <style>
        html,
        body {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .child {
            width: 25rem;
            height: 25rem;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 4px 0;
        }
    </style>

    <div class="child">
        <h2>Login</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" required>
            </div>
            <button type="submit" class="btn btn-outline-success">Login</button>
        </form>
    </div>
</body>
</html>