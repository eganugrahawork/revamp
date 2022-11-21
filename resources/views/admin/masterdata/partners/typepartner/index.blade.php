@extends('admin.layouts.main')

@section('content')
<div class="success-message" data-successmessage="{{ session('success') }}"></div>
<div class="fail-message" data-failmessage="{{ session('fail') }}"></div>
<div class="toolbar py-5 py-lg-5" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
        <div class="page-title d-flex flex-column me-3">
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">Type of Partners</h1>
            <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                <li class="breadcrumb-item text-gray-600">
                    <a href="/admin/dashboard" class="text-gray-600 text-hover-primary">Dashboard</a>
                </li>
            </ul>
        </div>
    </div>
</div>


<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl bg-warna py-4">
    <div class="content flex-row-fluid" id="kt_content">
        <div class="card bg-white">
            <div class="card-header border-0 pt-6">
                <div class="card-title align-items-start flex-column">
                    <div class="d-flex align-items-center position-relative my-1">
                       <h2>Type Partners</h2>
                    </div>
                    <div class="d-flex align-items-center position-relative my-1">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <input type="text" id="searchTypeOfpartner" class="form-control form-control-solid w-250px ps-15" placeholder="Search..." />
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base" id="loadtypepartner">
                        @can('create', ['/admin/masterdata/typeofpartner'])
                            <button type="button" class="btn btn-primary me-3" onclick="addModal()">
                            Add Type Partners</button>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="typeofpartner">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="min-w-20px">No</th>
                            <th class="min-w-125px">Name</th>
                            <th class="min-w-125px">Status</th>
                            <th class="min-w-70px">Action</th>
                        </tr>
                    </thead>
                    <tbody class="fw-bold text-gray-600">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--end::Post-->
</div>


{{-- typepartnermodal Modal --}}
<div class="modal fade" id="typepartnermodal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-400px">
        <div class="modal-content">
            <div class="modal-header" id="typepartnermodal_header">
                <h2 class="fw-bolder">Partners Type</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" onclick="tutupModalType()">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7" id="kontentypepartnermodal">
            </div>
        </div>
    </div>
</div>
{{-- End typepartnermodal Modal --}}


@endsection


@section('js')

<script>
        function addModal(){
            $('#loadtypepartner').html('<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/masterdata/partners/addtypepartnermodal') }}", {}, function(data, status){
                $('#kontentypepartnermodal').html(data)
                $('#typepartnermodal').modal('toggle')
                $('#loadtypepartner').html('<button class="btn btn-primary me-3" onclick="addModal()">Add Type Partners</button>')
            })
        }

        function editModalType(id){
            $('#loadtypepartner').html('<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/masterdata/partners/edittypepartnermodal') }}/"+id, {}, function(data, status){
                $('#kontentypepartnermodal').html(data)
                $('#typepartnermodal').modal('toggle')
                $('#loadtypepartner').html('<button class="btn btn-primary me-3" onclick="addModal()">Add Type Partners</button>')
            })
        }

        function tutupModalType(){
            $('#typepartnermodal').modal('toggle')
        }

            var typeofpartner = $('#typeofpartner').DataTable({
                serverside : true,
                    processing : true,
                    pageLength : 5,
                    ajax : {
                        url : "{{ url('/admin/masterdata/partners/listtypeofpartners') }}"
                    },
                    columns:
                    [
                        {
                            data: 'DT_RowIndex',
                            searchable: false
                        },
                        {data: 'name', name: 'name'},
                        {data: 'status', name: 'status'},
                        {data: 'action', name: 'action'},
                    ],
                    "bLengthChange": false,
                    "bFilter": true,
                    "bInfo": false
            });

            $('#searchTypeOfpartner').on('keyup', function () {
                typeofpartner.search($(this).val()).draw()
            });




        $(document).on('submit', '#addtypepartner-form', function(e){
            e.preventDefault();

            $('#btn-add-type').hide()
            $('#loadingnya-type').html('<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            var data = {
                'name': $('#name').val(),
                'status': $('#status').val()
            }
            // console.log(data);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ url('/admin/masterdata/partners/storetypepartners') }}",
                data: data,
                dataType: 'json',
                success:function(response){
                    Swal.fire(
                        'Success',
                        response.success,
                        'success'
                    )
                    $('#typepartnermodal').modal('toggle')
                    typeofpartner.ajax.reload(null, false);
                    $('#loadtypepartner').html('<button class="btn btn-primary me-3" onclick="addModal()">Add Type Partners</button>')
                }
            })
        });



        $(document).on('submit', '#updatetypepartner-form', function(e){
            e.preventDefault();


            $('#btn-updatetypepartner').hide()
            $('#loadingnyaupdatetypepartner').html('<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            var data = {
                'id': $('#id').val(),
                'name': $('#name').val(),
                'status': $('#status').val()
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ url('/admin/masterdata/partners/updatetypepartners') }}",
                data: data,
                dataType: 'json',
                success:function(response){
                    Swal.fire(
                        'Success',
                        response.success,
                        'success'
                    )
                    $('#typepartnermodal').modal('toggle')
                    typeofpartner.ajax.reload(null, false);
                    $('#loadtypepartner').html('<button class="btn btn-primary me-3" onclick="addModal()">Add Type Partners</button>')
                }
            })
        })


        $(document).on('click', '#deletepartnerstype', function(e){
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
                    $('#loadtypepartner').html('<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
                    $.ajax({
                        type:"GET",
                        url: href,
                        success:function(response){
                            Swal.fire(
                                'Success',
                                response.success,
                                'success'
                            )
                            typeofpartner.ajax.reload(null, false);
                            $('#loadtypepartner').html('<button class="btn btn-primary me-3" onclick="addModal()">Add Type Partners</button>')
                        }
                    })

                } else if (

                result.dismiss === Swal.DismissReason.cancel
                ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Data anda masih aman :)',
                    'success'
                )
                }
            })
        });
</script>


@endsection