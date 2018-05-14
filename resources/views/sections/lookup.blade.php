@extends('layouts.app')

@section('title', 'Account Lookup')

@section('content')
<div id="panel">
	<section class="main title">
		<div class="container-fluid">
			<div class="row justify-content-center">
				<div class="col-12 col-md-12 col-lg-12">
					<h1 class="d-block text-center pt-3 pb-1 mt-3">Account Lookup</h1>
				</div>
			</div>		
		</div>
	</section>

	<section class="lookup-information">
		<div class="container">
			<div class="row justify-content-center text-center pb-3 pb-lg-5">
				<div class="col-12 col-md-10 col-lg-8">
					@if ($errors->first())
						<hr/>
						<div class="alert alert-danger">{{ $errors->first() }}</div>
	                @endif
					<form class="lookup-form" method="POST" action="{{ route('search') }}">
						{{ csrf_field() }}
						<div class="form-group my-3 my-lg-3">
							<span class="d-block text-center suggestion">Please insert your info in <span class="bold">TWO</span> or <span class="bold">MORE</span> fields</span>
						</div>
						<div class="form-group">
							<div class="input-group">
								<input type="email" class="form-control" id="validationTooltipEmail" name="email" placeholder="Email" aria-describedby="validationTooltipEmailPrepend" />
								<div class="input-group-prepend">
									<span class="input-group-text" id="validationTooltipEmailPrepend">									
										<img src="/img/icons/email-icon.png" alt="icon" />
									</span>
								</div>
								<div class="invalid-tooltip">
									Please provide a valid email address.
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<input type="text" class="form-control" id="validationTooltipMemberId" name="member_id" placeholder="Member ID" aria-describedby="validationTooltipMemberIdPrepend" />
								<div class="input-group-prepend">
									<span class="input-group-text" id="validationTooltipMemberIdPrepend">									
										<img src="/img/icons/mid-icon.png" alt="icon" />
									</span>
								</div>
								<div class="invalid-tooltip">
									Please provide numeric values for member id.
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<input type="text" class="form-control" id="validationTooltipUsername" name="username" placeholder="Username" aria-describedby="validationTooltipUsernamePrepend" />
								<div class="input-group-prepend">
									<span class="input-group-text" id="validationTooltipUsernamePrepend">									
										<img src="/img/icons/user-icon.png" alt="icon" />
									</span>
								</div>
								<div class="invalid-tooltip">
									Please do not use blank spaces for username.
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<input type="password" class="form-control" id="validationTooltipPassword" name="password" placeholder="Password" aria-describedby="validationTooltipPasswordPrepend" />
								<div class="input-group-prepend">
									<span class="input-group-text" id="validationTooltipPasswordPrepend">
										<img src="/img/icons/pswd-icon.png" alt="">
									</span>
								</div>
								<div class="invalid-tooltip">
									Please do not use blank spaces for password.
								</div>
							</div>
						</div>
						<div class="form-group my-4">
							<span class="d-block text-center suggestion">or use Credit Card Number</span>
						</div>
						<div class="form-group">
							<div class="input-group">
								<input type="text" class="form-control" id="cc_number" name="cc_number" placeholder="Credit Card" />
								<div class="input-group-prepend">
									<span class="input-group-text">
										<img src="/img/icons/cc-icon.png" alt="icon">
									</span>
								</div>
								<div class="invalid-tooltip">
									Please use 6 first digits and last 4 digits of your credit card.
								</div>
							</div>
						</div>
						<div class="form-group my-3 my-lg-5 action-btn-container">
							<input class="d-block red-btn py-3" type="submit" value="Submit" />
							{!! app('captcha')->render(); !!}
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