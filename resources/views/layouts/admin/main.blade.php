<!DOCTYPE html>
<html lang="en">
<head>
    @include('faturhelper::layouts/admin/_head')
    @yield('css')

    <title>@yield('title') :: FPM | Fatur Package Manager</title>
</head>
<body>
	<div class="wrapper">
        @include('faturhelper::layouts/admin/_sidebar')
        
		<div class="main">
            @include('faturhelper::layouts/admin/_header')

			<main class="content">
				<div class="container-fluid p-0">
                    @yield('content')
				</div>
			</main>

            @include('faturhelper::layouts/admin/_footer')

		</div>
	</div>

    @include('faturhelper::layouts/admin/_js')
    @yield('js')

</body>
</html>