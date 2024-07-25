@extends('../layout/login')

@section('head')
<title>Login - SKO</title>
@endsection

@section('content')
<div class="flex items-center justify-center min-h-screen">
    <div class="bg-transparent rounded-lg p-8 w-full max-w-sm">
        <h1 class="font-[Azonix] text-7xl font-medium text-center mb-8">SKO</h1>
        <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="email" class="block font-MadeTommy text-black text-sm font-bold">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email"
                    class="mt-1 w-full px-3 py-4 border border-gray-300 rounded-xl shadow-sm bg-transparent focus:outline-none focus:ring-2 focus:ring-yellow-400"
                    required>
                <span class="text-red-600 text-sm" id="error-email"></span>
            </div>
            <div class="mb-6">
                <label for="password" class="block font-MadeTommy text-black text-sm font-bold">Password</label>
                <div class="relative">
                    <input type="password" id="password" name="password" placeholder="Enter your password"
                        class="mt-1 w-full px-3 py-4 border border-gray-300 rounded-md shadow-sm bg-transparent focus:outline-none focus:ring-2 focus:ring-yellow-400"
                        required>
                    <span class="text-red-600 text-sm" id="error-password"></span>
                    <button type="button" onclick="togglePasswordVisibility()"
                        class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 focus:outline-none">
                        <svg id="show" class="hidden mr-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 256 256">
                            <path fill="currentColor"
                                d="M247.31 124.76c-.35-.79-8.82-19.58-27.65-38.41C194.57 61.26 162.88 48 128 48S61.43 61.26 36.34 86.35C17.51 105.18 9 124 8.69 124.76a8 8 0 0 0 0 6.5c.35.79 8.82 19.57 27.65 38.4C61.43 194.74 93.12 208 128 208s66.57-13.26 91.66-38.34c18.83-18.83 27.3-37.61 27.65-38.4a8 8 0 0 0 0-6.5M128 192c-30.78 0-57.67-11.19-79.93-33.25A133.5 133.5 0 0 1 25 128a133.3 133.3 0 0 1 23.07-30.75C70.33 75.19 97.22 64 128 64s57.67 11.19 79.93 33.25A133.5 133.5 0 0 1 231.05 128c-7.21 13.46-38.62 64-103.05 64m0-112a48 48 0 1 0 48 48a48.05 48.05 0 0 0-48-48m0 80a32 32 0 1 1 32-32a32 32 0 0 1-32 32" />
                        </svg>
                        <svg id="hide" class="mr-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24">
                            <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="1.5">
                                <path stroke-linejoin="round"
                                    d="M10.73 5.073A10.96 10.96 0 0 1 12 5c4.664 0 8.4 2.903 10 7a11.595 11.595 0 0 1-1.555 2.788M6.52 6.519C4.48 7.764 2.9 9.693 2 12c1.6 4.097 5.336 7 10 7a10.44 10.44 0 0 0 5.48-1.52m-7.6-7.6a3 3 0 1 0 4.243 4.243" />
                                <path d="m4 4l16 16" />
                            </g>
                        </svg>
                    </button>
                </div>
            </div>
            <button type="submit"
                class="text-sm block max-w-xs mx-auto px-20 bg-[#FFF3B2] shadow-md hover:bg-yellow-500 font-semibold py-4 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-400">
                Sign in
            </button>
        </form>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function togglePasswordVisibility() {
        const passwordField = document.getElementById('password');
        const showIcon = document.getElementById('show');
        const hideIcon = document.getElementById('hide');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            showIcon.classList.remove('hidden');
            hideIcon.classList.add('hidden');
        } else {
            passwordField.type = 'password';
            showIcon.classList.add('hidden');
            hideIcon.classList.remove('hidden');
        }
    }

    $(document).ready(function() {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Login Berhasil',
                text: '{{ session('success') }}'
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                text: '{{ session('error') }}'
            });
        @endif
    });
</script>
@endsection