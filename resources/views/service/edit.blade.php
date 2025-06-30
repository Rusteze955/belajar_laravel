@extends('app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $title }}</h5>
                    <form action="{{ route('service.update', $edit->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="" class="form-label">Service Name *</label>
                            <input name="service_name" type="text" class="form-control" value="{{ $edit->service_name }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Price *</label>
                            <input name="price" type="number" class="form-control" value="{{ $edit->price }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Description *</label>
                            <textarea name="description" class="form-control" id="" cols="30" rows="5">{{ $edit->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-success">Save</button>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
