@extends('../layout/register')

@section('head')
<title>Register - SKO</title>
@endsection

@section('content')
<div class="flex flex-col md:flex-row min-h-screen">
    <!-- Left Section -->
    <div class="flex-1 bg-cover bg-center relative" style="background-image: url('dist/img/registeruser.png');">
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
                    <input type="username" id="username"
                        class="mt-1 block w-full px-3 py-6 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Username" required>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-black">Email</label>
                    <input type="email" id="email"
                        class="mt-1 block w-full px-3 py-6 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Email" required>
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-black">Password</label>
                    <input type="password" id="password"
                        class="mt-1 block w-full px-3 py-6 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Password" required>
                </div>
            </form>
            <div class="flex justify-center py-4">
                <button type="button" id="btn-signup" form="signup-form"
                    class="flex justify-center w-3/4 py-5 px-4 border border-transparent rounded-md shadow-sm text-sm font-bold text-gray-700 bg-[#FFF3B5] hover:bg-gray-700 hover:text-[#FFF3B5] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Sign
                    Up</button>
            </div>
            <div class="text-center">
                <p class="text-sm text-black">Already have an account? <a href="/login"
                        class="font-medium text-indigo-600 hover:text-indigo-500">Login</a></p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    (function() {
        async function signup() {

            // Post form
            let email = $('#email').val()
            let password = $('#password').val()
            let username = $('#username').val()

            // Loading state
            $('#btn-signup').html('<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"> <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"> </path></svg>')
            await helper.delay(1500)

            axios.post(`register`, {
                email: email,
                password: password,
                name: username
            }).then(res => {
                location.href = 'login'
            }).catch(err => {
                if(err.response.data.errors.email == 'The email has already been taken.'){
                $('#btn-signup').html('Sign Up')
                const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
                }
                });
                Toast.fire({
                icon: "error",
                title: "Email Sudah Digunakan!"
                });}else{
                    $('#btn-signup').html('Sign Up')
                    const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                    }
                    });
                    Toast.fire({
                    icon: "error",
                    title: "Isi Semua Data!"
                    });
                }

                // $('#btn-signup').html('register')
                // if (err.response.data.message != 'Wrong email or password.') {
                //     for (const [key, val] of Object.entries(err.response.data.errors)) {
                //         $(`#${key}`).addClass('border-danger')
                //         $(`#error-${key}`).html(val)
                //     }
                // } else {
                //     $(`#password`).addClass('border-danger')
                //     $(`#error-password`).html(err.response.data.message)
                // }
            })
        }

        $('#signup-form').on('keyup', function(e) {
            if (e.keyCode === 13) {
                signup()
            }
        })

        $('#btn-signup').on('click', function() {
            signup()
        })
    })()
</script>
@endsection