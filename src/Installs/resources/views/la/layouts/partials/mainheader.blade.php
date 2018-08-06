<!-- Main Header -->
<header class="main-header">

	@if(BackendConfigs::getByKey('layout') != 'layout-top-nav')
	<!-- Logo -->
	<a href="{{ url(config('laraadmin.adminRoute')) }}" class="logo">
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<span class="logo-mini"><b>{{ BackendConfigs::getByKey('sitename_short') }}</b></span>
		<!-- logo for regular state and mobile devices -->
		<span class="logo-lg"><b>{{ BackendConfigs::getByKey('sitename_part1') }}</b>
		 {{ BackendConfigs::getByKey('sitename_part2') }}</span>
	</a>
	@endif

	<!-- Header Navbar -->
	<nav class="navbar navbar-static-top" role="navigation">
	@if(BackendConfigs::getByKey('layout') == 'layout-top-nav')
		<div class="container">
			<div class="navbar-header">
				<a href="{{ url(config('laraadmin.adminRoute')) }}" class="navbar-brand"><b>{{ BackendConfigs::getByKey('sitename_part1') }}</b>{{ BackendConfigs::getByKey('sitename_part2') }}</a>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
					<i class="fa fa-bars"></i>
				</button>
			</div>
			@include('la.layouts.partials.top_nav_menu')
			@include('la.layouts.partials.notifs')
		</div><!-- /.container-fluid -->
	@else
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle b-l" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>
		@include('la.layouts.partials.notifs')
	@endif
	
	</nav>
</header>
