@extends('ChangeLog::layout')

@section('title', 'Crear Changelog')

@section('css')
	<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endsection

@section('breadcrumb_links')
	<li class="breadcrumb-item active" aria-current="page">
		Crear changelog
	</li>
@endsection

@section('breadcrumb_btns')
	<a href="{{ route('changelog.index') }}" class="btn btn-sm btn-secondary">
		<i class="bi bi-arrow-left"></i>
		Regresar
	</a>
@endsection

@section('content')
	<form action="{{ route('changelog.store') }}" method="post" class="card card-body">
		@csrf
		<div class="mb-4">
			<label for="version">
				Versión
			</label>

			<input type="text" class="form-control" name="version" id="version" placeholder="v.{{ rand(1, 100) }}">
		</div>
		<div class="mb-4">
			<label for="title">
				Titulo
			</label>

			<input type="text" class="form-control" name="title" id="title" placeholder="Versión test">
		</div>
		<div class="mb-4">
			<label for="description">
				Descripción
			</label>

			<input type="text" class="form-control" name="description" id="description" placeholder="Descripción del cambio">
		</div>
		<div class="mb-4">
			<div id="editor">
				<p>Aqui los detalles del cambiio</p>
			</div>
		</div>
		<div class="d-flex justify-content-around">
			<a href="{{ route('changelog.index') }}" class="btn btn-sm btn-secondary">
				<i class="bi bi-arrow-left"></i>
				Regresar
			</a>

			<button type="submit" class="btn btn-sm btn-success">
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
			['bold', 'italic', 'underline', 'strike'],        // toggled buttons
			['blockquote', 'code-block'],

			[{ 'header': 1 }, { 'header': 2 }],               // custom button values
			[{ 'list': 'ordered'}, { 'list': 'bullet' }],
			[{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
			[{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
			[{ 'direction': 'rtl' }],                         // text direction

			[{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
			[{ 'header': [1, 2, 3, 4, 5, 6, false] }],
			[ 'link', 'image', 'video', 'formula' ],          // add's image support
			[{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
			[{ 'font': [] }],
			[{ 'align': [] }],

			['clean']                                         // remove formatting button
		];

		var quill = new Quill('#editor', {
			modules: {
				toolbar: toolbarOptions
			},

			theme: 'snow'
		});
	</script>
@endsection
