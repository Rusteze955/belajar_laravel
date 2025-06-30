@extends('app')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">{{ $title }}</h3>
                    <div class="mb-3" align="right">
                        <a href="{{ route('level.create') }}" class="btn btn-primary">Tambah Level</a>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $index => $data)
                                <tr>
                                    <td>{{ $index += 1 }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>
                                        <a href="{{ route('level.edit', $data->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('level.destroy', $data->id) }}" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
