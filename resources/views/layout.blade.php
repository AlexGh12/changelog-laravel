<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<title>
		{{ env('APP_NAME') }} | @yield('title')
	</title>
	<link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
		integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<style>
		@import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css");
	</style>

	@yield('css')
</head>

<body>

	<div class="container my-5">

		<div class="mb-3">
			<nav aria-label="breadcrumb" class="d-flex justify-content-between align-items-center">
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="{{ route('version.index') }}">
							{{ env('APP_NAME') }}
						</a>
					</li>
					@yield('breadcrumb_links')
				</ol>

				@yield('breadcrumb_btns')
			</nav>
		</div>

		@yield('content')
	</div>

	<script>
		@if (session('alert'))
			let alert = @json(session('alert'));

			Swal.fire({
				title: alert.status.charAt(0).toUpperCase() + alert.status.slice(
					1),
				text: alert.mensaje,
				icon: alert.status,
				confirmButtonText: 'Ok'
			});
		@endif
	</script>

	@yield('javascript')

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
		crossorigin="anonymous"></script>
</body>

</html>
