<footer class="container-fluid py-4 pb-4">
	<div class="row justify-content-center">
		<div class="col-12 col-md-10 col-lg-8">
			<div class="row align-items-center">
				<div class="col-12 col-md-6 col-lg-6">
					<a href="{{ route('index') }}" class="logo">
						<img src="/img/logo-ccpay4.png" alt="{{ $info['support_website'] }} Logo" />
					</a>					
				</div>
				<div class="col-12 col-md-6 col-lg-6 mt-4 mt-lg-0 text-center text-sm-right text-md-right text-lg-right">
					<span class="d-block">Copyright &copy; <?php echo date('Y'); ?>. All Rights Reserved</span>
					<span class="d-block">For support please call <a href="tel:{{ $info['phone_number_1'] }}">{{ $info['support_phone_1'] }}</a></span>
					<span class="d-block text-center text-sm-right text-md-right text-lg-right"><a href="tel:{{ $info['phone_number_2'] }}">{{ $info['support_phone_2'] }}</a></span>
					<span class="d-block">Email: <a href="mailto:{{ $info['support_email'] }}">{{ $info['support_email'] }}</a></span>
				</div>
			</div>
		</div>
	</div>
</footer>

<ul class="nav nav-fill nav-footer fixed-bottom d-md-none d-lg-none d-xl-none">
	<li class="nav-item">
		<a class="nav-link" href="{{ route('index') }}">
			<span class="footer-icon footer-home-icon"></span>
			Home
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="{{ route('cancel') }}">
			<span class="footer-icon footer-cancel-icon"></span>
			Cancel Subscription
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="{{ route('lookup') }}">
			<span class="footer-icon footer-lookup-icon"></span>
			Account Lookup
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="{{ route('index') . '#cc-lookup' }}">
			<span class="footer-icon footer-support-icon"></span>
			CC Lookup
		</a>
	</li>
</ul>
