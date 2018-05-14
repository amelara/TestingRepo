@extends('layouts.app')

@section('title', 'Privacy')

@section('content')
<div id="panel">
	<section class="main title">
		<div class="container-fluid">
			<div class="row justify-content-center">
				<div class="col-12 col-md-12 col-lg-12">
					<h1 class="d-block text-center py-3 pb-1 mt-3">Privacy</h1>
				</div>
			</div>		
		</div>
	</section>

	<section class="privacy-information">
		<div class="container">
			<div class="row justify-content-center text-center py-5">
				<div class="col-12 col-md-12 col-lg-10">
					<img class="img-fluid privacy-intro" src="/img/text/desktop/privacy/intro.png" alt="content" />
				</div>
				<div class="col-12 col-md-12 col-lg-12 py-5">
					<div id="accordion" class="accordion" role="tablist" data-children=".item">
						<div class="item mb-3">
							<div class="card-header" role="tab" id="headingOne">
								<h3 class="mb-0 text-left active">
									<a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									Revision
										<button class="item-btn">
										  	<span class="plus"><i class="fa fa-plus"></i></span>
										  	<span class="minus"><i class="fa fa-minus"></i></span>
										</button>
									</a>
								</h3>
							</div>

							<div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="card-body">
									<img class="img-fluid terms-item-1" src="/img/text/desktop/privacy/revision.png" alt="content" />
								</div>
							</div>
						</div>

						<div class="item mb-3">
							<div class="card-header" role="tab" id="headingTwo">
								<h3 class="mb-0 text-left">
									<a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
									Information Collected
										<button class="item-btn">
										  	<span class="plus"><i class="fa fa-plus"></i></span>
										  	<span class="minus"><i class="fa fa-minus"></i></span>
										</button>
									</a>
								</h3>
							</div>
							<div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
								<div class="card-body">
									<img class="img-fluid terms-item-2" src="/img/text/desktop/privacy/information-collected.png" alt="content" />
								</div>
							</div>
						</div>
						
						<div class="item mb-3">
							<div class="card-header" role="tab" id="headingThree">
								<h3 class="mb-0 text-left">
									<a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
									Use of Collected Information
										<button class="item-btn">
										  	<span class="plus"><i class="fa fa-plus"></i></span>
										  	<span class="minus"><i class="fa fa-minus"></i></span>
										</button>
									</a>
								</h3>
							</div>
							<div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
								<div class="card-body">
									<img class="img-fluid terms-item-3" src="/img/text/desktop/privacy/use-of-collected-info.png" alt="content" />
								</div>
							</div>
						</div>

						<div class="item mb-3">
							<div class="card-header" role="tab" id="headingFour">
								<h3 class="mb-0 text-left">
									<a class="collapsed" data-toggle="collapse" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
									Security
										<button class="item-btn">
										  	<span class="plus"><i class="fa fa-plus"></i></span>
										  	<span class="minus"><i class="fa fa-minus"></i></span>
										</button>
									</a>
								</h3>
							</div>
							<div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour" data-parent="#accordion">
								<div class="card-body">
									<img class="img-fluid terms-item-4" src="/img/text/desktop/privacy/security.png" alt="content" />
								</div>
							</div>
						</div>

						<div class="item mb-3">
							<div class="card-header" role="tab" id="headingFive">
								<h3 class="mb-0 text-left">
									<a class="collapsed" data-toggle="collapse" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
									Emails
										<button class="item-btn">
										  	<span class="plus"><i class="fa fa-plus"></i></span>
										  	<span class="minus"><i class="fa fa-minus"></i></span>
										</button>
									</a>
								</h3>
							</div>
							<div id="collapseFive" class="collapse" role="tabpanel" aria-labelledby="headingFive" data-parent="#accordion">
								<div class="card-body">
									<img class="img-fluid terms-item-5" src="/img/text/desktop/privacy/emails.png" alt="content" />
								</div>
							</div>
						</div>

						<div class="item mb-3">
							<div class="card-header" role="tab" id="headingSix">
								<h3 class="mb-0 text-left">
									<a class="collapsed" data-toggle="collapse" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
									Posted information
										<button class="item-btn">
										  	<span class="plus"><i class="fa fa-plus"></i></span>
										  	<span class="minus"><i class="fa fa-minus"></i></span>
										</button>
									</a>
								</h3>
							</div>
							<div id="collapseSix" class="collapse" role="tabpanel" aria-labelledby="headingSix" data-parent="#accordion">
								<div class="card-body">
									<img class="img-fluid terms-item-6" src="/img/text/desktop/privacy/posted-info.png" alt="content" />
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection