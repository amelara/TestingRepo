@extends('layouts.app')

@section('title', 'Customer Service')

@section('content')
<div id="panel">
	<section class="main home position-relative">
		<div class="container-fluid">
			<div class="row justify-content-center">
				<div class="col-6 col-md-6 col-lg-5 red-bk-msg">
					<span class="d-block text-center">
						How can we help?
					</span>
				</div>			
				<div class="col-10 col-md-8 col-lg-12 text-center white-msg">
					<span class="d-block">Call us or text us now!</span>
				</div>
			</div>		
		</div>
	</section>

	<section class="home-information">
		<div class="container">
			<div class="row justify-content-center text-center pt-3 py-md-4 py-lg-5 info-container">
				<div class="col-12 col-md-12 col-lg-6 mb-2 mb-md-5 mb-lg-3">
					<a href="tel:{{ $info['phone_number_1'] }}" class="red-btn big-btn phone-btn">{{ $info['support_phone_1'] }}</a>
				</div>
				<div class="col-12 col-md-12 col-lg-6 mb-2 mb-md-4 mb-lg-3">
					<a href="tel:{{ $info['phone_number_2'] }}" class="red-btn big-btn phone-btn">{{ $info['support_phone_2'] }}</a>
				</div>				
			</div>

			<div class="row justify-content-center text-center">
				<div class="col-12 col-md-12 col-lg-6">
					<a href="mailto:{{ $info['support_email'] }}" class="inverse-btn big-btn email-btn">{{ $info['support_email'] }}</a>
				</div>			
			</div>

			<div class="row justify-content-center mt-5">
				<div class="col-12 col-lg-10 text-center mb-1 my-lg-5">
					<h2 class="mb-3 mb-lg-5">24/7 Customer Service</h2>
					<div class="row align-items-center text-center d-flex">
						<div class="col-12 col-md-5 offset-md-1 col-lg-6 offset-lg-0 order-1 order-md-0 order-lg-0">
							<p class="mb-4 mb-lg-3">We can help you with any questions, problems regarding your login information, password problems, billing issues or even content errors.</p>
							<div class="row justify-content-center">
								<div class="col-12 col-md-12 col-lg-6 mb-3 mb-lg-0">
									<a href="{{ route('cancel') }}" class="red-btn d-block">
										<span class="d-block">Cancel</span>
										<span class="d-block">Subscription</span>
									</a>
								</div>
								<div class="col-12 col-md-12 col-lg-6 mb-3 mb-lg-0">
									<a href="{{ route('lookup') }}" class="inverse-btn d-block">
										<span class="d-block">Account</span>
										<span class="d-block">Lookup</span>
									</a>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-5 col-lg-6 mb-4 mt-lg-0 order-0 order-md-1 order-lg-1">
							<img src="img/photos/desktop/home-item-1.jpg" class="img-fluid home-item-1" alt="customer service image" />
						</div>
					</div>	
				</div>

				<div id="cc-lookup" class="col-12 col-md-10 col-lg-8 my-2 my-lg-5 text-center cc-lookup">
					<h3>Locate Order</h3>
					<span class="d-block">We will be glad to assist you</span>

					@if ($errors->first())
						<div class="col-12 text-center">						
							<div class="alert alert-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {{ $errors->first() }}</div>					
						</div>
						<hr/>
	                @endif
					
					<form class="cc-lookup-form" method="POST" action="{{ route('cclookup') }}">
						{{ csrf_field() }}
						<span class="d-block text-left black">Credit Card Number</span>
						<label class="d-block text-left my-3">
							<img src="/img/icons/info-2.png" alt="info icon" />
							<span>Please use first 6 and last 4 digits</span>
						</label>
						<input type="text" id="first_digits" name="first_digits" placeholder="- - - - - -" required />
						<span class="static">XX XXXX</span>
						<input type="text" id="last_digits" name="last_digits" placeholder="- - - -" required />
						<input class="d-block red-btn mt-4 mt-lg-5" type="submit" value="Submit" />
						{!! app('captcha')->render(); !!}
					</form>
				</div>

				<div class="col-12 col-lg-10 text-center my-3 my-lg-5">
					<h4 class="mb-3 mb-lg-5">What am I billed for?</h4>
					<div class="row align-items-center d-flex">
						<div class="col-12 col-md-5 offset-md-1 col-lg-6 offset-lg-0 text-left order-1 order-md-0 order-lg-0">
							<p>I just received my credit card statement. What am I being billed for? You have recently purchased an online service.</p>
							<p>We provide a variety of sites in many categories. To see which service you were billed for please call or email.</p>
						</div>
						<div class="col-12 col-md-5 col-lg-6 mb-4 mb-lg-0 order-0 order-md-1 order-lg-1">
							<img src="img/photos/desktop/home-item-2.png" class="img-fluid home-item-2" alt="customer service image" />
						</div>
					</div>
				</div>

				<div class="col-12 col-lg-10 text-center my-3 my-lg-5">
					<h4 class="mb-3 mb-lg-5">How do I cancel my Membership?</h4>
					<div class="row align-items-center">
						<div class="col-12 col-md-5 offset-md-1 col-lg-6 offset-lg-0 mb-4 mb-lg-0">
							<img src="img/photos/desktop/home-item-3.png" class="img-fluid home-item-3" alt="customer service image" />
						</div>
						<div class="col-12 col-md-5 col-lg-6 text-left text-md-right text-lg-right text-xl-right">
							<p>If you would like to cancel your membership, please call or email. If for some reason you aren't able to cancel, please contact our Customer Support team immediately, using one of the support methods above.</p>
						</div>
					</div>
				</div>

				<div class="col-12 col-lg-10 text-center my-3 my-lg-5">
					<h4 class="mb-3 mb-lg-5">Chargebacks and Cancels</h4>
					<div class="row align-items-center d-flex">
						<div class="col-12 col-md-5 offset-md-1 col-lg-6 offset-lg-0 mb-4 mb-lg-0 order-1 order-md-0 order-lg-0 text-left text-md-center text-lg-center text-xl-center">
							<div class="owl-carousel owl-theme" data-slideout-ignore>
								<p>If you have made it to this website, then you should have no reason to charge back a transaction. We are here to assist you, whether you have decided you are unhappy with the product or have concerns over charges on your card.</p>
								<p>If you feel that you no longer wish to remain a member, have concerns about charges, or any other inquiry, please don't hesitate to either write an email or pick up the phone now and get the service you deserve. Charging back a transaction takes time, and our service is available to you at no charge, no hassle, 24 hours a day, seven days a week.</p>
								<p>If you do choose to charge back any transaction, please understand that it is our policy to prohibit those who do from ever joining any site we own or operate in the future.which service you were billed for please call or email.which service you were billed for please call or email.</p>
							</div>
						</div>
						<div class="col-12 col-md-5 col-lg-6 mb-4 mb-lg-0 order-0 order-md-1 order-lg-1">
							<img src="img/photos/desktop/home-item-4.png" class="img-fluid home-item-4" alt="customer service image" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection