@extends('layouts.app')


@section('content')

<div class="container">
	<div class="row">
		<form action="{{ route('avatar.store') }}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
				</div>
				<div class="custom-file">
					<input type="file" name="avatar" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
					<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
				</div>
				<input type="submit" value="Upload" class="btn btn-success" ml-4>
			</div>
		</form>
	</div>
</div>

@endsection()


