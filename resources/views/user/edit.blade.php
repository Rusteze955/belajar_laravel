@extends('app')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">{{ $title }}</h3>
                    <form action="{{ route('user.update', $user->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="">Nama User *</label>
                            <input value="{{ $user->name }}" type="text" placeholder="Masukkan Nama Level"
                                name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="">Email *</label>
                            <input value="{{ $user->email }}" type="text" placeholder="Masukkan Nama Level"
                                name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="">Password *</label>
                            <input type="password" placeholder="Masukkan Password Baru" name="password"
                                class="form-control">
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
