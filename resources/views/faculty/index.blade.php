@extends('layouts.app') 

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Fakulteti</div>

                <a href="/faculty/create">Dodaj Novi Fakultet</a>
				
                <h1>Svi Fakulteti:</h1>            
                @foreach ($faculties as $faculty)
				<p>{{$faculty->id}} - {{$faculty->name}} 
                
                
                <a href="/faculty/{{$faculty->id}}/edit">edit</a>
                <form action="{{ route('faculty.destroy', $faculty->id) }}" method="POST" onSubmit="return confirm('Jeste li sigurni da zelite obrisati fakultet {{$faculty->name}}')">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button>Delete</button>
                </form>       

                 </p>
				@endforeach
			</div>
		</div>
	</div>
</div>
</div>

<script type="text/javascript">
	function deleteFaculty(id) {
    r = confirm('Jeste li sigurni da zelite obrisati fakultet pod brojem'+id)
    if(r !== true) return false

  $.ajax({
    url: '/faculty/'+id,
    type: 'DELETE',
    data: id="csrf-token" value="{{ Session::token() }}"
    success: function(result) {
        window.location.replace('/faculties')
    }
});
    return true;
}

</script>
@endsection