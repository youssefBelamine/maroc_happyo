<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bootstrap Test</title>
    @vite(['resources/css/bootstrap_app.css', 'resources/js/app.js']) {{-- Ensure Vite is set up --}}
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="alert alert-success text-center">
            Bootstrap is working! 🎉
        </div>

        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                Test Card
            </div>
            <div class="card-body">
                <h5 class="card-title">Hello from Bootstrap</h5>
                <p class="card-text">This is a simple card to confirm Bootstrap is correctly set up.</p>
                <a href="#" class="btn btn-outline-primary">Click Me</a>
            </div>
        </div>
    </div>

</body>
</html>
