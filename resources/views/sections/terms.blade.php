@extends('layouts.app')

@section('title', 'Terms')

@section('content')
<div id="panel">
	<section class="main title">
		<div class="container-fluid">
			<div class="row justify-content-center">
				<div class="col-12 col-md-12 col-lg-12">
					<h1 class="d-block text-center py-3 pb-1 mt-3">Terms</h1>
				</div>
			</div>		
		</div>
	</section>

	<section class="terms-information">
		<div class="container">
			<div class="row justify-content-center text-center py-5">
				<div class="col-12 col-md-12 col-lg-10">
					<img class="img-fluid terms-intro" src="/img/text/desktop/terms/intro.png" alt="content" />
				</div>
				<div class="col-12 col-md-12 col-lg-12 py-5">
					<div id="accordion" class="accordion" role="tablist" data-children=".item">
						<div class="item mb-3">
							<div class="card-header" role="tab" id="headingOne">
								<h3 class="mb-0 text-left active">
									<a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									Binding Agreement
										<button class="item-btn">
										  	<span class="plus"></span>
										  	<span class="minus"></span>
										</button>
									</a>
								</h3>
							</div>

							<div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="card-body">
									<img class="img-fluid terms-item-1" src="/img/text/desktop/terms/binding-agreement.png" alt="content" />
								</div>
							</div>
						</div>

						<div class="item mb-3">
							<div class="card-header" role="tab" id="headingTwo">
								<h3 class="mb-0 text-left">
									<a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
									Amendments and Modifications
										<button class="item-btn">
										  	<span class="plus"><i class="fa fa-plus"></i></span>
										  	<span class="minus"><i class="fa fa-minus"></i></span>
										</button>
									</a>
								</h3>
							</div>
							<div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
								<div class="card-body">
									<img class="img-fluid terms-item-2" src="/img/text/desktop/terms/amendments-and-modifications.png" alt="content" />
								</div>
							</div>
						</div>

						<div class="item mb-3">
							<div class="card-header" role="tab" id="headingThree">
								<h3 class="mb-0 text-left">
									<a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
									No Underage Use
										<button class="item-btn">
										  	<span class="plus"><i class="fa fa-plus"></i></span>
										  	<span class="minus"><i class="fa fa-minus"></i></span>
										</button>
									</a>
								</h3>
							</div>
							<div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
								<div class="card-body">
									<img class="img-fluid terms-item-3" src="/img/text/desktop/terms/no-underage-use.png" alt="content" />
								</div>
							</div>
						</div>

						<div class="item mb-3">
							<div class="card-header" role="tab" id="headingFour">
								<h3 class="mb-0 text-left">
									<a class="collapsed" data-toggle="collapse" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
									Intellectual Property
										<button class="item-btn">
										  	<span class="plus"><i class="fa fa-plus"></i></span>
										  	<span class="minus"><i class="fa fa-minus"></i></span>
										</button>
									</a>
								</h3>
							</div>
							<div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour" data-parent="#accordion">
								<div class="card-body">
									<img class="img-fluid terms-item-4" src="/img/text/desktop/terms/intellectual-property.png" alt="content" />
								</div>
							</div>
						</div>	

						<div class="item mb-3">
							<div class="card-header" role="tab" id="headingFive">
								<h3 class="mb-0 text-left">
									<a class="collapsed" data-toggle="collapse" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
									Membership
										<button class="item-btn">
										  	<span class="plus"><i class="fa fa-plus"></i></span>
										  	<span class="minus"><i class="fa fa-minus"></i></span>
										</button>
									</a>
								</h3>
							</div>
							<div id="collapseFive" class="collapse" role="tabpanel" aria-labelledby="headingFive" data-parent="#accordion">
								<div class="card-body">
									<img class="img-fluid terms-item-5" src="/img/text/desktop/terms/membership.png" alt="content" />
								</div>
							</div>
						</div>			

						<div class="item mb-3">
							<div class="card-header" role="tab" id="headingSix">
								<h3 class="mb-0 text-left">
									<a class="collapsed" data-toggle="collapse" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
									Usage Guidelines
										<button class="item-btn">
										  	<span class="plus"><i class="fa fa-plus"></i></span>
										  	<span class="minus"><i class="fa fa-minus"></i></span>
										</button>
									</a>
								</h3>
							</div>
							<div id="collapseSix" class="collapse" role="tabpanel" aria-labelledby="headingSix" data-parent="#accordion">
								<div class="card-body">
									<img class="img-fluid terms-item-6" src="/img/text/desktop/terms/usage-guidelines.png" alt="content" />
								</div>
							</div>
						</div>

						<div class="item mb-3">
							<div class="card-header" role="tab" id="headingSeven">
								<h3 class="mb-0 text-left">
									<a class="collapsed" data-toggle="collapse" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
									Assumption of Risks
										<button class="item-btn">
										  	<span class="plus"><i class="fa fa-plus"></i></span>
										  	<span class="minus"><i class="fa fa-minus"></i></span>
										</button>
									</a>
								</h3>
							</div>
							<div id="collapseSeven" class="collapse" role="tabpanel" aria-labelledby="headingSeven" data-parent="#accordion">
								<div class="card-body">
									<img class="img-fluid terms-item-7" src="/img/text/desktop/terms/assumption-of-risks.png" alt="content" />
								</div>
							</div>
						</div>

						<div class="item mb-3">
							<div class="card-header" role="tab" id="headingEight">
								<h3 class="mb-0 text-left">
									<a class="collapsed" data-toggle="collapse" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
									Dispute Resolution
										<button class="item-btn">
										  	<span class="plus"><i class="fa fa-plus"></i></span>
										  	<span class="minus"><i class="fa fa-minus"></i></span>
										</button>
									</a>
								</h3>
							</div>
							<div id="collapseEight" class="collapse" role="tabpanel" aria-labelledby="headingEight" data-parent="#accordion">
								<div class="card-body">
									<img class="img-fluid terms-item-8" src="/img/text/desktop/terms/dispute-resolution.png" alt="content" />
								</div>
							</div>
						</div>
						
						<div class="item mb-3">
							<div class="card-header" role="tab" id="headingNine">
								<h3 class="mb-0 text-left">
									<a class="collapsed" data-toggle="collapse" href="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
									Limitation of Liability
										<button class="item-btn">
										  	<span class="plus"><i class="fa fa-plus"></i></span>
										  	<span class="minus"><i class="fa fa-minus"></i></span>
										</button>
									</a>
								</h3>
							</div>
							<div id="collapseNine" class="collapse" role="tabpanel" aria-labelledby="headingNine" data-parent="#accordion">
								<div class="card-body">
									<img class="img-fluid terms-item-9" src="/img/text/desktop/terms/limitation-of-liability.png" alt="content" />
								</div>
							</div>
						</div>

						<div class="item mb-3">
							<div class="card-header" role="tab" id="headingTen">
								<h3 class="mb-0 text-left">
									<a class="collapsed" data-toggle="collapse" href="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
									Indemnification
										<button class="item-btn">
										  	<span class="plus"><i class="fa fa-plus"></i></span>
										  	<span class="minus"><i class="fa fa-minus"></i></span>
										</button>
									</a>
								</h3>
							</div>
							<div id="collapseTen" class="collapse" role="tabpanel" aria-labelledby="headingTen" data-parent="#accordion">
								<div class="card-body">
									<img class="img-fluid terms-item-10" src="/img/text/desktop/terms/indemnification.png" alt="content" />
								</div>
							</div>
						</div>

						<div class="item mb-3 last">
							<div class="card-header" role="tab" id="headingEleven">
								<h3 class="mb-0 text-left">
									<a class="collapsed" data-toggle="collapse" href="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
									Miscellaneous
										<button class="item-btn">
										  	<span class="plus"><i class="fa fa-plus"></i></span>
										  	<span class="minus"><i class="fa fa-minus"></i></span>
										</button>
									</a>
								</h3>
							</div>
							<div id="collapseEleven" class="collapse" role="tabpanel" aria-labelledby="headingEleven" data-parent="#accordion">
								<div class="card-body">
									<img class="img-fluid terms-item-11" src="/img/text/desktop/terms/miscellaneous.png" alt="content" />
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