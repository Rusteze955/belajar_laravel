@extends('app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $title }}</h5>
                    <form action="{{ route('trans.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">No Pesanan *</label>
                                    <input type="text" name="order_code" type="text" class="form-control" readonly
                                        value="{{ $orderCode ?? '' }}">

                                    <div class="mt-3 mb-3">
                                        <label for="" class="form-lable">Pelanggan</label>
                                        <select name="id_customer" id="" class="form-control" required>
                                            <option value="">Pilih Pelanggan</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mt-3 mb-3">
                                        <label for="" class="form-lable">Paket</label>
                                        <select name="id_service" id="id_service" class="form-control">
                                            <option value="">Pilih Paket</option>
                                            @foreach ($services as $service)
                                                <option data-price="{{ $service->price }}" value="{{ $service->id }}">
                                                    {{ $service->service_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">End Order</label>
                                    <input type="date" name="order_end_date" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Catatan *</label>
                                    <textarea name="note" class="form-control" id="" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 mb-3">
                            <div align="right" class="mb-3">
                                <button type="button" class="btn btn-primary addRow" id="addRow">Tambah Row</button>
                            </div>
                            <table class="table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Paket</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <br>
                        <p><strong>Total: Rp. <span id="grandTotal">0</span></strong></p>
                        <input type="hidden" name="grand_total" id="grandTotalInput" value="0">
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
