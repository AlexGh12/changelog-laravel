@extends('ChangeLog::layout')

@section('title', 'Index')

@section('breadcrumb_btns')
	<a class="btn btn-sm btn-success" href="{{ route('version.create') }}">
		<i class="bi bi-plus"></i>
		Agregar changelog
	</a>
@endsection

@section('content')
	<div class="accordion" id="changelog">
		@foreach ($data as $log)
			<div class="accordion-item @if ($loop->first) mt-3 border-top @endif border-black">
				<div aria-controls="item_{{ $log->id }}"
					aria-expanded="@if ($loop->first) true @else false @endif"
					class="accordion-header accordion-button @if (!$loop->first) collapsed @endif"
					data-bs-target="#item_{{ $log->id }}" data-bs-toggle="collapse" type="button">
					<div class="position-absolute end-0 top-0 p-2">
						<a class="btn btn-sm btn-info" href="{{ route('version.edit', $log->id) }}">
							<i class="bi bi-pencil-fill"></i>
						</a>

						<button class="btn btn-sm btn-danger"
							onclick="deleteButton('delete-form-{{ $log->id }}', 'Changelog {{ $log->id }}')">
							<i class="bi bi-trash-fill"></i>
						</button>

						<form action="{{ route('version.destroy', $log->id) }}" id="delete-form-{{ $log->id }}"
							method="POST" style="display: none;">
							@csrf
							@method('DELETE')
						</form>

					</div>
					<div class="w-100">
						<p class="h5">
							{{ $log->version }}
						</p>

						<p class="h6 text-muted mt-3">
							{{ $log->title }}
						</p>

						<p>
							{{ $log->created_at->format('Y-m-d') }}
						</p>

						<p>
							{{ Str::limit($log->description, 120, '...') }}
						</p>
					</div>
				</div>
				<div class="accordion-collapse @if ($loop->first) show @endif collapse"
					data-bs-parent="#changelog" id="item_{{ $log->id }}">
					<div class="accordion-body">
						{!! $log->content !!}
					</div>
				</div>
			</div>
		@endforeach
	</div>

@endsection

@section('javascript')
	<script>
		const deleteButton = function(formId, name) {
			Swal.fire({
				title: 'Eliminar',
				text: '¿Seguro que quieres eliminar "' + name + '"?',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Si eliminar',
			}).then((result) => {
				if (result.isConfirmed) {
					document.getElementById(formId).submit();
				}
			})
		}
	</script>
@endsection
