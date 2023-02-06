@extends('layouts.cpanel.app')
@section('content')
{{-- @can('clinics_specialty_create') --}}

<!--begin::Container-->
<div class="container">
    <div class="card card-custom gutter-b">
        <!--begin::Header-->
        <div class="card-header border-1 py-4">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark">
                الموردون
                </span>
            </h3>
            <div class="card-toolbar">
                {{-- @can('suppliers-add') --}}
                <a class="btn btn-success" href="{{ route('admin.clients-specialties.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.clientsSpecialty.title_singular') }}
                </a>                {{-- @endcan --}}
                {{-- @can('suppliers-export') --}}
                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'ClientsSpecialty', 'route' => 'admin.clients-specialties.parseCsvImport'])                {{-- @endcan --}}
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="row mt-4">
            <div class="col-md-4 col-lg-4 ml-8">
                <form class="form">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-sm" id="search_input" name="search_input"  placeholder="الاسم"/>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body py-0">
            <!--begin::Table-->
            <div class="suppliers-table-body">  @includeIf('advan.admin.clientsSpecialties.table-data')</div>

           <!--End::Table-->
        </div>
        <!--end::Body-->
    </div>

</div>
<!--end::Container-->
@endsection
@section('script')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
// @can('clinics_specialty_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.clients-specialties.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
// @endcan

// let dtOverrideGlobals = {
//     buttons: dtButtons,
//     processing: true,
//     serverSide: true,
//     retrieve: true,
//     aaSorting: [],
//     ajax: "{{ route('admin.clients-specialties.index') }}",
//     columns: [
//       { data: 'placeholder', name: 'placeholder' },
// { data: 'id', name: 'id' },
// { data: 'name', name: 'name' },
// { data: 'status', name: 'status' },
// { data: 'actions', name: '{{ trans('global.actions') }}' }
//     ],
//     orderCellsTop: true,
//     order: [[ 1, 'desc' ]],
//     pageLength: 100,
//   };
//   let table = $('.datatable-ClinicsSpecialty').DataTable(dtOverrideGlobals);
//   $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
//       $($.fn.dataTable.tables(true)).DataTable()
//           .columns.adjust();
//   });

// let visibleColumnsIndexes = null;
// $('.datatable thead').on('input', '.search', function () {
//       let strict = $(this).attr('strict') || false
//       let value = strict && this.value ? "^" + this.value + "$" : this.value

//       let index = $(this).parent().index()
//       if (visibleColumnsIndexes !== null) {
//         index = visibleColumnsIndexes[index]
//       }

//       table
//         .column(index)
//         .search(value, strict)
//         .draw()
//   });
// table.on('column-visibility.dt', function(e, settings, column, state) {
//       visibleColumnsIndexes = []
//       table.columns(":visible").every(function(colIdx) {
//           visibleColumnsIndexes.push(colIdx);
//       });
//   })
});

</script>
@endsection
