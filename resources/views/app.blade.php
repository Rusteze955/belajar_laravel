<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{ $title ?? '' }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    @include('inc.css');


</head>

<body>
    @include('sweetalert::alert')
    <!-- ======= Header ======= -->
    @include('inc.header');

    <!-- ======= Sidebar ======= -->
    @include('inc.sidebar');
    <!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Blank Page</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Pages</li>
                    <li class="breadcrumb-item active">Blank</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="content">
            @yield('content')
        </div>


    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    @include('inc.footer');
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    @include('inc.js');
    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

    <script>
        // var, let, const
        // var : ketika nilainya tidak ada, maka tidak ada error
        // let : harus mempunyai nilai
        // const :isi nya tidak boleh berubah
        // const button = document.getElementById('addRow');
        // const button = document.getElementsByClassName('addRow');
        const button = document.querySelector('.addRow');
        const tbody = document.querySelector('#myTable tbody');
        const select = document.querySelector('#id_service');
        // button.textContent = "duar";
        // button.style.color = "red";
        const grandTotal = document.getElementById('grandTotal');
        const grandTotalInput = document.getElementById('grandTotalInput');
        const orderPay = document.getElementById('order_pay');
        const orderChange = document.getElementById('order_change');
        const orderChangeDisplay = document.getElementById('order_change_display');
        const totalInput = document.getElementById('totalInput');

        let no = 1;
        button.addEventListener("click", function() {

            const selectedService = select.options[select.selectedIndex];
            const serviceValue = selectedService.value;
            if (!serviceValue) {
                alert('select service require');
                return;
            }
            const serviceName = selectedService.textContent;
            const servicePrice = selectedService.dataset.price;

            const tr = document.createElement('tr'); //<tr></tr>
            tr.innerHTML = `
            <td>${no}</td>
            <td><input type='hidden' name='id_service[]' class='id_services' value='${select.value}'>${serviceName}</td>
            <td>
                <input type='number' name='qty[]' value='1' class='qtys' step='any'>
                <input type='hidden' class='priceInput' name='price[]' value='${servicePrice}'>
            </td>
            <td><input type='hidden' name='total[]' class='totals' value='${servicePrice}'><span class='totalText'>${servicePrice}</span></td>
            <td><button class='btn btn-danger btn-sm removeRow' type='button'>Delete</button></td>`;

            tbody.appendChild(tr);
            updateGrandTotal();
            no++;

            select.value = "";


        });

        tbody.addEventListener('click', function(e) {
            if (e.target.classList.contains('removeRow')) {
                e.target.closest("tr").remove();
            }

            updateNumber();
            updateGrandTotal();

        });

        tbody.addEventListener('input', function(e) {
            if (e.target.classList.contains('qtys')) {
                const row = e.target.closest('tr');
                const qty = parseFloat(e.target.value) || 0;
                // qty kg / 1000
                // const convertQty = parseFloat(qty / 1000) || 0;


                const price = parseInt(row.querySelector('[name="price[]"]').value);
                row.querySelector('.totalText').textContent = price * qty;
                row.querySelector('.totals').value = price * qty;
                updateGrandTotal();

            }
        });

        function updateNumber() {
            const rows = tbody.querySelectorAll('tr');
            rows.forEach(function(row, index) {
                row.cells[0].textContent = index + 1;
            });

            no = rows.length + 1;
        }

        function updateGrandTotal() {
            const totalCells = tbody.querySelectorAll('.totals');
            let grand = 0;
            totalCells.forEach(function(input) {
                grand += parseInt(input.value) || 0;
            });
            grandTotal.textContent = grand.toLocaleString('id-ID');
            grandTotalInput.value = grand;
        }
    </script>
    <script>
        function updateOrderChange() {
            // kembali = bayar - total
            const pay = parseInt(orderPay.value) || 0;
            const total = parseInt(totalInput.value) || 0;

            const change = pay - total;
            orderChangeDisplay.value = change.toLocaleString('id-ID');
            orderChange.value = change;
        }

        orderPay.addEventListener('input', updateOrderChange);
    </script>

    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ env('MIDTRANS-CLIENT-KEY') }}"></script>
    <script>
        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = e.target;
            const method = form.querySelector('[name="payment_method"]:checked, [name="payment_method"]:focus')
                ?.value;

            const data = {
                order_pay: document.getElementById('order_pay').value,
                order_change: document.getElementById('order_change').value,
                payment_method: method,
                _token: '{{ csrf_token() }}'
            };

            const orderId = form.dataset.orderId;

            if (method === 'cash') {
                form.submit();
            } else {
                fetch(`/trans/${orderId}/snap`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': data._token
                        },
                        body: JSON.stringify(data)
                    })
                    .then(res => res.json())
                    .then(res => {
                        if (res.token) {
                            snap.pay(res.token, {
                                onSuccess: function(result) {
                                    window.location.href = `trans`;
                                },
                                onPending: function(result) {
                                    alert("Silakan selesaikan pembayaran anda.");
                                },
                                onError: function(result) {
                                    alert("Terjadi kesalahan");
                                }
                            });
                        } else {
                            alert("Gagal ambil token pembayaran")
                        }
                    });
            }
        });
    </script>
</body>

</html>
