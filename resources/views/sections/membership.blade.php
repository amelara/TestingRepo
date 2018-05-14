@extends('layouts.app')

@section('title', 'New Membership')

@section('content')
<div id="panel">
	<section class="main title">
		<div class="container-fluid">
			<div class="row justify-content-center">
				<div class="col-12 col-md-12 col-lg-12">
					<h1 class="d-block text-center py-3 pb-1 mt-3">New Membership</h1>
				</div>
			</div>		
		</div>
	</section>

	<section class="membership-information">
		<div class="container">
			<div class="row justify-content-center text-center py-2 py-lg-5">
				<div class="col-12 col-md-10 col-lg-8 pb-3 pb-lg-5">
					<div class="row justify-content-center py-3 py-lg-5">
						<div class="shadow col-12 col-sm-12 col-md-10 col-lg-10 py-5">
							<p class="bold notification">
								<img src="/img/icons/info.png" alt="info icon" class="img-fluid pb-4">
								<span class="d-block">You have successfully</span>
								<span class="d-block">changed your membership.</span>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection