@extends('layouts.main-dash')

@section('title','Jurusan')

@section('dash-content')

	<section class="section">
        <div class="section-header">
        	<h1>Jurusan</h1>
        </div>

        
        <div class="section-body">
            <h2 class="section-title">Tabel Jurusan</h2>
            <p class="section-lead">
              	Pada halaman ini anda bisa melakukan penambahan data jurusan dan melakukan aksi lainnya
            </p>

            <div class="card shadow">
                <div class="card-header">
                    <h4>Data Table</h4>
                    <div class="card-header-action">
                        <a href="{{ route('major.create') }}" class="btn btn-danger">Add More <i class="fas fa-plus"></i></a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive table-invoice">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-th"></i></th>
                                    <th>Jurusan</th>
                                    <th>Alias</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            @if(count($data) > 0)

                                @foreach($data as $field)

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $field->name }}</td>
                                    <td>{{ $field->alias }}</td>
                                    <td>
                                        <a href="{{ route('major.edit', $field) }}" class="btn btn-icon btn-primary"><i class="fas fa-pen"></i></a>
                                        <a href="{{ route('major.destroy', $field->id) }}" class="btn btn-icon btn-danger delete-btn"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>

                                @endforeach

                            @else

                                <tr class="text-center">
                                  <td colspan="4">No data found</td>
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