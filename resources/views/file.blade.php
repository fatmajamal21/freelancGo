<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>رفع صورة</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('file') }}" method="POST" enctype="multipart/form-data" class="card p-3">
        @csrf
        <div class="mb-3">
            <label for="file" class="form-label">اختر صورة:</label>
            <input type="file" class="form-control" name="file" id="file" required>
        </div>
        <button type="submit" class="btn btn-primary">رفع الصورة</button>
    </form>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
