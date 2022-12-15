<div class="card">
    <div class="card-header">
        <h4>Tambah Penerimaan Barang</h4>
    </div>
    <div class="card-body">
        <form id="addItemReceipt" class="form">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="fv-row mb-3">
                        <label class="required form-label fw-bold">Nomor Purchase Order</label>
                        <select class="form-select  form-select-solid mb-3 mb-lg-0 select-2" name="purchase_order_id"
                            id="purchase_order_id" required>
                            <option>Pilih No PO</option>
                            @foreach ($purchase_orders as $po)
                                <option value="{{ $po->id }}">{{ $po->code }}-{{ $po->partnernya->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Kode Purchase Order</label>
                        <input type="text" id="code" name="code" readonly
                            class="form-control form-control-white mb-3 mb-lg-0" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Tanggal Order</label>
                        <input type="text" name="order_date" id="order_date" readonly
                            class="form-control form-control-white mb-3 mb-lg-0" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class=" form-label fw-bold">Partner</label>
                        <input type="text" name="partner" id="partner" readonly
                            class="form-control form-control-white mb-3 mb-lg-0" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Alamat</label>
                        <textarea type="text" name="address" id="address" readonly class="form-control form-control-white mb-3 mb-lg-0"></textarea>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Nomor Telepon</label>
                        <input type="text" name="phone" id="phone" readonly
                            class="form-control form-control-white mb-3 mb-lg-0" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Fax</label>
                        <input type="text" name="fax" id="fax" readonly
                            class="form-control form-control-white mb-3 mb-lg-0" required />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Nomor Pengiriman Barang</label>
                        <input type="text" name="do_number" id="do_number"
                            class="form-control form-control-solid mb-3 mb-lg-0" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Shipment</label>
                        <textarea name="shipment" id="shipment" class="form-control form-control-solid mb-3 mb-lg-0" required></textarea>
                    </div>
                    <div class="fv-row mb-3">
                        <div>
                            <label class="required fw-bold fs-6 mb-2">Tanggal Diterima</label>
                        </div>
                        <input type="text" name="receipt_date" id="receipt_date"
                            class="form-control form-control-solid mb-3 mb-lg-0" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Plat Nomor</label>
                        <input type="text" name="plate_number" id="plate_number"
                            class="form-control form-control-solid mb-3 mb-lg-0" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required form-label fw-bold">Status</label>
                        <select class="form-select  form-select-solid mb-3 mb-lg-0" name="status" required>
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>
                </div>
                <hr>
                <h5 class="fw-bolder">Items</h5>
                <hr>
                <div class="col-lg-12"id="itemsAddList">

                </div>
            </div>
            <hr>

            <div class="d-flex justify-content-center" id="loadingnya">
                <div class="px-2">
                    <button class="btn btn-sm btn-primary" type="submit" id="btn-add">Buat</button>
                </div>
                <div class="px-2">
                    <button class="btn btn-sm btn-secondary" onclick="tutupContent()" id="btn-add">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.select-2').select2();
        flatpickr("#receipt_date", {
            static: true,
            enableTime: true,
            dateFormat: "Y-m-d H:i:s",
            minuteIncrement: 1,
            time_24hr: true
        });
    });
</script>

<script>
    $('#purchase_order_id').on('change', function() {
        var id = $(this).val();
        $('#itemsAddList').html(
            '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')

        $.get("{{ url('/admin/procurement/items-receipt/getdatapo') }}/" + id, {}, function(data) {
            $('#code').val(data.code);
            $('#order_date').val(data.order_date);
            $('#partner').val(data.partner);
            $('#address').val(data.address);
            $('#phone').val(data.phone);
            $('#fax').val(data.fax);
            $('#itemsAddList').html(data.html);
        })

    })




    $('#addItemReceipt').submit(function(event) {
        event.preventDefault();

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Save This Data ?',
            text: "Data will be save to the database!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Save!',
            cancelButtonText: 'Not, Cancel!',
            reverseButtons: false
        }).then((result) => {
            if (result.isConfirmed) {
                $('#loadingnya').html(
                    '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span>'
                    )
                $.ajax({
                    url: "{{ url('/admin/procurement/items-receipt/store') }}",
                    type: 'post',
                    data: $('#addItemReceipt')
                        .serialize(), // Remember that you need to have your csrf token included
                    dataType: 'json',
                    success: function(response) {
                        Swal.fire(
                            'Success',
                            response.success,
                            'success'
                        )
                        $('#content').hide();
                        $('#indexContent').show();
                        $('#searchTableItemsReceipt').focus()
                        tableItemsReceipt.ajax.reload()
                    },
                    error: function(response) {
                        // Handle error
                    }
                });

            } else if (

                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    '',
                    'success'
                )
            }
        })

    });

    function balanceEdit(e) {
        var order_qty = $(e).parent().parent().find('#nowBalance').val();
        var qty = $(e).val();

        $(e).parent().parent().find('#balance').val(order_qty - qty);

    }
</script>
