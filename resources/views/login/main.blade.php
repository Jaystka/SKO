@extends('../layout/login')

@section('head')
<title>Login - SKO</title>
@endsection

@section('content')
<div class="flex flex-col md:flex-row min-h-screen">
    <!-- Left Section -->
    <div class="flex-1 bg-cover bg-center relative" style="background-image: url('dist/img/loginuser.png');">
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
            <h3 class="text-md font-normal text-center mb-8">Login Account</h3>
            <form class="space-y-4" id="login-form">
                <div>
                    <label for="email" class="block text-sm font-medium text-black">Email</label>
                    <input type="email" id="email"
                        class="login__input form-control mt-1 block w-full px-3 py-6 border rounded-xl shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Enter your email">
                    <div id="error-email" class="login__input-error text-red-600 mt-2 text-sm"></div>
                </div>
                <div>
                    <label for="password"
                        class="login__input form-control block text-sm font-medium text-black">Password</label>
                    <div class="flex border rounded-xl mt-1 h-16 items-center shadow-sm">
                        <input type="password" id="password"
                            class="  w-full ml-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            placeholder="Enter your password">
                        <button type="button" onclick="showHide()">
                            <svg id="show" class="hidden mr-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 256 256">
                                <path fill="fill-current"
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
                    <div id="error-password" class="login__input-error text-red-600 mt-2 text-sm"></div>
                </div>
            </form>
            <div class="flex items-center justify-between py-4">
                <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Forgot
                    password?</a>
            </div>
            <div class="flex justify-center">
                <button id="btn-login" type="submit"
                    class="w-3/4 py-5 px-4 border flex justify-center border-transparent rounded-md shadow-sm text-sm font-bold text-gray-700 bg-[#FFF3B5] hover:bg-gray-700 hover:text-[#FFF3B5] ">
                    Login</button>
            </div>
            <div class="text-center">
                <p class="text-sm text-black">Are you new? <a href="/register"
                        class="font-medium text-indigo-600 hover:text-indigo-500">Create an account</a></p>
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
        async function login() {
            // Reset state
            $('#login-form').find('.login__input').removeClass('border-red-600')
            $('#login-form').find('.login__input-error').html('')

            // Post form
            let email = $('#email').val()
            let password = $('#password').val()

            // Loading state
            $('#btn-login').html('<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"> <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"> </path></svg>')
            await helper.delay(1500)

            axios.post(`login`, {
                email: email,
                password: password
            }).then(res => {
                Swal.fire({icon: "success",
                title: "Berhasil Login!",
                text: "Selamat Datang, Selamat Belanja!",
                showConfirmButton: false,
                timer: 1500,
                didOpen: () => {
                },
                willClose: () => {
                location.href = '/home'
                }
            });
            }).catch(err => {
                console
                $('#btn-login').html('Login')
                if (err.response.data.message != 'Email atau Password salah') {
                    for (const [key, val] of Object.entries(err.response.data.errors)) {
                        $(`#${key}`).addClass('border-red-600')
                        $(`#error-${key}`).html(val)
                    }
                } else {
                    $(`#password`).addClass('border-red-600')
                    $(`#error-password`).html(err.response.data.message)
                }
            })
        }

        $('#login-form').on('keyup', function(e) {
            if (e.keyCode === 13) {
                login()
            }
        })

        $('#btn-login').on('click', function() {
            login()
        })
    })()

    function showHide() {
        var inputan = document.getElementById("password");
        var show = document.getElementById("show");
        var hide = document.getElementById("hide");
        if (inputan.type === "password") {
        inputan.type = "text";
        show.classList.add('block');
        show.classList.remove('hidden');
        hide.classList.add('hidden');
        } else {
        inputan.type = "password";
        hide.classList.add('block');
        hide.classList.remove('hidden');
        show.classList.add('hidden');
        }
        }
</script>
@endsection