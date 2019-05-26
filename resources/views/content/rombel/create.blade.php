@extends('layouts.main-dash')

@section('title','Tambah Rombel')

@section('dash-content')
  <section class="section">
    <div class="section-header">
      <h1>Rombel</h1>
    </div>

    
    <div class="section-body">
        <h2 class="section-title">Buat Rombel</h2>
        <p class="section-lead">
            Pada halaman ini anda bisa melakukan penambahan data rombel
        </p>
    
      <div class="card">
      <form action="{{ route('rombel.store') }}" method="post">
        @csrf
        <div class="card-header">
          <h4> Form <a href="{{ route('rombel.index') }}" class="btn btn-info ml-2"><i class="fas fa-arrow-left"></i> Kembali</a></h4>
        </div>
        <div class="card-body">
          <div class="form-group row">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jurusan</label>
            <div class="col-sm-12 col-md-7">
              <select name="major_id" class="form-control" id="major">
                <option value="">- Pilih Jurusan -</option>
                @foreach($majors as $major)
                  <option value="{{ $major->id }}">{{ $major->alias }} - {{ $major->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tingkat</label>
            <div class="col-sm-12 col-md-7">
              <select name="grade" class="form-control" id="grade">
                <option value="">- Pilih Tingkat -</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Rombel</label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control" id="rombel" disabled="" value="">

              <span class="text-small">
                * Nama rombel akan otomatis terbuat sesuai jurusan dan tingkat yang telah dipilih 
              </span>
            </div>
            
          </div>

          <div class="form-group mb-0 row">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jumlah siswa</label>
            <div class="col-sm-12 col-md-7">
              <input type="number" class="form-control" name="student_total" value="" max="999" min="1">

            </div>
            
          </div>
        </div>
        <div class="card-footer text-center">

          <input type="hidden" id="code" name="code">
          <input type="hidden" id="alias" name="alias">
          <button class="btn btn-primary">Submit</button>
        </div>
      </form>
      </div>
    </div>
  </section>

@endsection

@section('script')
  <script>
    $('#grade').change(function() {
      var grade = $(this).val();
      var major = $('#major').val();
      if(major != '' && grade != ''){
        $.ajax({
            url: "{{ url('/api/rombel/check') }}",
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: {
                major_id: major,
                grade: grade,
            },
              success: function(result){
                  $('#rombel').val(result.rombel)
                  $('#alias').val(result.rombel)
                  $('#code').val(result.code)
                  
            }
        });
      }
    });

    $('#major').change(function() {
      var grade = $('#grade').val();
      var major = $(this).val();
      if(grade != '' && major != ''){
        $.ajax({
            url: "{{ url('/api/rombel/check') }}",
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: {
                major_id: major,
                grade: grade,
            },
              success: function(result){
                  $('#rombel').val(result.rombel)
                  $('#alias').val(result.rombel)
                  $('#code').val(result.code)
                  
            }
        });
      }
    });
  </script>
@endsection

