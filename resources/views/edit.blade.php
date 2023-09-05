@extends('ChangeLog::layout')

@section('title', 'Editar Changelog')

@section('css')
	<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endsection

@section('breadcrumb_links')
	<li aria-current="page" class="breadcrumb-item active">
		Editar changelog
	</li>
@endsection

@section('breadcrumb_btns')
	<a class="btn btn-sm btn-secondary" href="{{ route('version.index') }}">
		<i class="bi bi-arrow-left"></i>
		Regresar
	</a>
@endsection

@section('content')
	<form action="{{ route('version.update', $data->id) }}" class="card card-body" method="post">
		@csrf
		@method('PUT')

		<div class="mb-4">
			<label for="version">Versión</label>
			<input class="form-control" id="version" name="version" placeholder="v.{{ rand(1, 100) }}" type="text"
				value="{{ old('version', $data->version) }}">
			@error('version')
				<div class="alert alert-danger">{{ $message }}</div>
			@enderror
		</div>

		<div class="mb-4">
			<label for="title">Titulo</label>
			<input class="form-control" id="title" name="title" placeholder="Versión test" type="text"
				value="{{ old('title', $data->title) }}">
			@error('title')
				<div class="alert alert-danger">{{ $message }}</div>
			@enderror
		</div>

		<div class="mb-4">
			<label for="description">Descripción</label>
			<input class="form-control" id="description" name="description" placeholder="Descripción del cambio"
				type="text" value="{{ old('description', $data->description) }}">
			@error('description')
				<div class="alert alert-danger">{{ $message }}</div>
			@enderror
		</div>

		<div class="mb-4">
			<div id="editor">
				<p>{{ old('editor_content', $data->editor_content) }}</p>
			</div>
			<textarea id="editor_content" name="editor_content" style="display:none;"></textarea>
		</div>

		<div class="d-flex justify-content-around">
			<a class="btn btn-sm btn-secondary" href="{{ route('version.index') }}">
				<i class="bi bi-arrow-left"></i>
				Regresar
			</a>

			<button class="btn btn-sm btn-success" type="submit">
				Guardar cambios
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
			document.querySelector('#editor_content').value = quill.root.innerHTML;
		});
	</script>
@endsection
