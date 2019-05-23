@extends('layouts.main-dash')

@section('dash-content')

	<?php 
  		$route = Route::currentRouteName();
  		$all = route('thumbnail.index');
  		$active = route('thumbnail.active');
  		$inactive = route('thumbnail.inactive');
	?>

	<section class="section">
        <div class="section-header">
        	<h1>Thumbnail</h1>
        </div>

        
        <div class="section-body">
            <h2 class="section-title">Thumbnail Acara</h2>
            <p class="section-lead">
              	Pada halaman ini anda bisa melihat thumbnail acara yang ditampilkan pada halaman utama.
            </p>

            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Thumbnail list</h4>
                            <div class="card-header-action">
                                <a href="{{ route('thumbnail.create') }}" class="btn btn-primary">Create one <i class="fas fa-plus"></i></a>
                                <a href="#" data-toggle="dropdown" class="btn btn-danger dropdown-toggle">Filter</a>
                                <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-left">
			                      <li class="dropdown-title">Pilih data</li>
			                      <li><a href="{{ $all }}" class="dropdown-item {{ $route == 'thumbnail.index' ? 'active' : '' }}">Semua</a></li>
			                      <li><a href="{{ $active }}" class="dropdown-item {{ $route == 'thumbnail.active' ? 'active' : '' }}">Active</a></li>
			                      <li><a href="{{ $inactive }}" class="dropdown-item {{ $route == 'thumbnail.inactive' ? 'active' : '' }}">Inactive</a></li>
			                    </ul>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="summary">
                                <div class="summary-item">
                                    <ul class="list-unstyled list-unstyled-border">
                                        @if(count($data) < 1)
                                            <span>No data found</span>
                                        @else
                                            @foreach($data as $field)
                                            <li class="media">
                                                <a href="#">
                                                    <img class="mr-3 rounded" width="70" src="{{ asset('image/thumbnail/'.$field->image) }}" alt="product">
                                                </a>
                                                <div class="media-body">
                                                    <div class="media-right m-2">
                                                        @if($field->status == "active")
                                                            <div class="badge badge-success">Active</div>
                                                        @else
                                                            <div class="badge badge-danger">Inactive</div>
                                                        @endif
                                                        <div class="float-right dropdown ml-2">
				                                            <a href="#" data-toggle="dropdown">
				                                                <i class="fas fa-cog"></i>
				                                            </a>
				                                            <div class="dropdown-menu">
				                                                <div class="dropdown-title">Options</div>
				                                                <a href="{{ route('thumbnail.edit',$field) }}" class="dropdown-item has-icon"><i class="fas fa-pencil-alt"></i> Edit</a>
				                                                @if($field->status == 'inactive')
																	<a href="{{ route('thumbnail.setactive',$field) }}" class="dropdown-item has-icon {{ count($thum) == 5 ? 'btn-confirm' : '' }}" title="Set Active?" content="Aksi ini dapat menonaktifkan thumbnail yang sedang aktif dipilih berdasarkan data terlama"><i class="far fa-check-square text-success"></i> Set Active</a>
				                                                @endif
				                                                <div class="dropdown-divider"></div>
				                                                <a href="{{ route('thumbnail.destroy',$field) }}" class="dropdown-item has-icon text-danger delete-btn"><i class="fas fa-trash-alt"></i> Hapus</a>
				                                            </div>
				                                        </div>
                                                    </div>
                                                    <div class="media-title"><a href="#">{{ $field->title }}</a>
                                                        <br>
                                                        <p class="text-muted text-small">
                                                            {{ str_limit($field->content, $limit = 40, $end = '...') }}
                                                        </p>
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
                </div>

                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <div id="carousel" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    @foreach($thum as $field)
                                        <li data-target="#carousel" data-slide-to="{{ $loop->index }}" class="active"></li>
                                    @endforeach
                                </ol>
                                <div class="carousel-inner" style="border-radius: 5px 5px 5px 5px !important;">
                                    @foreach($thum as $field)
                                        <div class="carousel-item {{ $loop->index == 0 ? 'active': '' }}">
                                            <img class="d-block" width="500" height="300" src="{{ asset('image/thumbnail/'.$field->image) }}" alt="First slide">
                                            <div class="carousel-caption custom-caption">
                                                <h5>{{ $field->title }}</h5>
                                                <p>{{ str_limit($field->content, $limit = 90, $end = '...') }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @if(count($thum) > 1)
                                    <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</section>

@endsection