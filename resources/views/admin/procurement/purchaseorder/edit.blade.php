<div class="card">
    <div class="card-header">
        <h4>Perbarui Purchase Order</h4>
    </div>
    <div class="card-body">
        <form id="edit-form" class="form">
            @csrf
            <input type="hidden" name="id_po" value="{{ $ponya[0]->id_po }}">

            <div class="row">
                <div class="col-lg-6">
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Nomor Purchase Order</label>
                        <input type="text" id="code" name="code" value="{{ $ponya[0]->number_po }}" readonly
                            class="form-control form-control-transparent mb-3 mb-lg-0" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required form-label fw-bold fs-6 mb-2">Partner</label>
                        <select class="form-select  form-select-transparent mb-3 mb-lg-0 select-2" disabled id="partner_id"
                            name="partner_id">
                            <option>{{ $ponya[0]->partner_name }}</option>
                        </select>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Alamat</label>
                        <textarea type="text" name="address" id="address" readonly
                            class="form-control form-control-transparent mb-3 mb-lg-0">{{ $ponya[0]->address }}</textarea>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Nomor Telepon</label>
                        <input type="text" name="phone" id="phone" value="{{ $ponya[0]->phone }}" readonly
                            class="form-control form-control-transparent mb-3 mb-lg-0" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Fax</label>
                        <input type="text" name="fax" value="{{ $ponya[0]->fax }}" id="fax" readonly
                            class="form-control form-control-transparent mb-3 mb-lg-0" required />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Vat/PPN</label>
                        <input type="number" name="ppn" id="ppn" onkeyup='sumAll()'
                            value="{{ $ponya[0]->ppn }}" class="form-control form-control-transparent mb-3 mb-lg-0"
                            required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required form-label fw-bold fs-6 mb-2">Mata Uang</label>
                        <select class="form-select  form-select-transparent mb-3 mb-lg-0 select-2"
                            onchange="getRate(this.value)" name="currency_id" id="currency_id" required>
                            @foreach ($currency as $currency)
                                <option value="{{ $currency->id }}"
                                    {{ $currency->id == $ponya[0]->currency_id ? 'selected' : '' }}>
                                    {{ $currency->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Rate</label>
                        <input type="number" name="rate" id="rate" value="{{ $ponya[0]->rate }}" readonly
                            class="form-control form-control-transparent mb-3 mb-lg-0" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required form-label fw-bold fs-6 mb-2">Jangka Waktu Pembayaran</label>
                        <select class="form-select  form-select-transparent mb-3 mb-lg-0 select-2" name="term_of_payment"
                            id="term_of_payment" required>
                            <option value="Cash" {{ $ponya[0]->term_of_payment === 'Cash' ? 'selected' : '' }}>Cash
                            </option>
                            <option value="15" {{ $ponya[0]->term_of_payment === '15' ? 'selected' : '' }}>15 Hari
                            </option>
                            <option value="30" {{ $ponya[0]->term_of_payment === '30' ? 'selected' : '' }}>30 Hari
                            </option>
                            <option value="45" {{ $ponya[0]->term_of_payment === '45' ? 'selected' : '' }}>45 Hari
                            </option>
                            <option value="60" {{ $ponya[0]->term_of_payment === '60' ? 'selected' : '' }}>60 Hari
                            </option>
                            <option value="90" {{ $ponya[0]->term_of_payment === '90' ? 'selected' : '' }}>90 Hari
                            </option>
                            <option value="other" {{ $ponya[0]->term_of_payment === 'other' ? 'selected' : '' }}>
                                Lainnya
                            </option>
                        </select>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Deskripsi</label>
                        <textarea type="text" name="description" id="description" class="form-control form-control-transparent mb-3 mb-lg-0"
                            required>{{ $ponya[0]->description }}</textarea>
                    </div>
                    <div class="fv-row mb-3">
                        <div>
                            <label class="fw-bold fs-6 mb-2">Tanggal Order</label>
                        </div>
                        <input type="text" name="order_date" id="order_date" value="{{ $ponya[0]->order_date }}"
                            class="form-control form-control-transparent mb-3 mb-lg-0" required />
                    </div>
                </div>
                <div class="col-lg-12"id="itemsAddList">
                    <h5 class="fw-bolder">Items</h5>
                    <hr class="border border-dark border-2 opacity-50">

                    @foreach ($ponya as $s_item)
                        <div class="row">
                            <div class="fv-row mb-3 col-lg-4">
                                <label class="required form-label fw-bold fs-6 mb-2">Item </label>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <input type="hidden" name="idonpoitems[]" value="{{ $s_item->po_item_id }}">
                                        <select class="form-select  form-select-transparent mb-3 mb-lg-0 item_id select-2 "
                                            id="item_id" name="item_id[]" onchange="getBaseQty(this)" required>
                                            @foreach ($items as $listitem)
                                                <option value="{{ $listitem->id }}"
                                                    {{ $s_item->item_id == $listitem->id ? 'selected' : '' }}>
                                                    {{ $listitem->item_code }}-{{ $listitem->item_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-2">
                                        <button onclick="getallitem(this)" type="button"
                                            class="btn btn-sm btn-primary">All</button>
                                    </div>
                                </div>
                            </div>
                            <div class='fv-row mb-3 col-lg-1' id='base_qty_parent'>
                                <label class='fw-bold fs-6 mb-2'>Base Qty</label>
                                <input type='number' name='base_qty' id='base_qty'
                                    class='form-control form-control-transparent mb-3 mb-lg-0' value='{{ $s_item->base_qty }}' readonly />
                            </div>
                            <div class="fv-row mb-3 col-lg-1">
                                <label class="required fw-bold fs-6 mb-2">Qty</label>
                                <input type="number" name="qty[]" id="qty" value="{{ $s_item->qty }}"
                                    onkeyup="hitungByQty(this)"
                                    class="form-control form-control-transparent mb-3 mb-lg-0 qty" required />
                            </div>
                            <div class="fv-row mb-3 col-lg-1" id="discount_parent">
                                <label class="required fw-bold fs-6 mb-2">Diskon</label>
                                <input type="number" name="discount[]" id="discount"
                                    value="{{ $s_item->discount }}" onkeyup="hitungByDiscount(this)"
                                    class="form-control form-control-transparent mb-3 mb-lg-0 discount" required />
                            </div>
                            <div class='fv-row mb-3 col-lg-2' id='price_parent'>
                                <label class='required fw-bold fs-6 mb-2'>Harga</label>
                                <input type='number' name='price[]' id='price' onkeyup='hitungByPrice(this)'
                                    value="{{ $s_item->unit_price }}"
                                    class='form-control form-control-transparent mb-3 mb-lg-0'
                                    placeholder='$itemprice->base_price' required />
                                <p id='notifprice'>Tulis Kembali harga untuk konfirmasi</p>
                            </div>
                            <div class="fv-row mb-3 col-lg-2">
                                <label class="required fw-bold fs-6 mb-2">Total</label>
                                <input type="number" name="total[]" id="total"
                                    value="{{ $s_item->total_price }}" readonly
                                    class="form-control form-control-transparent mb-3 mb-lg-0 totalnya" required />
                                <input type="hidden" name="getdiscountperitem[]"
                                    value="{{ $s_item->total_discount }}" id="getdiscountperitem" readonly
                                    class="form-control form-control-transparent mb-3 mb-lg-0 getdiscountperitem" required />
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <hr class="border border-dark border-2 opacity-50">
            <div class="d-flex justify-content-end py-2">
                <div class="row">
                    <div class="col-lg-6">Subtotal</div>
                    <div class="col-lg-6"><input type="text" name="subtotal" readonly id="subtotal"
                            class="form-control form-control-transparent text-end"></div>
                </div>
            </div>
            <div class="d-flex justify-content-end py-2">
                <div class="row">
                    <div class="col-lg-6">Diskon</div>
                    <div class="col-lg-6"><input type="text" name="totaldiscount" readonly id="totaldiscount"
                            class="form-control form-control-transparent text-end"></div>
                </div>
            </div>
            <div class="d-flex justify-content-end py-2">
                <div class="row">
                    <div class="col-lg-6">Taxable</div>
                    <div class="col-lg-6"><input type="text" name="taxable" readonly id="taxable"
                            class="form-control form-control-transparent text-end"></div>
                </div>
            </div>
            <div class="d-flex justify-content-end py-2">
                <div class="row">
                    <div class="col-lg-6">Vat/PPn</div>
                    <div class="col-lg-6"><input type="text" name="totalppn" readonly id="totalppn"
                            class="form-control form-control-transparent text-end"></div>
                </div>
            </div>
            <hr class="border border-dark border-2 opacity-50">
            <div class="d-flex justify-content-end py-2">
                <div class="row">
                    <div class="col-lg-6">Grand Total</div>
                    <div class="col-lg-6"><input type="text" name="grandtotal" readonly id="grandtotal"
                            class="form-control form-control-transparent text-end"></div>
                </div>
            </div>
            <hr class="border border-dark border-2 opacity-50">

            <div class="d-flex justify-content-center" id="loadingnya">
                <div class="px-2">
                    <button class="btn btn-sm btn-primary" type="submit" id="btn-update">Perbarui Purchase
                        Order</button>
                </div>
                <div class="px-2">
                    <button class="btn btn-sm btn-secondary" type="button" onclick="tutupContent()">Kembali</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.select-2').select2({

        });

        flatpickr("#order_date", {
            static: true,
            enableTime: true,
            dateFormat: "Y-m-d H:i:s",
            time_24hr: true,
            allowInput:true
        });

    });
