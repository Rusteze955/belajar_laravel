@extends('app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $title }}</h5>
                    <form action="{{ route('customer.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Nama *</label>
                            <input name="name" type="text" class="form-control" placeholder="Enter your name"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Telp *</label>
                            <input name="phone" type="number" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Alamat *</label>
                            <textarea name="address" class="form-control" id="" cols="30" rows="10"></textarea>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
