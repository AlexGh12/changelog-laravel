@extends('ChangeLog::layout')

@section('title', 'Index')

@section('breadcrumb_btns')
	<a href="{{ route('changelog.create') }}" class="btn btn-sm btn-success">
		<i class="bi bi-plus"></i>
		Agregar changelog
	</a>
@endsection

@section('content')
	<div class="accordion" id="changelog">
		@for ($i = 1; $i <= 5; $i++)
			<div class="accordion-item border-black @if ($i != 1) mt-3 border-top @endif">
				<div class="accordion-header accordion-button @if ($i != 1) collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#item_{{ $i }}" aria-expanded="@if ($i == 1) true @else false @endif"  aria-controls="item_{{ $i }}">
					<div class="position-absolute top-0 end-0 p-2">
						<a href="{{ route('changelog.edit', $i) }}" class="btn btn-sm btn-info">
							<i class="bi bi-pencil-fill"></i>
						</a>

						<button class="btn btn-sm btn-danger" onclick="deleteButton('item_{{ $i }}', 'Changelog {{ $i }}')">
							<i class="bi bi-trash-fill"></i>
						</button>
					</div>
					<div class="w-100">
						<p class="h5">
							v.{{ rand(1, 100) }}.{{ rand(1, 100) }}.{{ rand(1, 100) }}
						</p>

						<p class="h6 mt-3 text-muted">
							Changelog {{ $i }}
						</p>

						<p>
							{{ date('Y-m-d') }}
						</p>

						<p>
							{{ Str::limit($string, 120, '...') }}
						</p>
					</div>
				</div>
				<div id="item_{{ $i }}" class="accordion-collapse collapse @if ($i == 1) show @endif" data-bs-parent="#changelog">
					<div class="accordion-body">
						<strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
					</div>
				</div>
			</div>
		@endfor
	</div>
@endsection

@section('javascript')
	<script>

		const deleteButton = function (id, name) {
			Swal.fire({
				title: 'Eliminar',
				text: '¿Seguro que quieres eliminar "'+name+'"?',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Si eliminar',
			}).then((result) => {
				if (result.isConfirmed) {
					Swal.fire(
						'Eliminado',
						'El registro ha sido eliminado.',
						'success'
					)
				}
			})
		}
	</script>
@endsection
