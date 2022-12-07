<div class="card">
    <div class="card-header">
        <h4>Update UOM {{ $uom->name }}</h4>
    </div>
    <div class="card-body">
        <form id="update-form" class="form">
            @csrf
            <input type="hidden" value="{{ $uom->id }}" name="id" id="id">
            <div class="fv-row mb-3">
                <label class="required fw-bold fs-6 mb-2">UOM</label>
                <input type="text" name="name" id="name" class="form-control form-control-solid mb-3 mb-lg-0"
                    value="{{ $uom->name }}" required />
            </div>
            <div class="fv-row mb-3">
                <label class="required fw-bold fs-6 mb-2">Simbol</label>
                <input type="text" name="symbol" id="symbol" class="form-control form-control-solid mb-3 mb-lg-0"
                    value="{{ $uom->symbol }}" required />
            </div>
            <div class="fv-row mb-3">
                <label class="required fw-bold fs-6 mb-2">Keterangan</label>
                <input type="text" name="description" id="description"
                    class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $uom->description }}" required />
            </div>
            <div class="fv-row mb-3">
                <label class="required form-label fw-bold">Status</label>
                <select class="form-select  form-select-solid mb-3 mb-lg-0" id="status" name="status" required>
                    <option value="1" {{ $uom->status == 1 ? 'selected' : '' }}>Ya</option>
                    <option value="0" {{ $uom->status == 0 ? 'selected' : '' }}>Tidak</option>
                </select>
            </div>

            <div class="d-flex justify-content-end" id="loadingnya">
                <div class="py-2">
                    <button class="btn btn-sm btn-secondary" type="button" onclick="tutupContent()">Discard</button>
                </div>
                <div class="py-2">
                    <button class="btn btn-sm btn-primary" id="btn-update">Update UOM</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $('#update-form').on('submit', function(e) {
        e.preventDefault();

        $('#loadingnya').html(
            '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')


        $.ajax({
            type: "POST",
            url: "{{ url('/admin/masterdata/uom/update') }}",
            data: $('#update-form').serialize(),
            dataType: 'json',
            success: function(response) {
                Swal.fire(
                    'Success',
                    response.success,
                    'success'
                )
                $('#content').hide();
                $('#indexContent').show();
                tableUom.ajax.reload(null, false);
            }
        })
    })
</script>