<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/output.css">
    <title>Halaman Login</title>
</head>

<body class="">
    <div class="flex py-10 md:py-20 px-5 md:px-32 bg-gray-200 min-h-screen">
        <div class="flex shadow w-full flex-col-reverse lg:flex-row">
            <div class="w-full lg:w-1/2 bg-white flex justify-center items-center">
                <img src="assets/sejahteratani.avif.png" alt="Login Image" class="w-full">
            </div>
            <div class="w-full lg:w-1/2 bg-white p-10 px-5 md:px-20">
                <h1 class="font-bold text-xl text-gray-700">Login Page</h1>
                <p class="text-gray-600">Silahkan login untuk memulai sesi Anda!</p>

                <br>
                @if (Session::has('errors'))
                <ul>
                    @foreach (Session::get('errors') as $error)
                    <li style="color: red">{{ $error[0]}}</li>
                    @endforeach
                </ul>
                @endif

                @if (Session::has('success'))
                <p style="color: green">{{Session::get('success')}}</p>
                @endif

                @if (Session::has('failed'))
                <p style="color: red">{{Session::get('failed')}}</p>
                @endif

                <form action="/login_member" method="POST" class="mt-10">
                    @csrf
                    <div class="my-3">
                        <label class="font-semibold" for="email">E-mail</label>
                        <input type="text" placeholder="yourmail@example.com" name="email" id="email"
                            class="block border-2 rounded-full mt-2 py-2 px-5 w-full" required>
                    </div>
                    <div class="my-3">
                        <label class="font-semibold" for="password">Password</label>
                        <input type="password" placeholder="password" name="password" id="password"
                            class="block border-2 rounded-full mt-2 py-2 px-5 w-full" required>
                    </div>
                    <div class="flex justify-between">
                        <div class="left">
                            <input type="checkbox" name="remember_me" id="remember_me">
                            <label for="remember_me">Ingatkan saya</label>
                        </div>
                        <div class="right">
                            <a class="text-blue-400 hover:text-blue-600" href="">Lupa Password?</a>
                        </div>
                    </div>
                    <div class="my-5">
                        <button type="submit"
                            class="w-full rounded-full bg-blue-400 hover:bg-blue-600 text-white py-2">LOGIN</button>
                    </div>
                </form>
                <span>Anda adalah admin? <a href="/login" class="text-blue-400 hover:text-blue-600">Klik Disini.</a></span>
            </div>
        </div>
    </div>
</body>

</html>
