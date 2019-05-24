@extends('layouts.main-dash')

@section('title','Edit Jurusan')

@section('dash-content')
  <section class="section">
    <div class="section-header">
      <h1>Jurusan</h1>
    </div>

    
    <div class="section-body">
        <h2 class="section-title">Ubah Jurusan</h2>
        <p class="section-lead">
            Pada halaman ini anda bisa melakukan perubahan data jurusan
        </p>
    
      <div class="card">
      <form action="{{ route('major.update',$data) }}" method="post">
        @csrf @method('patch')
        <div class="card-header">
          <h4> Form <a href="{{ route('major.index') }}" class="btn btn-info ml-2"><i class="fas fa-arrow-left"></i> Kembali</a></h4>
        </div>
        <div class="card-body">
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Nama Jurusan</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="name" required="" placeholder="contoh: Rekayasa Perangkat Lunak" value="{{ $data->name }}">
              <div class="invalid-feedback">
                  Silahkan isi nama jurusan
              </div>
            </div>
          </div>
          <div class="form-group mb-0 row">
            <label class="col-sm-3 col-form-label">Alias</label>
            <div class="col-sm-9">
              <input type="text" class="form-control {{ $errors->any() ? 'is-invalid' : '' }}" name="alias" required="" placeholder="contoh: RPL" value="{{ $data->alias }}">
              <div class="invalid-feedback">
                  @foreach($errors->all() as $error)
                  {{ $error }}
                  @endforeach
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer text-right">
          <button class="btn btn-primary">Submit</button>
        </div>
      </form>
      </div>
    </div>
  </section>
@endsection