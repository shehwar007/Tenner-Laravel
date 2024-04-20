<script>
  'use strict';

  const baseUrl = "{{ url('/') }}";
  var loadImgs = '';
  var ProductloadImgs = '';
</script>

<script>
  'use strict';
  const account_status = 1;
  const secret_login = 1;
</script>


{{-- js color --}}
<script type="text/javascript" src="{{ asset('assets/js/core/popper.min.js') }}"></script>

{{-- dropzone js --}}
<script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/material-dashboard.min.js?v=3.0.0') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
{{-- sweet alert --}}
<script type="text/javascript" src="{{ asset('assets/admin/js/sweetalert.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/admin-main.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets/admin/js/admin-partial.js') }}"></script>



@if (session()->has('success'))
  <script>
      alertify.success("{{ __(session('success')) }}");
  </script>
@endif

@if (session()->has('warning'))
  <script>
      alertify.error("{{ __(session('warning')) }}");
  </script>
@endif
@if (session()->has('error'))
  <script>
      alertify.error("{{ __(session('error')) }}");
  </script>
@endif


@yield('variables')

@yield('script')
@yield('vuescripts')
