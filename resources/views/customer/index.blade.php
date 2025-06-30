@extends('app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">{{ $title }}</h3>
                    <div class="mb-3" align="right">
                        <a href="{{ route('customer.create') }}" class="btn btn-primary">Tambah Customer</a>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Telp</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $index => $data)
                                <tr>
                                    <td>{{ $index += 1 }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->phone }}</td>
                                    <td>{{ $data->address }}</td>
                                    <td>
                                        <a href="{{ route('customer.edit', $data->id) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('customer.destroy', $data->id) }}" method="post"
                                            style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin ingin dihapus?')"
                                                class="btn btn-danger">Delete</button>
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
