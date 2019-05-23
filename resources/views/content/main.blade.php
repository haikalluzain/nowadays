@extends('layouts.main-dash')

@section('dash-content')

	<section class="section">
        <div class="section-header">
        	<h1>Dashboard</h1>
        </div>

        <div class="section-body">
			<div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Admin</h4>
                  </div>
                  <div class="card-body">
                    10
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>News</h4>
                  </div>
                  <div class="card-body">
                    42
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Reports</h4>
                  </div>
                  <div class="card-body">
                    1,201
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-circle"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Online Users</h4>
                  </div>
                  <div class="card-body">
                    47
                  </div>
                </div>
              </div>
            </div>                  
          </div>

          <div class="row">
            <div class="col-lg-8 col-md-12 col-12 col-sm-12">
              
              <div class="card shadow">
                        <div class="card-body">
                            <div id="carousel" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    @foreach($thum as $field)
                                        <li data-target="#carousel" data-slide-to="{{ $loop->index }}" class="active"></li>
                                    @endforeach
                                </ol>
                                <div class="carousel-inner" style="border-radius: 5px 5px 5px 5px !important;">
                                  @if(count($thum) < 1)
                                    <div class="carousel-item active">
                                      <img class="d-block" width="667" height="400" src="{{ asset('image/content/img06.jpg') }}" alt="First slide">
                                              <div class="carousel-caption custom-caption">
                                                  <h5>Title</h5>
                                                  <p>Description of the event</p>
                                              </div>
                                          </div>
                                     @else
                                        @foreach($thum as $field)
                                            <div class="carousel-item {{ $loop->index == 0 ? 'active': '' }}">
                                                <img class="d-block" width="667" height="400" src="{{ asset('image/thumbnail/'.$field->image) }}" alt="First slide">
                                                <div class="carousel-caption custom-caption">
                                                    <h5>{{ $field->title }}</h5>
                                                    <p>{{ str_limit($field->content, $limit = 200, $end = '...') }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                  @endif
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
            <div class="col-lg-4 col-md-12 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4>Today Activities</h4>
                </div>
                <div class="card-body">             
                  <ul class="list-unstyled list-unstyled-border">
                    @if(count($today) < 1)
                      <span>Belum ada jadwal hari ini</span>
                    @else
                      @foreach($today as $field)
                        <li class="media">
                          <div class="media-body">
                            <div class="media-title text-primary">{{ $field->start }}</div>
                            <span class="text-small text-muted">{{ str_limit($field->activity, $limit = 112, $end = '...') }}</span>
                          </div>
                        </li>
                      @endforeach
                    @endif

                  </ul>
                  <div class="text-center pt-1 pb-1">
                    @if(count($today) < 1)
                      <a href="{{ route('today.list') }}" class="btn btn-primary btn-round">
                        Create one <i class="fas fa-plus"></i>
                      </a>
                    @else
                      <a href="{{ route('today.date') }}" class="btn btn-primary btn-round">
                        View all
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