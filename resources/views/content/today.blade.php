@extends('layouts.main-dash')

@section('dash-content')

	<section class="section">
        <div class="section-header">
        	  <h1>Kegiatan Hari ini</h1>
            <div class="ml-2">
                <a href="{{ route('today.date') }}" class="btn btn-outline-primary">Lihat jadwal per-tanggal</a>
            </div>
        	  <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Kegiatan</a></div>
                <div class="breadcrumb-item">Hari ini</div>
              </div>
        </div>

        <div class="section-body">
        	<today/>
        
        </div>
    </section>
@endsection