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
                       <h2>Stock</h2>
                    </div>
                    <div class="d-flex align-items-center position-relative my-1">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input class="form-control" placeholder="Search" id="searchActivityTable"
                                    type="text">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="input-group">
                        <div class="form-outline">
                          <input type="text" id="daterange" name="daterange" class="form-control text-gray-500" />
                        </div>
                        <div class="" id="loading-add">
                            <button type="button" onclick="filterStock()" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                      </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">

                <table class="table table-rounded table-row-bordered border gy-7 gs-7" id="tableStock">
                    <thead>
                        <tr class="text-center text-gray-800 fw-bolder fs-7 text-uppercase gs-0  border-bottom-2 border-right-2 border-top-2 border-gray-300 ">
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7" rowspan="2">Code</th>
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7" rowspan="2">Items</th>
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7" rowspan="2">Partner</th>
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7" rowspan="2">Kemasan</th>
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7" rowspan="2">Box </th>
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7" colspan="2">Start Stock</th>
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7" colspan="4">Received</th>
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7" colspan="4">Delivery Order </th>
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7" colspan="2">End Stock</th>
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7" rowspan="2">Option</th>
                        </tr>
                        <tr class="text-center text-gray-800 fw-bolder fs-7 text-uppercase gs-0  border-bottom-2 border-right-2 border-gray-300">
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Lt/Kg</th>
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Box</th>
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Lt/Kg</th>
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Box</th>
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Retur Lt/Kg</th>
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Retur Box</th>
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Lt/Kg</th>
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Box</th>
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Retur Lt/Kg</th>
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Retur Box</th>
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Lt/Kg</th>
                            <th class="text-uppercase text-secondary text-md font-weight-bolder opacity-7">Box</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>P2202R2</td>
                            <td>Mercusuar A2201</td>
                            <td>PT apa gitu ya</td>
                            <td>PEORDA BOX 2203</td>
                            <td>APAYA</td>
                            <td>0000</td>
                            <td>20939</td>
                            <td>201928</td>
                            <td>0000</td>
                            <td>0000</td>
                            <td>0000</td>
                            <td>0000</td>
                            <td>0000</td>
                            <td>0000</td>
                            <td>0000</td>
                            <td>0000</td>
                            <td>0000</td>
                            <td>0000</td>
                        </tr>
                    </tbody>
                </table>

            </div>
            </div>
        </div>
    </div>
    <!--end::Post-->
</div>

@endsection

@section('js')

<script>
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
       function filterStock() {
            $('#loading-add').html(
                '<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            let getData = {
                'partner_id': $('#partner_id').val(),
                'date_range': $('#daterange').val()
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ url('/admin/inventory/stock/filter') }}",
                data: getData,
                datatype: 'json',
                success: function(response) {
                    console.log(response);
                    $('#loading-add').html(
                        '<button type="button" onclick="filterStock()" class="btn btn-primary"><i class = "fas fa-search" ></i></button>'
                    )
                }

            });
        }
        function editModal(id){
            $('#loading-add').html('<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            $.get("{{ url('/admin/procurement/items-receipt/editmodal') }}/"+id, {}, function(data, status){
                $('#kontennya').html(data)
                $('#mainmodal').modal('toggle')
                $('#loading-add').html('')
                $('#loading-add').html('<button type="button" class="btn btn-primary me-3" onclick="addModal()">Add Receive Items</button>')
            })
        }
        function tutupModal(){
        $('#mainmodal').modal('toggle')
        }

        // var tableStock =  $('#tableStock').DataTable({
        //     serverside : true,
        //     processing : true,
        //     ajax : {
        //             url : "{{ url('/admin/procurement/purchase-order/list') }}"
        //             },
        //             columns:
        //             [
        //             {
        //             data: 'DT_RowIndex',
        //             searchable: false
        //         },
        //             {data: 'code', name: 'code'},
        //             {data: 'partner_id', name: 'partner_id'},
        //             {data: 'order_date', name: 'order_date'},
        //             {data: 'price', name: 'price', render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp ' )},
        //             {data: 'delivery_date', name: 'delivery_date'},
        //             {data: 'status', name: 'status'},
        //             {data: 'action', name: 'action'}
        //             ],
        //     "bLengthChange": false,
        //     "bFilter": true,
        //     "bInfo": false
        // });

        // $('#searchTableStock').keyup(function () {
        //         tableStock.search($(this).val()).draw()
        // });
</script>

@endsection
