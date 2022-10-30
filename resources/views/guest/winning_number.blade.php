@extends('guest.layouts.app')

@section('content')
<div id="content">
  <div class="bg4 p8">
    <div class="container">
      <div class="row">
        <div class="grid_12">
          <h2>HISTORY RESULTS</h2>
        </div>
        <div class="grid_12">
          <table class="table">
            <thead>
              <tr>
                <th>Draw No.</th>
                <th>Results</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody id="listhistory">
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<br>
<div id="pagination-container"></div>
@endsection