@extends('admin.layouts.app')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Result</h1>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#crudModal" style="background-color:#c6a23f;border-color:#c6a23f;">
          Add
        </button>
        <table class="table table-bordered" id="dataTable" cellspacing="0" style="width: 100%; font-size: 14px;"></table>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="crudModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Result</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="crudForm" data-action="add">
          <div class="modal-body">
            <input type="hidden" name="id">

            <div class="form-group row">
              <div class="col-12">
                <label>Number</label>
                <input type="number" class="form-control" name="number">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-12">
                <label>Out at</label>
                <input type="datetime" class="form-control datepicker" name="out_at">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" style="background-color:#c6a23f;border-color:#c6a23f;">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->
@endsection

@push('page_plugins')
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
@endpush

@push('page_custom_scripts')
<script>
  $(window).ready(function() {
    const apiUrl = `http://localhost/miami/public/api`
    const accessToken = getCookie('access-token')
    let crudModal = $('#crudModal')

    let table = $('#dataTable').DataTable({
      processing: true,
      serverSide: true,
      paging: true,
      pageLength: 10,
      lengthMenu: [10, 25, 50, 75, 100],
      ajax: {
        url: `${apiUrl}/result`,
        beforeSend: request => {
          request.setRequestHeader('Authorization', `Bearer ${accessToken}`)
        },
        data: data => {
          let columns = data.columns
          let searchableColumns = []
          let filters = {}

          columns.map(column => {
            if (column.searchable) {
              searchableColumns.push(column.data)
            }
          })

          searchableColumns.forEach(searchableColumn => {
            if (
              searchableColumn == 'created_at' ||
              searchableColumn == 'updated_at'
            ) {
              filters[searchableColumn] = Date.parse(data.search.value) / 1000
            } else {
              filters[searchableColumn] = data.search.value
            }
          });

          let customData = {
            page: data.start / data.length + 1,
            limit: data.length,
            filters: filters,
            sorts: {
              column: columns[data.order[data.order.length - 1].column].data,
              direction: data.order[data.order.length - 1].dir
            }
          }

          return customData
        },
        dataFilter: data => {
          let json = JSON.parse(data)
          json.recordsTotal = json.totalRecords
          json.recordsFiltered = json.totalRecords

          return JSON.stringify(json)
        }
      },
      columns: [{
          title: '#',
          defaultContent: ''
        },
        {
          title: 'number',
          data: 'number'
        },
        {
          title: 'out at',
          data: 'out_at'
        },
        {
          title: 'created at',
          data: 'created_at'
        },
        {
          title: 'updated at',
          data: 'updated_at'
        },
        {
          defaultContent: ''
        }
      ],
      columnDefs: [{
          searchable: false,
          orderable: false,
          targets: [0],
        },
        {
          searchable: false,
          orderable: false,
          targets: 5,
          render: (data, type, row) => {
            let editButton = document.createElement('button')
            editButton.dataset.id = row.id
            editButton.className = 'btn btn-sm btn-success mr-1 d-inline editButton'
            editButton.innerText = 'edit'

            let deleteButton = document.createElement('button')
            deleteButton.dataset.id = row.id
            deleteButton.className = 'btn btn-sm btn-danger d-inline deleteButton'
            deleteButton.innerText = 'delete'

            return editButton.outerHTML + deleteButton.outerHTML
          }
        },
        {
          render: (data, type, row) => {
            return new Date(data * 1000).toLocaleString(0, {
              year: 'numeric',
              month: '2-digit',
              day: '2-digit',
              hour: '2-digit',
              minute: '2-digit',
              hour12: false
            })
          },
          targets: [2, 3, 4]
        }
      ],
      order: [3, 'desc'],
    });

    /* Set row numbers */
    table.on('order.dt search.dt draw', function() {
      let info = table.page.info()

      table.column(0, {
        search: "applied",
        order: "applied"
      }).nodes().each(function(cell, i) {
        cell.innerHTML = i + 1 + (info.page * info.length);
      });
    })

    /* Handle onclick .addButton */
    $(document).on('click', '#addButton', function() {
      if (crudModal.find('#crudForm').data('action') !== 'add') {
        $('#crudForm .is-invalid').removeClass('is-invalid')
        $('#crudForm .invalid-feedback').remove()
        crudModal.find('#crudForm').trigger('reset')
      }

      crudModal.find('#crudForm [name=id]').val('')
      crudModal.find('#crudForm').data('action', 'add')
      crudModal.find('.modal-header').text('Add Result')
      crudModal.modal('show')
    })

    /* Handle onclick .editButton */
    $(document).on('click', '.editButton', function() {
      let id = $(this).data('id')

      crudModal.find('#crudForm').data('action', 'edit')
      crudModal.find('.modal-header').text('Edit Result')
      crudModal.modal('show')

      $.ajax({
        url: `${apiUrl}/result/${id}`,
        method: 'GET',
        dataType: 'JSON',
        beforeSend: request => {
          request.setRequestHeader('Authorization', `Bearer ${accessToken}`)
        },
        success: response => {
          console.log(response);
          $('#crudForm .is-invalid').removeClass('is-invalid')
          $('#crudForm .invalid-feedback').remove()

          crudModal.find('form [name=id]').val(response.data.id)
          crudModal.find('form [name=number]').val(response.data.number)

          let outAt = new Date(response.data.out_at * 1000).toLocaleString(0, {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit',
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
          })

          crudModal.find('form [name=out_at]').daterangepicker({
            startDate: outAt,
            singleDatePicker: true,
            timePicker: true,
            timePicker24Hour: true,
            locale: {
              format: 'MM/DD/YYYY HH:mm'
            }
          })
        }
      })
    })

    /* Handle onclick .deleteButton */
    $(document).on('click', '.deleteButton', function() {
      let id = $(this).data('id')

      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: `${apiUrl}/result/${id}`,
            method: 'DELETE',
            dataType: 'JSON',
            beforeSend: request => {
              request.setRequestHeader('Authorization', `Bearer ${accessToken}`)
            },
            success: response => {
              table.ajax.reload(null, false)

              fireToast('success', 'Deleted!', 'data has been deleted')
            }
          })
        }
      })
    })

    $(document).on('submit', '#crudForm', function(event) {
      event.preventDefault()

      let url = ''
      let method = ''
      let form = $(this)
      let id = form.find('[name=id]').val()
      let action = form.data('action')

      if (action == 'add') {
        url = `${apiUrl}/result`
        method = 'POST'
      } else if (action == 'edit') {
        url = `${apiUrl}/result/${id}`
        method = 'PATCH'
      }

      $('#crudForm .is-invalid').removeClass('is-invalid')
      $('#crudForm .invalid-feedback').remove()
      form.find('button:submit')
        .attr('disabled', 'disabled')
        .text('Saving...')

      $.ajax({
        url: url,
        method: method,
        dataType: 'JSON',
        data: form.serializeArray(),
        beforeSend: request => {
          request.setRequestHeader('Authorization', `Bearer ${accessToken}`)
        },
        success: response => {
          fireToast('success', '', response.message)

          crudModal.modal('hide')
          form.trigger('reset')
          table.ajax.reload(null, false)
        },
        error: error => {
          setErrorMessages(form, error.responseJSON.errors)
        }
      }).always(() => {
        form.find('button:submit')
          .removeAttr('disabled')
          .text('Save')
      })
    })

    $('#crudModal').on('shown.bs.modal', function() {
      $(this).find('form [name]:not(disabled, readonly, :hidden)')
        .first()
        .focus()
    })

    $('.datepicker').daterangepicker({
      "singleDatePicker": true,
      "timePicker": true,
      "timePicker24Hour": true,
      locale: {
        format: 'MM/DD/YYYY HH:mm'
      }
    }, function(start, end, label) {});
  });
</script>
@endpush