</script>


<script>
    sumAll()

    $('#partner_id').on('change', function() {
        $('#item_id').html("<option>Loading....</option>")
        $.get("{{ url('/admin/procurement/purchase-order/getitem') }}/" + $('#partner_id').val(), {}, function(
            data) {
            $('#item_id').html(data.html)
            $('#address').val(data.address)
            $('#phone').val(data.phone)
            $('#fax').val(data.fax)
            $('#base_qty_parent').remove()
            $('#price_parent').remove()
        })
    })

    function getallitem(e) {
        $.get("{{ url('/admin/procurement/purchase-order/getallitem') }}", {}, function(data) {
            $(e).parent().parent().find('#item_id').html(data.html);
            $(e).parent().html(
                "<button onclick='backitem(this)' type='button' id='getbackitem' class='btn btn-sm btn-success'>Back</button>"
            );
        })
    }

    function backitem(e) {
        var partnerId = $('#partner_id').val();
        var check = $.isNumeric(partnerId);
        if (check) {
            $.get("{{ url('/admin/procurement/purchase-order/getitem') }}/" + partnerId, {}, function(data) {
                $(e).parent().parent().find('#item_id').html(data.html);
                $(e).parent().html(
                    "<button onclick='getallitem(this)' type='button' class='btn btn-sm btn-success'>All</button>"
                );
            })
        } else {
            $(e).parent().parent().find('#item_id').html("<option>Choose Partner First</option>");
            $(e).parent().html(
                "<button onclick='getallitem(this)' type='button' class='btn btn-sm btn-success'>All</button>");
        }
    }

    function getBaseQty(e) {
        $.get("{{ url('/admin/procurement/purchase-order/getbaseqty') }}/" + e.value, {}, function(data) {
            $(e).parent().parent().parent().parent().find('#price_parent').remove();
            $(e).parent().parent().parent().parent().find('#base_qty_parent').remove();
            $(e).parent().parent().parent().after(
                "<div class='fv-row mb-3 col-lg-1' id='base_qty_parent'><label class='fw-bold fs-6 mb-2'>Base Qty</label><input type='number' name='base_qty' id='base_qyu' class='form-control form-control-transparent mb-3 mb-lg-0' value='" +
                data.base_qty + "' readonly/></div>");
            $(e).parent().parent().parent().parent().find('#discount_parent').after(data.pricing)
        })
    }

    function getRate(e) {
        $.get("{{ url('/admin/procurement/purchase-order/getcurrency') }}/" + e, {}, function(data) {
            $('#rate').val(data.rate)
        })
    }


    function hitungByDiscount(e) {
        let qty = $(e).parent().parent().find('#qty').val();
        let discount = e.value;
        let price = $(e).parent().parent().find('#price').val();
        if (typeof price == "undefined") {
            price = 0;
        }
        let total = (parseFloat(qty) * parseFloat(price)) - ((parseFloat(qty) * parseFloat(price)) * (parseFloat(
            discount) / 100));
        $(e).parent().parent().find('#total').val(total);
        let getdiscountperitem = ((parseFloat(qty) * parseFloat(price)) * (parseFloat(discount) / 100));
        $(e).parent().parent().find('#total').val(total);
        $(e).parent().parent().find('#getdiscountperitem').val(getdiscountperitem);
        sumAll()
    }

    function hitungByQty(e) {
        let qty = e.value;
        let discount = $(e).parent().parent().find('#discount').val();
        let price = $(e).parent().parent().find('#price').val();
        if (typeof price == "undefined") {
            price = 0;
        }
        let getdiscountperitem = ((parseFloat(qty) * parseFloat(price)) * (parseFloat(discount) / 100));
        let total = (parseFloat(qty) * parseFloat(price)) - ((parseFloat(qty) * parseFloat(price)) * (parseFloat(
            discount) / 100));
        $(e).parent().parent().find('#total').val(total);
        $(e).parent().parent().find('#getdiscountperitem').val(getdiscountperitem);
        sumAll()
    }

    function hitungByPrice(e) {
        // if(e.value.length >0){
        //     $(e).closest('#notifprice').hide()
        // }
        let qty = $(e).parent().parent().find('#qty').val();
        let discount = $(e).parent().parent().find('#discount').val();
        let price = e.value;
        if (typeof price == "undefined") {
            price = 0;
        }
        let getdiscountperitem = ((parseFloat(qty) * parseFloat(price)) * (parseFloat(discount) / 100));
        let total = (parseFloat(qty) * parseFloat(price)) - ((parseFloat(qty) * parseFloat(price)) * (parseFloat(
            discount) / 100));
        $(e).parent().parent().find('#total').val(total);
        $(e).parent().parent().find('#getdiscountperitem').val(getdiscountperitem);

        sumAll()

    }

    function sumAll() {
        let taxable = 0;
        let totalppn = 0;
        let totaldiscount = 0;
        let subtotal = 0;
        let grandtotal = 0;
        if ($('.totalnya').length > 1) {
            $('.totalnya').each(function() {
                taxable += parseFloat($(this).val());
            });
        } else {
            taxable = $('.totalnya').val()
        }

        if ($('.getdiscountperitem').length > 1) {
            $('.getdiscountperitem').each(function() {
                totaldiscount += parseFloat($(this).val());
            });
        } else {
            totaldiscount = $('.getdiscountperitem').val()
        }

        subtotal = parseFloat(taxable) + parseFloat(totaldiscount);

        $('#subtotal').val(subtotal);

        totalppn = parseFloat($('#ppn').val() * taxable / 100);

        grandtotal = parseFloat(taxable) + parseFloat(totalppn);

        $('#grandtotal').val(grandtotal);

        $('#totalppn').val(totalppn);
        $('#totaldiscount').val(totaldiscount);
        $('#taxable').val(taxable);
    }


    $('#edit-form').submit(function(event) {
        event.preventDefault();


        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Perbarui data PO?',
            text: "Pastikan Semua Kolom Diisi dengan benar",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya!',
            cancelButtonText: 'No!',
            reverseButtons: false
        }).then((result) => {
            if (result.isConfirmed) {
                $('#loadingnya').html(
                    '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span>'
                    )
                $.ajax({
                    url: "{{ url('/admin/procurement/purchase-order/update') }}",
                    type: 'POST',
                    data: $('#edit-form')
                        .serialize(), // Remember that you need to have your csrf token included
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Success',
                                response.success,
                                'success'
                            )
                        } else {
                            Swal.fire(
                                'error',
                                response.fail,
                                'error'
                            )

                        }
                        $('#content').hide();
                        $('#indexContent').show();
                        $('#searchTablePo').focus()
                        tablePo.ajax.reload()
                    },
                    error: function(response) {
                        // Handle error
                    }
                });

            } else if (

                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Dibatalkan',
                    '',
                    'success'
                )
            }
        })

    });
</script>
