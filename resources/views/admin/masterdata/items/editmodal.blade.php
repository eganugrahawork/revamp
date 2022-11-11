<form id="kt_modal_add_user_form" class="form" action="/admin/masterdata/items/update" method="post">
    @csrf
    <input type="hidden" value="{{ $item->id }}" name="id">
    <div class="row">
        <div class="col-lg-6">
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Kode Item</label>
                <input type="text" name="item_code" class="form-control form-control-solid mb-3 mb-lg-0"  value="{{ $item->item_code }}" required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Nama Item</label>
                <input type="text" name="item_name" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $item->item_name }}" required/>
            </div>
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Deskripsi Item</label>
                <textarea  name="item_description" class="form-control form-control-solid mb-3 mb-lg-0"  required>{{ $item->item_description }}</textarea>
            </div>
            {{-- <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Ukuran</label>
                <div class="col-lg-6">
                    <input type="number" name="base_qty" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $item->base_qty }}" required/>
                </div>
            </div> --}}
            <div class="fv-row mb-7">
                <label class="required form-label fw-bold">Units</label>
                <div class="col-lg-6">
                    <select class="form-select  form-select-solid mb-3 mb-lg-0" name="uom_id" required>
                        @foreach ($uom as $uom)
                        <option value="{{ $uom->id }}" @if ($item->uom_id == $uom->id)
                            selected
                        @endif>{{ $uom->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="fv-row mb-7">
                <label class="required fw-bold fs-6 mb-2">Unit Box</label>
                <div class="col-lg-6">
                    <input type="number" name="unit_box" value="{{ $item->itemqty->unit_box }}" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
                </div>
            </div>
            <div class="fv-row mb-7">
                <label class="required form-label fw-bold">Item Type</label>
                <div class="col-lg-6">
                    <select class="form-select  form-select-solid mb-3 mb-lg-0" name="type_id" required>
                        @foreach ($type as $type)
                        <option value="{{ $type->id }}" @if ($type->id == $item->type_id)
                            selected
                        @endif>{{ $type->name_type }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="fv-row mb-7">
                <label class="required form-label fw-bold">Vat</label>
                <div class="col-lg-6">
                    <select class="form-select  form-select-solid mb-3 mb-lg-0" name="vat" required>
                        <option value="11" @if ($item->vat == 11)
                            selected
                        @endif>11%</option>
                        <option value="10" @if ($item->vat == 10)
                            selected
                        @endif>10%</option>
                        <option value="0"  @if ($item->vat == 0)
                            selected
                        @endif>0%</option>
                    </select>
                </div>
            </div>
            <div class="fv-row mb-7">
                <label class="form-label fw-bold required">Partner</label>
            <select class="form-select  form-select-solid mb-3 mb-lg-0" name="partner_id" required>
                @foreach ($partner as $p)
                    <option value="{{ $p->id }}"  @if ($item->partner_id == $p->id)
                        selected
                    @endif>{{ $p->name }}</option>
                @endforeach
            </select>
            </div>
            <div class="fv-row mb-7">
                <label class="form-label fw-bold required">Status</label>
                <select class="form-select  form-select-solid mb-3 mb-lg-0" name="status" required>
                        <option value="0"  @if ($item->status ==0 || $item->status == null)
                            selected
                        @endif>Tidak Dijual</option>
                        <option value="1"  @if ($item->status == 1)
                            selected
                        @endif>Dijual</option>

                </select>
            </div>

        </div>
    </div>



        <div class="d-flex justify-content-end" id="loadingnya">
            <button class="btn btn-sm btn-primary" id="btn-update">Update Item</button>
        </div>
</form>


<script>
    $('form').submit(function(){
    $('#btn-update').hide()
    $('#loadingnya').html('<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
    // $('#btn-custom').attr("disabled", 'disabled')
})
</script>

