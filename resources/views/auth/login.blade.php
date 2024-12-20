<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="container d-flex flex-column align-items-center mt-2">
            <h3 class="text-center">Task Management System</h3>
            <img src="https://static.vecteezy.com/system/resources/previews/025/729/644/non_2x/project-management-icon-in-illustration-vector.jpg"
                alt="Project Management Icon" style="width: 50%; height: 50%;">
        </div>

        <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px;">
            <h3 class="text-center mb-4">Login</h3>
            <form method="POST" action="{{ route('login.submit') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" name="email" id="email"
                        class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email"
                        value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password"
                        class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password"
                        required>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="mb-3 form-check">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input">
                    <label class="form-check-label" for="remember">Remember Me</label>
                </div>

                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>

            <!-- Register Link -->
            <div class="text-center mt-3">
                <p class="mb-0">Don't have an account? <a href="{{ route('register') }}">Register</a></p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
