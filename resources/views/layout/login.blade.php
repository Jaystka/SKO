@extends('layout.base')

@section('body')

<body class="login">
    @yield('content')

    @include('partials.flash')
    @yield('script')
</body>
@endsection
