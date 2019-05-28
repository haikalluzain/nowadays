@extends('layouts.app')


@section('content')

	<nav class="navbar navbar-custom bg-primary justify-content-center">
        <a class="navbar-brand" href="#"></a>
        <a class="navbar-brand" href="#"><img class="pb-1" width="55" height="40" src="{{ asset('image/logo/logo-white.png') }}" alt=""> <span class="ml-1">Wikrama Nowadays</span></a>
        <a class="navbar-brand" href="#"></a>
    </nav>

	<div class="container-fluid col-auth">
		<section>
			<div class="card shadow ml-3">
				<div class="row">
	            	<div class="col-lg-6 pr-0">
	              		<div class="card no-shadow card-custom-top mb-0 bg-primary" style="border-right:1px solid #dee2e6 !important;border-bottom: 1px solid #dee2e6 !important; border-radius: 0px 0px 0px 0px !important;">
	                		<div class="card-body py-0 px-0">
	                  			<div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
			                        <ol class="carousel-indicators">
			                            @foreach($thum as $field)
                                        	<li data-target="#carousel" data-slide-to="{{ $loop->index }}" class="active"></li>
                                    	@endforeach
			                        </ol>
			                        <div class="carousel-inner" style="border-radius: 5px 0px 0px 0px !important;">
			                            @if(count($thum) < 1)
											<div class="carousel-item active">
	                                            <img class="d-block" width="540" height="400" src="{{ asset('image/content/img06.jpg') }}" alt="First slide">
	                                            <div class="carousel-caption custom-caption">
	                                                <h5>Title</h5>
	                                                <p>Description of the event</p>
	                                            </div>
	                                        </div>
			                            @else
											@foreach($thum as $field)
		                                        <div class="carousel-item {{ $loop->index == 0 ? 'active': '' }}">
		                                            <img class="d-block" width="540" height="400" src="{{ asset('image/thumbnail/'.$field->image) }}" alt="First slide">
		                                            <div class="carousel-caption custom-caption">
		                                                <h5>{{ $field->title }}</h5>
		                                                <p>{{ str_limit($field->content, $limit = 200, $end = '...') }}</p>
		                                            </div>
		                                        </div>
		                                    @endforeach
			                            @endif
			                        </div>
			                        {{-- @if(count($thum) > 1)
	                                    <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
	                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	                                        <span class="sr-only">Previous</span>
	                                    </a>
	                                    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
	                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
	                                        <span class="sr-only">Next</span>
	                                    </a>
	                                @endif --}}
			                    </div>
		                	</div>
		              	</div>
		            </div>
		            <div class="col-lg-6 pl-0">
		              	<div class="card no-shadow card-custom-top mb-0" style="border-bottom: 1px solid #dee2e6 !important; border-radius: 0px 5px 0px 0px !important;">
			                <div class="card-header card-header-custom">
			                  	<h4>Aktivitas Hari ini</h4>
			                  	<div class="card-header-form">
			                        <h4>{{ $now }}</h4>
			                    </div>
			                </div>
			                <div class="card-body pt-0" id="top-5-scroll">             
			                  	<ul class="list-unstyled list-unstyled-border">
			                    	
		                        	@if(count($today) < 1)

		                        		<div class="alert alert-light">Belum ada jadwal hari ini</div>

		                        	@else

		                        		@foreach($today as $data)

										
											<li class="container-fluid px-0 py-2 my-1">
				                          		<div class="form-group row mb-0">
				                            		<div class="col-3 pr-0">
				                            			<div class="h6 text-primary font-weight-bold mb-0">{{ $data->start }} - {{ $data->end }}</div>
				                            		</div>
				                            		<div class="col-9 pl-3">
				                            			<span class="text-muted">{{ str_limit($data->activity, $limit = 112, $end = '...') }}</span>
				                            		</div>
				                          		</div>
				                        	</li>

		                        		@endforeach

			                        @endif
			                                         	
			                  	</ul>
			                </div>
		              	</div>
		            </div>
		        </div>
		        <div class="row">
		        	<div class="col-lg-6 pr-0">
		              	<div class="card no-shadow mb-0" style="border-right:1px solid #dee2e6 !important;border-radius: 0px !important;border-radius: 0px 0px 0px 5px !important;">
			                {{-- <div class="card-header card-header-custom">
			                  	<h4>Aktivitas Hari ini</h4>
			                  	<div class="card-header-form">
			                        <h4>Minggu, 3 Februari 2019</h4>
			                    </div>
			                </div> --}}
			                <div class="card-body pt-4">             
			                  	<div id="fullcalendar"></div>
			                </div>
		              	</div>
		            </div>

		            <div class="col-lg-6 pl-0">
		              	<div class="card no-shadow mb-0" style="border-radius: 0px !important;border-radius: 0px 0px 5px 0px !important;">
			                <div class="card-header card-header-custom mb-0">
			                  	<h4>Absensi</h4>
			                  	{{-- <div class="card-header-form">
			                        <h4>Minggu, 3 Februari 2019</h4>
			                    </div> --}}
			                </div>
			                <div class="card-body pt-0">             
			                  	<div class="row">
			                  		<div class="col-4 px-0 pl-1">
				                  		<div class="card card-statistic-1 no-shadow">
							                <div class="card-icon shadow card-icon-custom bg-primary">
							                  	<i class="far fa-user"></i>
							                </div>
							                <div class="card-wrap">
							                  	<div class="card-header p-0 pt-4">
							                   		<h4 class="text-small p-0">Total Siswa</h4>
							                  	</div>
							                  	<div class="card-body p-0">
							                    	{{ $total }}
							                  	</div>
							                </div>
							            </div>
				                  	</div>
				                  	<div class="col-4 px-0 pl-1">
				                  		<div class="card card-statistic-1 no-shadow">
							                <div class="card-icon shadow card-icon-custom bg-success">
							                  	<i class="far fa-user"></i>
							                </div>
							                <div class="card-wrap">
							                  	<div class="card-header p-0 pt-4">
							                   		<h4 class="text-small p-0">Siswa Hadir</h4>
							                  	</div>
							                  	<div class="card-body p-0">
							                    	{{ $present }}
							                  	</div>
							                </div>
							            </div>
				                  	</div>
				                  	<div class="col-4 px-0 px-1">
				                  		<div class="card card-statistic-1 no-shadow">
							                <div class="card-icon shadow card-icon-custom bg-danger">
							                  	<i class="far fa-user"></i>
							                </div>
							                <div class="card-wrap">
							                  	<div class="card-header p-0 pt-4">
							                   		<h4 class="text-small p-0">Tidak hadir</h4>
							                  	</div>
							                  	<div class="card-body p-0">
							                    	{{ $not_present }}
							                  	</div>
							                </div>
							            </div>
				                  	</div>

				                  	<div class="card no-shadow card-statistic-2 mb-0">
						                <div class="card-stats">
						                  	<div class="card-stats-items">
						                    	@foreach($attendance as $att)
													<div class="card-stats-item">
							                      		<div class="font-weight-bold">{{ $att->major->alias }}</div>
							                      		<div class="card-stats-item-label">{{ $att->present }}</div>
							                    	</div>
						                    	@endforeach
						                  	</div>
						                </div>
					              	</div>
			                  	</div>   
			                </div>
		              	</div>
		            </div>
		        </div>
			</div>
		</section>
	</div>

<script type="text/javascript">
	setTimeout(function() {
		location.reload()
	},3 * 60 * 1000)
</script>

@endsection