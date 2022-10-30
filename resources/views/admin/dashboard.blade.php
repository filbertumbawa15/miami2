@extends('admin.layouts.app')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2" style="border-left:.25rem solid #c6a23f!important;">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="color:#c6a23f !important;">
                Total Result</div>
              <div id="result-count" class="h5 mb-0 font-weight-bold text-gray-800"></div>
            </div>
            <div class="col-auto">

              <i class="fas fa-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->
@endsection

@push('page_custom_scripts')
<script>
  $(window).ready(function() {
    const accessToken = getCookie('access-token')
    $.ajax({
      url: 'http://localhost/miami/public/api/result/count',
      type: 'POST',
      cache: true,
      headers: {
        "Authorization": `Bearer ${accessToken}`,
      },
      success: function(response) {
        $('#result-count').append(response.data);
      }
    })
  });
</script>
@endpush