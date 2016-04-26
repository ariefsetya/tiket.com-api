@extends('app')

@section('content')

					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
	<div id="login-page" class="row">
    <div class="col s12 m6 offset-m3 z-depth-2 card-panel">
      <form class="login-form" method="POST" action="{{url('')}}">
        <div class="row">
          <div class="input-field col s12 center">
          <h3>Login</h3>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <input id="username" type="text">
            <label for="username" class="center-align">Username</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <input id="password" type="password">
            <label for="password">Password</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <button type="submit" class="btn waves-effect waves-light col s12">Login</button>
          </div>
          <div class="input-field col s12">
            <a class="btn waves-effect waves-light col s12" href="{{url('auth/register')}}">Register Now!</a>
          </div>
        </div>
      </form>
    </div>
  </div>
				
@endsection
