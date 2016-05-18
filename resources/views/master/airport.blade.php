@extends('app')

@section('content')
<h4>Airport</h4>
<table>
	<thead>
		<tr>
			<th>Airport Name</th>
			<th>Location</th>
			<th>Country</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $key)
			<tr>
				<td>{{$key->airport_name." (".$key->airport_code.")"}}</td>
				<td>{{$key->location_name}}</td>
				<td>{{\App\Country::where('country_id',$key->country_id)->first()['country_name']}}</td>
			</tr>
		@endforeach
	</tbody>
</table>
@endsection