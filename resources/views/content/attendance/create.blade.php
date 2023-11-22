@extends('layouts.main-dash')

@section('title','Tambah Absensi')

@section('dash-content')
  <section class="section">
    <div class="section-header">
      <h1>Absensi</h1>
    </div>


    <div class="section-body">
        <h2 class="section-title">Buat Absensi</h2>
        <p class="section-lead">
            Pada halaman ini anda bisa melakukan penambahan data absensi
        </p>

      <div class="card">
      <form action="{{ route('attendance.store') }}" method="post">
        @csrf
        <div class="card-header">
          <h4> Form <a href="{{ route('attendance.index') }}" class="btn btn-info ml-2"><i class="fas fa-arrow-left"></i> Kembali</a></h4>
        </div>
        <div class="card-body">
          <div class="form-group row">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Rombel</label>
            <div class="col-sm-12 col-md-7">
              <select name="rombel_id" class="form-control" required="">
                <option value="">- Pilih Rombel -</option>
                @foreach($rombels as $rombel)
                  <option value="{{ $rombel->id }}">{{ $rombel->alias }}</option>
                @endforeach
              </select>
            </div>
          </div>

          {{-- <div class="form-group mb-0 row">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jumlah siswa</label>
            <div class="col-sm-12 col-md-7">
              <input type="number" class="form-control" name="student_total" value="" max="999" min="1">

            </div>
          </div> --}}

          <div class="form-group row">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Siswa tidak masuk</label>
            <div class="col-sm-12 col-md-7">
              <input type="number" class="form-control" name="not_present" required="">
            </div>
          </div>


        </div>
        <div class="card-footer text-center">
          <button class="btn btn-primary">Submit</button>
        </div>
      </form>
      </div>
    </div>
  </section>

@endsection

