<!DOCTYPE html>
<html lang="en">
	<head><base href="">
		<title>Loccana</title>
		<meta charset="utf-8" />
		<meta name="description" content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
		<meta name="keywords" content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme" />
		<meta property="og:url" content="https://keenthemes.com/metronic" />
		<meta property="og:site_name" content="Keenthemes | Metronic" />
		<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
		<link rel="icon" type="image/gif" href="{{ asset('storage/logos/logoputih.png') }}"/>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <link href="/metronic/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
		<link href="/metronic/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
		<link href="/metronic/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="/metronic/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
        {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css"> --}}
        <link rel="stylesheet" href="/css/admin/index.css">
	</head>
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled aside-enabled">

        <div class="d-flex flex-column flex-root">
			<div class="page d-flex flex-row flex-column-fluid">
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                            @include('admin.layouts.header')


                                @yield('content')


                            @include('admin.layouts.footer')

                </div>
            </div>
        </div>

                <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
                <script>var hostUrl = "/metronic/assets/";</script>
                <script src="/metronic/assets/plugins/global/plugins.bundle.js"></script>
                <script src="/metronic/assets/js/scripts.bundle.js"></script>
                <script src="/metronic/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
                <script src="/metronic/assets/js/custom/widgets.js"></script>
                <script src="/metronic/assets/js/custom/apps/chat/chat.js"></script>
                <script src="/metronic/assets/js/custom/modals/create-app.js"></script>
                {{-- <script src="/metronic/src/js/layout/app.js"></script> --}}
                <script src="/metronic/assets/js/custom/modals/upgrade-plan.js"></script>
                <script src="/js/admin/index.js"></script>


                <script src="/metronic/assets/plugins/custom/datatables/datatables.bundle.js"></script>
                {{-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script> --}}

                <script>
                     $(document).ready(function () {
                      var indukTable =  $('#indukTable').DataTable({
                            "bLengthChange": false,
                            "bFilter": true,
                            "bInfo": false,
                        });

                        $('#searchIndukTable').keyup(function () {
                            indukTable.search($(this).val()).draw()
                        });
                    });
                </script>
@yield('js')

</body>
</html>
