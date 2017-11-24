@extends('layouts.app') @section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Dashboard</div>
                <a href="/faculty">svi fakulteti</a>
				<form action="@if(isset($faculty))/faculty/{{$faculty->id}} @else/faculty @endif" method='post'>
					@foreach ($errors->all() as $error)
					<div class="alert alert-danger">
						{{$error}}
					</div>
					@endforeach
                    @if (Route::currentRouteName() == 'faculty.edit')
                    <input type="hidden" name="_method" value="PUT">
                    @endif

					<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
					<label>Unesi ime Fakultet</label>
					<input type="text" name="name" placeholder="ime fakulteta" @if(isset($faculty))value="{{$faculty->name}}"@endif>
					<input type="submit" name="submit" class="btn btn-primary">
					<form>
			</div>
		</div>
	</div>
</div>
</div>
@endsection