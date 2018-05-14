<header>
	<div class="navbar navbar-expand-lg navbar-expand-md fixed-top justify-content-between">
		<div class="container">
	  		<a href="{{ route('index') }}" class="logo navbar-brand">
				<img src="/img/logo-ccpay4.png" class="img-fluid" alt="{{ $info['support_website'] }} Logo" />
			</a>
			<div class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link active" href="{{ route('index') }}"><span class="nav-icon home-icon"></span> Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('lookup') }}"><span class="nav-icon lookup-icon"></span> Account Lookup</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('cancel') }}"><span class="nav-icon cancel-icon"></span> Cancel Subscription</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('terms') }}"><span class="nav-icon terms-icon"></span> Terms</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('privacy') }}"><span class="nav-icon privacy-icon"></span> Privacy</a>
				</li>
				<li class="nav-item">
					<a class="nav-link last-item" href="{{ route('refund') }}"><span class="nav-icon refund-icon"></span> Refund</a>
				</li>
		    </div>
	  		<button class="menu-icon navbar-toggler">
	  			<img src="/img/icons/menu.png" alt="menu icon"/>
	  		</button>
	  	</div>
	</div>
</header>