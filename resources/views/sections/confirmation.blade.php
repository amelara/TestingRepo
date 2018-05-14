@extends('layouts.app')

@section('title', 'Confirmation')

@section('content')
<div id="panel">
	<section class="main title">
		<div class="container-fluid">
			<div class="row justify-content-center">
				<div class="col-12 col-md-12 col-lg-12">
					<h1 class="d-block text-center py-3 pb-1 mt-3">Confirmation</h1>
				</div>
			</div>		
		</div>
	</section>

	<section class="confirmation">
		<div class="container">
			<div class="row justify-content-center text-center py-3 py-lg-5">
				<div class="shadow col-12 col-md-10 col-lg-8 mb-2 mb-lg-5">
					@if ($errors->first())
						<hr/>
						<div class="alert alert-danger">{{ $errors->first() }}</div>
	                @endif
					<form class="confirmation-form" action="POST" action="{{ route('process') }}">
						{{ csrf_field() }}				
						<div class="form-group">
							<div class="row justify-content-center py-5">
								<div class="col-12 col-sm-12 col-md-10 col-lg-8">
									<span class="d-block">Special offer just for you!</span>
									<span class="d-block">Keep your membership for just</span>
									<span class="d-block bold">$4.95 a month</span> 
									<span class="d-block">for as long as you like</span>
								</div>
								<div class="col-12 col-sm-12 col-md-10 col-lg-8 py-3">
									<input class="d-block py-3 red-btn" name="update_membership" type="submit" value="Sign me up!"/>
								</div>
								<div class="col-12 col-sm-12 col-md-10 col-lg-8 py-3">
									<input class="d-block py-3 inverse-btn" name="cancel_subscription" type="submit" value="No thanks"/>								
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