@extends('layout.register')

@section('head')
<title>Register - SKO</title>
@endsection

@section('content')
<div class="flex flex-col md:flex-row min-h-screen">
    <!-- Left Section -->
    <div class="flex-1 bg-cover bg-center relative" style="background-image: url('{{ asset('dist/img/registeruser.jpg') }}');">
        <div class="absolute inset-0 bg-[#FFF3B2] opacity-25"></div>
        <div class="relative z-10 flex items-center justify-center h-full p-8">
            <div class="text-center text-white">
                <h1 class="text-4xl font-bold bodycopy">Berkarya dengan gaya</h1>
                <h2 class="logosko text-7xl font-bold mt-2">SKO<span class="bodycopy text-4xl mt-10 font-bold">
                        selalu tersedia</span></h2>
            </div>
        </div>
    </div>
    <!-- Right Section -->
    <div class="flex-1 flex items-center justify-center p-8 bg-white">
        <div class="w-full max-w-md">
            <h2 class="text-2xl font-bold text-center ">Welcome to SKO!</h2>
            <h3 class="text-md font-normal text-center mb-8">Create an Account</h3>
            <form class="space-y-4" id="signup-form">
                <div>
                    <label for="username" class="block text-sm font-medium text-black">Username</label>
                    <input type="text" id="username" name="name" autocomplete="username" maxlength="255"
                        class="mt-1 block w-full px-3 py-6 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Username" required>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-black">Email</label>
                    <input type="email" id="email" name="email" autocomplete="email"
                        class="mt-1 block w-full px-3 py-6 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Email" required>
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-black">Password</label>
                    <input type="password" id="password" name="password" autocomplete="new-password" minlength="8"
                        class="mt-1 block w-full px-3 py-6 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Password (minimal 8 karakter)" required>
                </div>
            </form>
            <div class="flex justify-center py-4">
                <button type="button" id="btn-signup" form="signup-form"
                    class="flex justify-center w-3/4 py-5 px-4 border border-transparent rounded-md shadow-sm text-sm font-bold text-gray-700 bg-[#FFF3B5] hover:bg-gray-700 hover:text-[#FFF3B5] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Sign
                    Up</button>
            </div>
            <div class="text-center">
                <p class="text-sm text-black">Already have an account? <a href="{{ route('login') }}"
                        class="font-medium text-indigo-600 hover:text-indigo-500">Login</a></p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    (function () {
        const $btn = $('#btn-signup');
        let busy = false;

        function signup() {
            if (busy) return;
            busy = true;
            $('#signup-form input').removeClass('sko-input-error');
            $btn.prop('disabled', true).addClass('is-loading').text('Memproses...');

            axios.post(@json(route('register')), {
                name: $('#username').val(),
                email: $('#email').val(),
                password: $('#password').val(),
            }).then((res) => {
                Swal.fire({ icon: 'success', title: 'Registrasi berhasil!', text: 'Silakan login dengan akun Anda.', timer: 1500, showConfirmButton: false })
                    .then(() => { location.href = res.data.url || @json(route('login')); });
            }).catch((err) => {
                const res = err.response || {};
                const data = res.data || {};
                if (data.errors) {
                    const map = { name: '#username', email: '#email', password: '#password' };
                    Object.keys(data.errors).forEach((key) => $(map[key] || `#${key}`).addClass('sko-input-error'));
                }
                SKO.toast('error', SKO.errorMessage({ status: res.status, responseJSON: data }));
            }).finally(() => {
                busy = false;
                $btn.prop('disabled', false).removeClass('is-loading').text('Sign Up');
            });
        }

        $('#signup-form').on('submit', (e) => { e.preventDefault(); signup(); });
        $('#signup-form').on('keyup', (e) => { if (e.key === 'Enter') signup(); });
        $btn.on('click', signup);
    })();
</script>
@endsection
