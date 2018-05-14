<nav id="menu">
	<span class="d-block close-menu">
		Menu
		<button type="button" class="close" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</span>
	<a class="nav-item nav-link active" href="{{ route('index') }}"><span class="nav-icon home-icon"></span> Home</a>
	<a class="nav-item nav-link" href="{{ route('lookup') }}"><span class="nav-icon lookup-icon"></span> Account Lookup</a>
	<a class="nav-item nav-link" href="{{ route('cancel') }}"><span class="nav-icon cancel-icon"></span> Cancel Subscription</a>
	<a class="nav-item nav-link" href="{{ route('terms') }}"><span class="nav-icon terms-icon"></span> Terms</a>
	<a class="nav-item nav-link" href="{{ route('privacy') }}"><span class="nav-icon privacy-icon"></span> Privacy</a>
	<a class="nav-item nav-link" href="{{ route('refund') }}"><span class="nav-icon refund-icon"></span> Refund</a>
</nav>