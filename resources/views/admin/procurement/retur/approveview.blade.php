<div class="card">
    <div class="card-header">
        <h4>Info Retur</h4>
    </div>
    <div class="card-body">
        <form>
            {{-- @csrf --}}
            <div class="row">
                <div class="col-lg-6">
                    <div class="fv-row mb-3">
                        <input type="hidden" name="id_return" value="{{ $data[0]->id_return }}">
                        <label class="required form-label fw-bold">No Invoice</label>
                        <select class="form-select  form-select-solid mb-3 mb-lg-0 select-2" name="id_invoice"
                            id="id_invoice">
                            <option value="{{ $data[0]->id_invoice }}">
                                {{ $data[0]->invoice_number }}-{{ $data[0]->name }}
                            </option>
                        </select>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Date Purchase Order</label>
                        <input type="text" name="order_date" id="order_date" readonly
                            class="form-control form-control-white mb-3 mb-lg-0" value="{{ $data[0]->order_date }}"
                            required />
                    </div>
                    <div class="fv-row mb-3">
                        <input type="hidden" name="po_id" id="po_id">
                        <label class=" form-label fw-bold">Partners</label>
                        <input type="text" name="partner" value="{{ $data[0]->name }}" id="partner" readonly
                            class="form-control form-control-white mb-3 mb-lg-0" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Address</label>
                        <textarea type="text" name="address" id="address" readonly class="form-control form-control-white mb-3 mb-lg-0">{{ $data[0]->address }}</textarea>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Phone Number</label>
                        <input type="text" name="phone" value="{{ $data[0]->phone }}" id="phone" readonly
                            class="form-control form-control-white mb-3 mb-lg-0" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Att</label>
                        <input type="text" name="att" id="att" value="{{ $data[0]->attention }}" readonly
                            class="form-control form-control-white mb-3 mb-lg-0" />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="fw-bold fs-6 mb-2">Fax</label>
                        <input type="text" id="fax" value="{{ $data[0]->fax }}" readonly
                            class="form-control form-control-white mb-3 mb-lg-0" required />
                    </div>
                </div>
                <div class="col-lg-6">

                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Ship From</label>
                        <textarea id="shipment"  class="form-control form-control-solid mb-3 mb-lg-0" readonly
                            required>{{ $data[0]->shipment }}</textarea>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Vat/PPN</label>
                        <input type="text" value="{{ $data[0]->ppn }}" id="vat"
                            class="form-control form-control-solid mb-3 mb-lg-0" readonly required />
                    </div>

                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Email</label>
                        <input type="text" id="email" class="form-control form-control-solid mb-3 mb-lg-0"
                            value="-" readonly required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Telp/Fax</label>
                        <input type="text" id="telp/fax" class="form-control form-control-solid mb-3 mb-lg-0"
                            value="0837263723" readonly required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Term Of Payment</label>
                        <input type="text" id="term_of_payment" value="{{ $data[0]->term_of_payment }}"
                            name="term_of_payment" class="form-control form-control-solid mb-3 mb-lg-0" readonly
                            required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Decription</label>
                        <textarea id="description" name="description" class="form-control form-control-solid mb-3 mb-lg-0" readonly required>{{ $data[0]->description }}</textarea>

                    </div>

                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Retur Date</label>
                        <div class="">
                            <input type="text" name="retur_date" readonly id="retur_date" value="{{ $data[0]->retur_date }}"
                                class="form-control form-control-solid mb-3 mb-lg-0" required />
                        </div>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Description Retur</label>
                        <textarea name="description_retur" readonly id="description_retur" class="form-control form-control-solid mb-3 mb-lg-0"
                            required>{{ $data[0]->notes }}</textarea>
                    </div>


                </div>
                <hr>
                <h5 class="fw-bolder">Items</h5>
                <hr>
                <div class="col-lg-12"id="itemsList">
                    @foreach ($data as $item)
                    <div class='row'>
                            <div class='fv-row mb-3 col-lg-2'>
                                <input type="hidden" name="id_item_return[]" value="{{ $item->id_item_return }}">
                                <label class=' form-label fw-bold'>Item</label>
                                <select class='form-select  form-select-white mb-3 mb-lg-0' id='item_id'
                                    name='item_id[]' required>
                                    <option value='{{ $item->item_id }}'>{{ $item->item_name }}</option>
                                </select>
                            </div>
                            <div class='fv-row mb-3 col-lg-2'>
                                <label class='required fw-bold fs-6 mb-2'>Retur</label>
                                <input type='number' name='qty_retur[]' id='qty_retur' readonly value='{{ $item->qty_return }}'
                                    class='form-control form-control-solid mb-3 mb-lg-0 ' required />
                            </div>
                            <div class='fv-row mb-3 col-lg-2'>
                                <label class=' fw-bold fs-6 mb-2'>Qty Receipt</label>
                                <input type='number' name='qty_receipt[]' id='qty_receipt'
                                    value='{{ $item->qty_receipt }}' readonly
                                    class='form-control form-control-white mb-3 mb-lg-0 ' required />
                            </div>

                            <div class='fv-row mb-3 col-lg-2'>
                                <label class='required fw-bold fs-6 mb-2'>Unit Price</label>
                                <input type='number' name='unit_price[]' id='unit_price' value='{{ $item->unit_price }}'
                                    readonly class='form-control form-control-solid mb-3 mb-lg-0 ' required />
                            </div>

                            <div class='fv-row mb-3 col-lg-1'>
                                <label class='required fw-bold fs-6 mb-2'>Discount</label>
                                <input type='number' name='discount[]' id='discount' value='{{ $item->discount }}'
                                    readonly class='form-control form-control-solid mb-3 mb-lg-0 ' required />
                            </div>
                            <div class='fv-row mb-3 col-lg-2'>
                                <label class='required fw-bold fs-6 mb-2'>Total</label>
                                <input type='text' name='total[]' id='total' readonly
                                    class='form-control form-control-solid mb-3 mb-lg-0 descriptionnya'
                                    value='{{ $item->price }}' />
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <hr>

            <div class="d-flex justify-content-center" id="loadingnya">
                <div class="px-2">
                    <a class="btn btn-sm btn-primary" href="/admin/procurement/retur/approve/{{ $data[0]->id_return }}"  id="btn-confirm">Approve</a>
                </div>
                <div class="px-2">
                    <button class="btn btn-sm btn-danger" type="button" >Reject</button>
                </div>
                <div class="px-2">
                    <button class="btn btn-sm btn-secondary" type="button" onclick="tutupContent()">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>


$('#btn-confirm').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Seriously Approve this data ?',
            text: "The data will be approved if you click yes!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'Not',
            reverseButtons: false
        }).then((result) => {
            if (result.isConfirmed) {
                $('#content').hide();
                $('#indexContent').show();
                $('#searchtableRetur').focus()
                $('#loading-add').html(
                    '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>'
                )
                $.ajax({
                    type: "GET",
                    url: href,
                    success: function(response) {
                        Swal.fire(
                            'Success',
                            response.success,
                            'success'
                        )
                        tableRetur.ajax.reload(null, false);
                        $('#loading-add').html(
                            '<button type="button" class="btn btn-primary me-3" onclick="create()">Create retur</button>'
                        )
                    }
                })

            } else if (

                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'The data not approved !',
                    'success'
                )
            }
        })
    });

</script>
