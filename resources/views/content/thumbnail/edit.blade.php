@extends('layouts.main-dash')

@section('dash-content')

	<section class="section">
        <div class="section-header">
        	<h1>Edit Thumbnail</h1>
        </div>

        
        <div class="section-body">
            <h2 class="section-title">Buat Thumbnail Acara</h2>
            <p class="section-lead">
              	Pada halaman ini anda bisa membuat thumbnail acara untuk ditampilkan pada halaman utama.
            </p>

            <div class="row">
              	<div class="col-12">
                	<div class="card">
                  		<div class="card-header">
                    		<h4>Form</h4>
                  		</div>
                  		<div class="card-body">
                    		<form action="{{ route('thumbnail.update',$data) }}" method="post" enctype="multipart/form-data">
                    			@csrf @method('patch')
                    			<div class="form-group row mb-4">
			                      	<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
			                      	<div class="col-sm-12 col-md-7">
			                        	<input type="text" name="title" class="form-control" value="{{ $data->title }}">
			                      	</div>
			                    </div>
			                    <div class="form-group row mb-4">
			                      	<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content</label>
			                      	<div class="col-sm-12 col-md-7">
			                        	<textarea class="form-control" name="content">{{ $data->content }}</textarea>
			                      	</div>
			                    </div>

			                    <div class="form-group row mb-4">
			                      	<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
			                      	<div class="col-sm-12 col-md-7">
			                          	<input type="file" class="dropify" id="image" name="image"data-allowed-file-extensions="jpg jpeg png" data-max-file-size="4m" data-show-remove="false">
			                      	</div>
			                    </div>

			                    <div class="form-group row mb-4">
			                      	<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
			                      	<div class="col-sm-12 col-md-7">
			                        	<button class="btn btn-primary" type="submit">Save</button>
			                      	</div>
			                    </div>
                    		</form>

		                </div>
		            </div>
		        </div>
		    </div>
        </div>
	</section>

@section('script')
	<script>
		
		var drEvent = $('#image').dropify();
		drEvent = drEvent.data('dropify');
		drEvent.settings.defaultFile = "{{ asset('image/thumbnail/'.$data->image) }}";
		drEvent.destroy();
		drEvent.init();

	</script>
@endsection

@endsection