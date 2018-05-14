@extends('layouts.app')

@section('title', 'Account Information')

@section('content')
<div id="panel">
	<section class="main title">
		<div class="container-fluid">
			<div class="row justify-content-center">
				<div class="col-12 col-md-12 col-lg-12">
					<h1 class="d-block text-center pt-3 pb-1 mt-3">Account Information</h1>
				</div>
			</div>		
		</div>
	</section>

	<section class="acc-information my-3 my-lg-5">
		<div class="container">
			<div class="row justify-content-center text-center pb-0 pb-lg-5">
				<div class="col-12 col-md-12 col-lg-8">
					@if ($errors->first())
						<hr/>
						<div class="alert alert-danger">{{ $errors->first() }}</div>
	                @endif
					<form class="acc-form" method="POST" action="{{ route('login') }}">
						{{ csrf_field() }}
						<div class="form-group py-2">
							<div class="input-group">
								<input type="text" class="form-control" value="Member ID: {{ $customer['member_id'] }}" readonly />
							</div>
						</div>
						<div class="form-group py-2">
							<div class="input-group">
								<input type="text" class="form-control" value="First Name: {{ $customer['first_name'] }}" readonly />
							</div>
						</div>
						<div class="form-group py-2">
							<div class="input-group">
								<input type="text" class="form-control" value="Last Name: {{ $customer['last_name'] }}" readonly />
							</div>
						</div>
						<div class="form-group py-2">
							<div class="input-group">
								<input type="text" class="form-control" value="Email: {{ $customer['email'] }}" readonly />
							</div>
						</div>
						<div class="form-group py-2">
							<div class="input-group">
								<input type="text" class="form-control" value="Username: {{ $customer['username'] }}" readonly />
								<input type="hidden" name="username" value="{{ $customer['username'] }}" />
							</div>
						</div>
						<div class="form-group py-2">
							<div class="input-group">
								<input type="text" class="form-control" value="Password: {{ $customer['password'] }}" readonly />
								<input type="hidden" name="password" value="{{ $customer['password'] }}" />
							</div>
						</div>
						<div class="form-group py-2">
								<a href="{{ $customer['site_url'] }}" target="_blank" class="form-control text-left site_url">Site URL: {{ $customer['site_url'] }}</a>
							</div>
						<div class="form-group mt-5 mb-4 action-btn-container">
							<input class="d-block red-btn py-3" type="submit" value="Cancel Subscription" />
							{!! app('captcha')->render(); !!}
						</div>
						<div class="form-group mb-5 action-btn-container">
							<a href="{{ url()->previous() }}" class="d-block inverse-btn py-3">Back</a>
						</div>
						<div class="form-group my-1 my-lg-3">							
							<div class="row justify-content-center loader disp-none">
								<div class="col-2">
									<div class="mul8">
										<div class="mul8circ1"></div>
										<div class="mul8circ2"></div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection