<form id="addtypepartner-form">
    {{-- @csrf --}}
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Nama</label>
            <input type="text" name="name" id="name" class="form-control form-control-solid mb-3 mb-lg-0"  required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required form-label fw-bold">Status</label>
                <select class="form-select  form-select-solid mb-3 mb-lg-0" name="status" id="status" required>
                    <option value="1">Ya</option>
                    <option value="0">Tidak</option>
                </select>
        </div>
        <div class="d-flex justify-content-end" id="loadingnya-type">
            <button class="btn btn-sm btn-primary" id="btn-add-type">Add Type</button>
        </div>
    </form>