@extends('app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Create Service</h5>
                    <form action="" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Service Name *</label>
                            <input name="service_name" type="text" class="form-control" placeholder="Enter your name"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Price *</label>
                            <input name="price" type="number" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Description *</label>
                            <textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea>
                        </div>
                        <div class="mb-3">
                            <button name="save" type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
