
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="{{ route('home') }}" target="_blank">
                    <span class="align-middle">FPM</span>
                </a>
				<ul class="sidebar-nav">
					<li class="sidebar-item {{ Request::url() == route('admin.dashboard') ? 'active' : '' }}">
						<a class="sidebar-link" href="{{ route('admin.dashboard') }}">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                        </a>
					</li>

					<li class="sidebar-header">Data</li>
					<li class="sidebar-item {{ is_int(strpos(Request::url(), route('admin.package.index'))) ? 'active' : '' }}">
						<a class="sidebar-link" href="{{ route('admin.package.index') }}">
							<i class="align-middle" data-feather="paperclip"></i> <span class="align-middle">Package</span>
						</a>
					</li>
					<li class="sidebar-item {{ is_int(strpos(Request::url(), route('admin.subscriber.index'))) ? 'active' : '' }}">
						<a class="sidebar-link" href="{{ route('admin.subscriber.index') }}">
							<i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Subscriber</span>
						</a>
					</li>

					<li class="sidebar-header">Dataset</li>
					<li class="sidebar-item {{ is_int(strpos(Request::url(), route('admin.dataset.index'))) && in_array(Request::query('json'), array_keys(datasets('small'))) ? 'active' : '' }}">
						<a data-bs-target="#dataset-small" data-bs-toggle="collapse" class="sidebar-link {{ is_int(strpos(Request::url(), route('admin.dataset.index'))) && in_array(Request::query('json'), array_keys(datasets('small'))) ? '' : 'collapsed' }}">
							<i class="align-middle" data-feather="database"></i> <span class="align-middle">Kecil</span>
						</a>
						<ul id="dataset-small" class="sidebar-dropdown list-unstyled collapse {{ is_int(strpos(Request::url(), route('admin.dataset.index'))) && in_array(Request::query('json'), array_keys(datasets('small'))) ? 'show' : '' }}" data-bs-parent="#sidebar">
							@foreach(datasets('small') as $key=>$dataset)
							<li class="sidebar-item {{ is_int(strpos(Request::url(), route('admin.dataset.index'))) && Request::query('json') == $key ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('admin.dataset.index', ['json' => $key]) }}">{{ $dataset }}</a></li>
							@endforeach
						</ul>
					</li>
					<li class="sidebar-item {{ is_int(strpos(Request::url(), route('admin.dataset.index'))) && in_array(Request::query('json'), array_keys(datasets('large'))) ? 'active' : '' }}">
						<a data-bs-target="#dataset-large" data-bs-toggle="collapse" class="sidebar-link {{ is_int(strpos(Request::url(), route('admin.dataset.index'))) && in_array(Request::query('json'), array_keys(datasets('large'))) ? '' : 'collapsed' }}">
							<i class="align-middle" data-feather="database"></i> <span class="align-middle">Besar</span>
						</a>
						<ul id="dataset-large" class="sidebar-dropdown list-unstyled collapse {{ is_int(strpos(Request::url(), route('admin.dataset.index'))) && in_array(Request::query('json'), array_keys(datasets('large'))) ? 'show' : '' }}" data-bs-parent="#sidebar">
							@foreach(datasets('large') as $key=>$dataset)
							<li class="sidebar-item {{ is_int(strpos(Request::url(), route('admin.dataset.index'))) && Request::query('json') == $key ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('admin.dataset.index', ['json' => $key]) }}">{{ $dataset }}</a></li>
							@endforeach
						</ul>
					</li>
				</ul>
			</div>
		</nav>