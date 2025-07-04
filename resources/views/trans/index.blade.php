@extends('app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">{{ $title }}</h3>
                    <div class="mb-3" align="right">
                        <a href="{{ route('trans.create') }}" class="btn btn-primary">Tambah Order</a>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Pesanan</th>
                                <th>Pelanggan</th>
                                <th>Tanggal Selesai</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $index => $data)
                                <tr>
                                    <td>{{ $index += 1 }}</td>
                                    <td><a href="{{ route('trans.show', $data->id) }}">{{ $data->order_code }}</a></td>
                                    <td>{{ $data->customer->name }}</td>
                                    <td>{{ $data->order_end_date }}</td>
                                    <td>{{ $data->status_text }}</td>
                                    <td>
                                        <a href="{{ route('print_struk', $data->id) }}" class="btn btn-success">Print</a>
                                        <a href="{{ route('trans.show', $data->id) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('trans.destroy', $data->id) }}" method="post"
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
