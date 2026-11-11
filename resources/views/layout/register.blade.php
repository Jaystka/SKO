@extends('layout.base')

@section('body')

<body class="register">
    @yield('content')

    @include('partials.flash')
    @yield('script')
</body>
@endsection
