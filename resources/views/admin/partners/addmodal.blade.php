<form id="add-form">
    {{-- @csrf --}}
    <div class="row">
    <div class="col-lg-6">
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Kode</label>
            <input type="text" name="code" id="code" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Nama</label>
            <input type="text" name="name" id="name" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Email</label>
            <input type="email" name="email" id="email" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required form-label fw-bold">Partner Type</label>
            <div class="col-lg-8">
                <select class="form-select  form-select-solid mb-3 mb-lg-0" name="partner_type" id="partner_type" required>
                    @foreach ($partner_type as $pt)
                    <option value="{{ $pt->id }}">{{ $pt->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">No Hp</label>
            <input type="number" name="phone" id="phone" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Fax</label>
            <input type="text" name="fax" id="fax" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Alamat</label>
            <textarea  name="address" id="address" class="form-control form-control-solid mb-3 mb-lg-0"  required></textarea>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Alamat Pengiriman</label>
            <textarea  name="ship_address" id="ship_address" class="form-control form-control-solid mb-3 mb-lg-0"  required></textarea>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Bank</label>
            <div class="row">
                <div class="col-lg-4">
                    <input type="text" name="bank_name" id="bank_name" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
                </div>
                <div class="col-lg-8">
                    <input type="text" name="account_number" id="account_number" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
                </div>
            </div>
        </div>
        <div class="fv-row mb-7">
            <label class="required form-label fw-bold">Status</label>
                <select class="form-select  form-select-solid mb-3 mb-lg-0" name="status" id="status" required>
                    <option value="1">Ya</option>
                    <option value="0">Tidak</option>
                </select>
        </div>


    </div>
</div>

        <div class="d-flex justify-content-end" id="loadingnya">
            <button class="btn btn-sm btn-primary" id="btn-add">Add Principal</button>
        </div>
    </form>