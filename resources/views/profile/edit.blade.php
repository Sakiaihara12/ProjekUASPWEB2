<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Saya</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4 text-center text-primary fw-bold">Profil Saya</h2>

    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- ✅ Update Profile Info -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Informasi Profil</h5>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- ✅ Update Password -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Ubah Password</h5>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- ✅ Delete Account -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3 text-danger">Hapus Akun</h5>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
