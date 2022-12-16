@extends('admin.layouts.main')

@section('content')
    <div class="success-message" data-successmessage="{{ session('success') }}"></div>
    <div class="fail-message" data-failmessage="{{ session('fail') }}"></div>
    <div class="row">
        <div class="col-12">
            <div id="content"></div>
            <div class="card" id="indexContent">

                <div class="card-header border-0">
                    <div class="card-title align-items-start flex-column">
                        <div class="d-flex align-items-center position-relative my-1">
                            <h5 class="fw-bolder text-gray-600">Buku Besar Pembantu</h5>
                        </div>
                    </div>

                    <div class="card-toolbar">

                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="d-flex justify-content-start col-lg-7">
                        <div class="col-lg-3">
                            <select name="id" id="id" class="form-select form-select-md select-2">
                                <option value="0">Apa gitu</option>
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <input type="text" class="form-control text-gray-400 form-control-md" name="daterange" id="daterange">
                        </div>
                        <div class="col-lg-1">
                            <button class="btn btn-sm btn-primary input-group-text" type="button"><i
                                    class="lab la-searchengin"></i></a>
                        </div>

                    </div>
                    <div class="d-flex justify-content-end position-relative my-1">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input class="form-control" placeholder="Search" id="searchtableBukuBesarPembantu" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-row-bordered gy-5 gs-7 border rounded w-100"
                            id="tableBukuBesarPembantu">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">No</th>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Tanggal
                                    </th>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Bank</th>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Kode</th>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Akun</th>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Uraian
                                    </th>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">No Faktur
                                    </th>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Debit
                                    </th>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Kredit
                                    </th>
                                    <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Saldo
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="fw-bold text-md text-gray-600" style="border:none;">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('.select-2').select2()
        var start = moment().subtract(29, "days");
        var end = moment();

        function cb(start, end) {
            $("#daterange").val(start.format('YYYY-MM-DD') + " - " + end.format('YYYY-MM-DD'));
        }

        $("#daterange").daterangepicker({
            locale: {
                format: 'YYYY-MM-DD'
            },
            startDate: start,
            endDate: end,
            ranges: {
                "Today": [moment(), moment()],
                "Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf(
                    "month")]
            }
        }, cb);

        cb(start, end);
    </script>
    <script>
        function info(id) {
            $('#loading-add').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/finance/income/info') }}/" + id, {}, function(data, status) {
                $('#indexContent').hide();
                $('#content').html(data)
                $('#content').show()
                $('#loading-add').html(
                    '<button type="button" class="btn btn-primary me-3" onclick="create()">Tambah Jurnal</button>'
                )
            })
        }

        function create() {
            $('#loading-add').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/finance/income/create') }}", {}, function(data, status) {
                $('#indexContent').hide();
                $('#content').html(data)
                $('#content').show()
                $('#loading-add').html(
                    '<button type="button" class="btn btn-primary me-3" onclick="create()">Tambah Jurnal</button>'
                )
            })
        }

        function edit(id) {
            $('#loading-add').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/finance/income/edit') }}/" + id, {}, function(data, status) {
                $('#indexContent').hide();
                $('#content').html(data)
                $('#content').show()
                $('#loading-add').html(
                    '<button type="button" class="btn btn-primary me-3" onclick="create()">Tambah Jurnal</button>'
                )
            })
        }

        function tutupContent() {
            $('#content').hide()
            $('#indexContent').show()
            $('#searchtableBukuBesarPembantu').focus();

        }

        // var tableBukuBesarPembantu = $('#tableBukuBesarPembantu').DataTable({
        //     serverside: true,
        //     processing: true,
        //     ajax: {
        //         url: "{{ url('/admin/finance/income/list') }}"
        //     },
        //     columns: [{
        //             data: 'DT_RowIndex',
        //             searchable: false
        //         },
        //         {
        //             data: 'invoice_number',
        //             name: 'invoice_number'
        //         },
        //         {
        //             data: 'invoice_date',
        //             name: 'invoice_date'
        //         },
        //         {
        //             data: 'due_date',
        //             name: 'due_date'
        //         },
        //         {
        //             data: 'name',
        //             name: 'name'
        //         },
        //         {
        //             data: 'price',
        //             name: 'price',
        //             render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')
        //         },
        //         {
        //             data: 'balance',
        //             name: 'balance',
        //             render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')
        //         },
        //         {
        //             data: 'status',
        //             name: 'status'
        //         },
        //         {
        //             data: 'action',
        //             name: 'action'
        //         }
        //     ],
        //     "bLengthChange": false,
        //     "bFilter": true,
        //     "bInfo": false
        // });

        // $('#searchtableBukuBesarPembantu').keyup(function() {
        //     tableBukuBesarPembantu.search($(this).val()).draw()
        // });

        $(document).on('click', '#deleteInvoice', function(e) {
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
                title: 'Hapus data ini ?',
                text: "Data tidak bisa dikembalikan!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, hapus!',
                cancelButtonText: 'Tidak, Batalkan!',
                reverseButtons: false
            }).then((result) => {
                if (result.isConfirmed) {
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
                            tableBukuBesarPembantu.ajax.reload(null, false);
                            $('#loading-add').html(
                                '<button type="button" class="btn btn-primary me-3" onclick="create()">Tambah Jurnal</button>'
                            )
                        }
                    })

                } else if (

                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Dibatalkan',
                        'Data anda masih aman :)',
                        'success'
                    )
                }
            })
        });
    </script>
@endsection