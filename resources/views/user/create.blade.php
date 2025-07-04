@extends('app')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">{{ $title }}</h3>
                    <form action="{{ route('user.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="">Nama *</label>
                            <input type="text" placeholder="Masukkan Nama Anda" name="name" class="form-control"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="">Email *</label>
                            <input type="email" placeholder="Masukkan Email Anda" name="email" class="form-control"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="">Password *</label>
                            <input type="password" placeholder="Masukkan Password Anda" name="password" class="form-control"
                                required>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
