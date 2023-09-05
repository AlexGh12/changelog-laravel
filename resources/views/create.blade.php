@extends('ChangeLog::layout')

@section('title', 'Crear Changelog')

@section('css')
	<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endsection

@section('breadcrumb_links')
	<li aria-current="page" class="breadcrumb-item active">
		Crear changelog
	</li>
@endsection

@section('breadcrumb_btns')
	<a class="btn btn-sm btn-secondary" href="{{ route('version.index') }}">
		<i class="bi bi-arrow-left"></i>
		Regresar
	</a>
@endsection

@section('content')
	<form action="{{ route('version.store') }}" class="card card-body" method="post">
		@csrf
		<div class="mb-4">
			<label for="version">Versión</label>
			<input class="form-control @error('version') is-invalid @enderror" id="version" name="version"
				placeholder="v.{{ rand(1, 100) }}" type="text" value="{{ old('version') }}">
			@error('version')
				<div class="invalid-feedback">{{ $message }}</div>
			@enderror
		</div>

		<div class="mb-4">
			<label for="title">Titulo</label>
			<input class="form-control @error('title') is-invalid @enderror" id="title" name="title"
				placeholder="Versión test" type="text" value="{{ old('title') }}">
			@error('title')
				<div class="invalid-feedback">{{ $message }}</div>
			@enderror
		</div>

		<div class="mb-4">
			<label for="description">Descripción</label>
			<input class="form-control @error('description') is-invalid @enderror" id="description" name="description"
				placeholder="Descripción del cambio" type="text" value="{{ old('description') }}">
			@error('description')
				<div class="invalid-feedback">{{ $message }}</div>
			@enderror
		</div>

		<div class="mb-4">
			<div id="editor">
				<p>Aqui los detalles del cambiio</p>
			</div>
			<textarea id="editor_content" name="editor_content" style="display:none;"></textarea>
		</div>

		<div class="d-flex justify-content-around">
			<a class="btn btn-sm btn-secondary" href="{{ route('version.index') }}">
				<i class="bi bi-arrow-left"></i>
				Regresar
			</a>

			<button class="btn btn-sm btn-success" type="submit">
				Crear changelog
			</button>
		</div>
	</form>

@endsection

@section('javascript')
	<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

	<!-- Initialize Quill editor -->
	<script>
		var toolbarOptions = [
			['bold', 'italic', 'underline', 'strike'], // toggled buttons
			['blockquote', 'code-block'],

			[{
				'header': 1
			}, {
				'header': 2
			}], // custom button values
			[{
				'list': 'ordered'
			}, {
				'list': 'bullet'
			}],
			[{
				'script': 'sub'
			}, {
				'script': 'super'
			}], // superscript/subscript
			[{
				'indent': '-1'
			}, {
				'indent': '+1'
			}], // outdent/indent
			[{
				'direction': 'rtl'
			}], // text direction

			[{
				'size': ['small', false, 'large', 'huge']
			}], // custom dropdown
			[{
				'header': [1, 2, 3, 4, 5, 6, false]
			}],
			['link', 'image', 'video', 'formula'], // add's image support
			[{
				'color': []
			}, {
				'background': []
			}], // dropdown with defaults from theme
			[{
				'font': []
			}],
			[{
				'align': []
			}],

			['clean'] // remove formatting button
		];

		var quill = new Quill('#editor', {
			modules: {
				toolbar: toolbarOptions
			},

			theme: 'snow'
		});

		document.querySelector('form').addEventListener('submit', function() {
			var content = quill.root.innerHTML;
			document.getElementById('editor_content').value = content;
		});
	</script>
@endsection
