@extends('layouts.main-dash')

@section('dash-content')

	<section class="section">
        <div class="section-header">
          <div class="section-header-back">
              <a href="{{ route('today.list') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
          </div>
        	<h1>Semua Kegiatan</h1>
        	<div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Kegiatan</a></div>
              <div class="breadcrumb-item">Per-tanggal</div>
            </div>
        </div>

        <div class="section-body">
        	<today-date/>
        
        </div>
    </section>
@endsection