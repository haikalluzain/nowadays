@extends('layouts.main-dash')

@section('title','Absensi')

@section('dash-content')

    <?php 
        $route = Route::currentRouteName();
    ?>

	<section class="section">
        <div class="section-header">
        	<h1>Absensi</h1>
        </div>

        
        <div class="section-body">
            <h2 class="section-title">Tabel Absensi</h2>
            <p class="section-lead">
              	Pada halaman ini anda bisa melihat data absensi dan melakukan aksi lainnya
            </p>

            <div class="card shadow">
                <div class="card-header">
                    <h4>Absen hari ini, {{ Date::now()->format('j F Y') }} <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle ml-2" aria-expanded="false">Filter</a>
                    <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-left">
                      <li class="dropdown-title">Pilih data</li>
                      <li><a href="{{ route('attendance.index') }}" class="dropdown-item {{ $route == 'attendance.index' ? 'active' : '' }}">Hari ini</a></li>
                      <li><a href="{{ route('attendance.all') }}" class="dropdown-item {{ $route == 'attendance.all' ? 'active' : '' }}">Semua data</a></li>
                    </ul> 
                    </h4>
                    <div class="card-header-action">
                        <a href="{{ route('attendance.create') }}" class="btn btn-danger">Add More <i class="fas fa-plus"></i></a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive table-invoice">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-th"></i></th>
                                    <th>Rombel</th>
                                    <th>Hadir</th>
                                    <th>Tidak hadir</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            @if(count($data) > 0)

                                @foreach($data as $field)

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $field->rombel->alias }}</td>
                                    <td>{{ $field->rombel->student_total - $field->not_present }}</td>
                                    <td>{{ $field->not_present }}</td>
                                    <td>
                                        {{-- <a href="{{ route('attendance.edit', $field) }}" class="btn btn-icon btn-primary"><i class="fas fa-pen"></i></a> --}}
                                        <a href="{{ route('attendance.destroy', $field->id) }}" class="btn btn-icon btn-danger delete-btn"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>

                                @endforeach

                            @else

                                <tr class="text-center">
                                  <td colspan="5">No data found</td>
                                </tr>

                            @endif


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
	</section>

@endsection