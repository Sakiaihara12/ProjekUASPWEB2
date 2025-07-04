<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #fb923c, #3b82f6); /* orange to blue */
            min-height: 100vh;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center">

    <div class="bg-white p-4 p-md-5 rounded-4 shadow-lg w-100" style="max-width: 400px;">
        <h2 class="text-center text-warning fw-bold mb-4">Register Admin</h2>

        @if ($errors->any())
            <div class="alert alert-danger p-2 small text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="/admin/register">
            @csrf

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input name="name" type="text" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input name="email" type="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input name="password" type="password" class="form-control" required>
            </div>

            <div class="mb-4">
                <label class="form-label">Confirm Password</label>
                <input name="password_confirmation" type="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-warning text-white fw-bold w-100">
                Register
            </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
