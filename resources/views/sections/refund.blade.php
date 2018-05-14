@extends('layouts.app')

@section('title', 'Refund')

@section('content')
<div id="panel">
	<section class="main title">
		<div class="container-fluid">
			<div class="row justify-content-center">
				<div class="col-12 col-md-12 col-lg-12">
					<h1 class="d-block text-center py-3 pb-1 mt-3">Refund</h1>
				</div>
			</div>		
		</div>
	</section>

	<section class="refund-information">
		<div class="container">
			<div class="row justify-content-center text-center pt-3 pb-3 pb-lg-5">
				<div class="col-12 col-md-10 col-lg-9 py-2 py-lg-5">
					<p>If you are not satisfied with your membership simply email customer support and request for your membership to be canceled and a refund for your last charge.</p>
					<p>Your account will be canceled and a refund will be issued. Note your access will stop working the day your refund is processed</p>
				</div>
				<div class="col-12 col-md-10 col-lg-12 py-2 py-lg-5 mb-3 mb-md-5 mb-lg-5">
					<a href="mailto:{{ $info['support_email'] }}" class="inverse-btn big-btn email-btn">{{ $info['support_email'] }}</a>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection