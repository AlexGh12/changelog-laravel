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

	@php
		if (session()->exists('error_changelog')) {
		    dd(session('error_changelog'));
		}
	@endphp

	<form action="{{ route('version.store') }}" class="card card-body" method="post">
		@csrf
		<div class="mb-4">
			<label for="version">Versión</label>
			@isset($error['version'])
				<input class="form-control is-invalid" id="version" name="version" placeholder="v.{{ rand(1, 100) }}"
					type="text" value="{{ old('version') }}">
				<div class="invalid-feedback">
					{{ $error['version'][0] }}
				</div>
			@else
				<input class="form-control" id="version" name="version" placeholder="v.{{ rand(1, 100) }}" type="text"
					value="{{ old('version') }}">
			@endisset
		</div>

		<div class="mb-4">
			<label for="title">Titulo</label>
			@isset($error['title'])
				<input class="form-control is-invalid" id="title" name="title" placeholder="Versión test"
					type="text" value="{{ old('title') }}">
				<div class="invalid-feedback">
					{{ $error['title'][0] }}
				</div>
			@else
				<input class="form-control" id="title" name="title" placeholder="Versión test" type="text"
					value="{{ old('title') }}">
			@endisset
		</div>

		<div class="mb-4">
			<label for="description">Descripción</label>
			@isset($error['description'])
				<input class="form-control is-invalid" id="description" name="description"
					placeholder="Descripción del cambio" type="text" value="{{ old('description') }}">
				<div class="invalid-feedback">
					{{ $error['description'][0] }}
				</div>
			@else
				<input class="form-control" id="description" name="description" placeholder="Descripción del cambio"
					type="text" value="{{ old('description') }}">
			@endisset
		</div>

		<div class="mb-4">
			<label for="content">Contenido</label>
			<div data-placeholder="Escribe algo aquí..." id="editor"></div>
			<textarea id="editor_content" name="editor_content" style="display:none;"
			 value="{{ old('editor_content') }}"></textarea>
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
			document.querySelector('#editor_content').value = quill.root.innerHTML;
		});
	</script>
@endsection
