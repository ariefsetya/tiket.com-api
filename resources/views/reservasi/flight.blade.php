@extends('app_flight')


@section('content')
<div class="">
<h1>Search Flight</h1>
	<div class="row">
      <div class="col s12">
      	<div class="row">
      		<div class="input-field col s6">
      		<select name="from" class="browser-default" id="from">
      			@foreach($airport as $key)
      				<option value="{{$key->airport_code}}" {{$key->airport_code=="CGK"?"selected":""}}>
      					{{$key->airport_name}} ({{$key->airport_code}})
      				</option>
      			@endforeach
      		</select></div>
      		<div class="input-field col s6">
      		<select name="to" class="browser-default" id="to">
      			@foreach($airport as $key)
      				<option value="{{$key->airport_code}}" {{$key->airport_code=="DPS"?"selected":""}}>
      					{{$key->airport_name}} ({{$key->airport_code}})
      				</option>
      			@endforeach
      		</select></div>
      	</div>
      	<div class="row">
      		<div class="input-field col s2">
      			<select name="type" onchange="check_type()" id="type" class="browser-default">
      				<option value="OW">Oneway</option>
      				<option value="RT">Roundtrip</option>
      			</select>
      		</div>
      		<div class="input-field input-field col s2">
                        <input type="text" class="for_date" id="depart_date" name="depart_date">
                        <label for="">Depart Date</label>
                  </div>
                  <div class="input-field col s2">
                        <input type="text" class="for_date" id="return_date" name="return_date">
                        <label for="">Return Date</label>
      		</div>
      		<div class="input-field col s1">
      			<select name="adult" id="adult" class="browser-default">
      				@for($i=1;$i<6;$i++)
      				<option value="{{$i}}">{{$i}} Adult</option>
      				@endfor
      			</select>
      		</div>
      		<div class="input-field col s1">
      			<select name="child" id="child" class="browser-default">
      				@for($i=0;$i<6;$i++)
      				<option value="{{$i}}">{{$i}} Child</option>
      				@endfor
      			</select>
      		</div>
      		<div class="input-field col s1">
      			<select name="infant" id="infant" class="browser-default">
      				@for($i=0;$i<6;$i++)
      				<option value="{{$i}}">{{$i}} Infant</option>
      				@endfor
      			</select>
      		</div>
      		<div class="input-field col s3">
      			<span class="btn" id="search_button" onclick="search()">Search</span>
      		</div>
      	</div>
      </div>
    </div>
</div>

<div id="result">
</div>
@endsection

@section('footer')
<script type="text/javascript">
	$(".for_date").datepicker();
	
	function check_type() {
		var tipe = $("#type").val();
		if(tipe=="OW"){
			$("#return_date").prop('disabled',true);
		}else{
			$("#return_date").prop('disabled',false);
		}
	}
	check_type();

      function search() {
            $("#search_button").html('Please Wait...');

            $.ajax({
                  url:'{{route("ajax_search_flight")}}',
                  type:'POST',
                  data:{
                        from:$("#from").val(),
                        to:$("#to").val(),
                        type:$("#type").val(),
                        depart_date:$("#depart_date").val(),
                        return_date:$("#return_date").val(),
                        adult:$("#adult").val(),
                        child:$("#child").val(),
                        infant:$("#infant").val(),
                        _token:'{{csrf_token()}}'
                  },
                  dataType:'json',//hasil berupa json
                  success:function(data) {
                        if(data.departures!=null){
                        //ambil data departures
                        var hasil_depart = data.departures;

                        var res_depart = hasil_depart.result;

                        var html = '<ul class="collapsible popout" data-collapsible="accordion">';

                        //looping hasil departures
                        for(data in res_depart){
                              //tampilkan dalam bentuk collapsible
                              html += '<li>';
                              html += '<div class="collapsible-header">';
                              html += '<img src="'+res_depart[data].image+'">'
                              html += res_depart[data].airlines_name+ ' ('+res_depart[data].full_via+') with '+res_depart[data].flight_number;
                              html += '<div class="right">'+res_depart[data].markup_price_string+'</div>';
                              html += '</div>';
                              html += '<div class="collapsible-body" style="padding:10px;">';

                              //ambil array object flight info
                              var flights = res_depart[data].flight_infos;
                              var flight_infos = flights.flight_info;

                              //looping isi array flight info
                              for(info in flight_infos){
                                    //masukkan ke dalam body collapsible
                                    html += '<h5>'+flight_infos[info].flight_number+'</h5>';
                                    html += '<div class="right">';
                                    html += flight_infos[info].arrival_city+' at '
                                          +flight_infos[info].simple_arrival_time;
                                    html += '</div>';
                                    html += '<div class="left">';
                                    html += flight_infos[info].departure_city+' at '
                                          +flight_infos[info].simple_departure_time;
                                    html += '</div>';

                                    html += '<br>';
                                    html += '<hr>';
                              }

                              html += '</div>';
                              html += '</li>';
                        }

                        html += '</ul>';

                        $("#result").html(html);
                        $('.collapsible').collapsible();


                        //$("#result").html(data);
                  }else{
                        $("#result").html('<h1>No Flight Data Found</h1>');
                  }
                        $("#search_button").html('Search');
                  }
            })
      }
</script>
@endsection
