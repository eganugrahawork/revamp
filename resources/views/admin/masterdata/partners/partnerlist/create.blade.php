<div class="card">
    <div class="card-header">
        <h4>Create New Partner</h4>
    </div>
    <div class="card-body">
        <form id="add-form">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Code</label>
                        <input type="text" name="code" id="code"
                            class="form-control form-control-solid mb-3 mb-lg-0" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Name</label>
                        <input type="text" name="name" id="name"
                            class="form-control form-control-solid mb-3 mb-lg-0" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Email</label>
                        <input type="email" name="email" id="email"
                            class="form-control form-control-solid mb-3 mb-lg-0" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required form-label fw-bold">Partner Type</label>
                        <div class="col-lg-8">
                            <select class="form-select  form-select-solid mb-3 mb-lg-0" name="partner_type"
                                id="partner_type" required>
                                @foreach ($partner_type as $pt)
                                    <option value="{{ $pt->id }}">{{ $pt->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Phone Number</label>
                        <input type="number" name="phone" id="phone"
                            class="form-control form-control-solid mb-3 mb-lg-0" required />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Fax</label>
                        <input type="text" name="fax" id="fax"
                            class="form-control form-control-solid mb-3 mb-lg-0" required />
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Address</label>
                        <textarea name="address" id="address" class="form-control form-control-solid mb-3 mb-lg-0" required></textarea>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Ship Address</label>
                        <textarea name="ship_address" id="ship_address" class="form-control form-control-solid mb-3 mb-lg-0" required></textarea>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required fw-bold fs-6 mb-2">Bank</label>
                        <div class="row">
                            <div class="col-lg-4">
                                <input type="text" name="bank_name" id="bank_name"
                                    class="form-control form-control-solid mb-3 mb-lg-0" required />
                            </div>
                            <div class="col-lg-8">
                                <input type="text" name="account_number" id="account_number"
                                    class="form-control form-control-solid mb-3 mb-lg-0" required />
                            </div>
                        </div>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="required form-label fw-bold">Status</label>
                        <select class="form-select  form-select-solid mb-3 mb-lg-0" name="status" id="status"
                            required>
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>


                </div>
            </div>

            <div class="d-flex justify-content-end" id="loadingnya">
                <div class="py-2">
                    <button class="btn btn-sm btn-secondary" type="button" onclick="tutupContent()">Discard</button>
                </div>
                <div class="py-2">
                    <button class="btn btn-sm btn-primary" id="btn-add">Add Partner</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $('#add-form').on('submit', function(e) {
        e.preventDefault();


        $('#btn-add').hide()
        $('#loadingnya').html(
            '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')


        $.ajax({
            type: "POST",
            url: "{{ url('/admin/masterdata/partners/store') }}",
            data: $('#add-form').serialize(),
            dataType: 'json',
            success: function(response) {
                Swal.fire(
                    'Success',
                    response.success,
                    'success'
                )
                $('#content').hide();
                $('#indexContent').show();
                partnerTable.ajax.reload(null, false);
            }
        })
    });
</script>