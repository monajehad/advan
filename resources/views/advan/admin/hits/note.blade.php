@extends('layouts.cpanel.app')
@section('content')


    <div class="card">
        <div class="card-header">
            الملاحظات
        </div>
        <div class="card-body">
            <form method="get" action="{{url('admin/note')}}">
                <div class="row">
                    <div class="col-3 form-group">
                        <label class="control-label" for="y">{{ trans('global.year') }}</label>
                        <select name="y" id="y" class="form-control">
                            @foreach(array_combine(range(date("Y"), 2000), range(date("Y"), 2000)) as $year)
                                <option value="{{ $year }}" @if($year===old('y', Request::get('y', date('Y')))) selected @endif>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3 form-group">
                        <label class="control-label" for="m">{{ trans('global.month') }}</label>
                        <select name="m" for="m" class="form-control">
                            <option value="0">اختر الشهر</option>
                            @foreach(cal_info(0)['months'] as $month)
                                {{--                                <option value="{{ $month }}" @if($month===old('m', Request::get('m', date('F')))) selected @endif>--}}
                                <option value="{{ $month }}" @if($month===old('m', \Illuminate\Support\Facades\Request::get('m', date('F')))) selected @endif >
                                    {{ month()[$month] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-3 form-group">
                        <label class="control-label" for="m">اليوم</label>
                        <select name="d" for="d" class="form-control">
                            <option value="0">اختر اليوم</option>
                            @for ($x = 1; $x <= 31; $x++)
                                <option value="{{ $x }}" @if ($x===old('d', \Illuminate\Support\Facades\Request::get('d')  , date('D'))) selected @endif>
                                    {{$x }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="col-4">
                        <label class="control-label">&nbsp;</label><br>
                        <button class="btn btn-primary" type="submit">عرض</button>
                    </div>
                </div>


            </form>

            <br>
            <br>
            <br>
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Hit">
                <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.hit.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.hit.fields.client') }}
                    </th>
                    <th>
                        {{ trans('cruds.hit.fields.user') }}
                    </th>

                    <th>
                        وقت الاعتماد
                    </th>
                    <th>
                        الملاحظة
                    </th>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>

                    <td>
                    </td>

                </tr>
                </thead>
            </table>
        </div>
    </div>



@endsection
@section('script')
    @parent
    <script>

        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                {{--ajax: "{{ route('admin.hits.note') }}",--}}
                "ajax": {
                    url: "{{ route('admin.hits.note') }}",
                    data: function (d) {
                        d.y = '{{ request()->get('y') }}';
                        d.m = '{{ request()->get('m') }}';
                        d.start = '{{ request()->get('start') }}';
                        d.end = '{{ request()->get('end') }}';
                        d.d = '{{ request()->get('d') }}';
                    },
                },
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'id', name: 'id' },
                    { data: 'client_name', name: 'client.name' },
                    { data: 'user_name', name: 'user.name' },
                    { data: 'date', name: 'date' },
                    { data: 'note', name: 'note' },
                ],
                orderCellsTop: true,
                order: [[ 1, 'desc' ]],
                pageLength: 100,
            };
            let table = $('.datatable-Hit').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

            let visibleColumnsIndexes = null;
            $('.datatable thead').on('input', '.search', function () {
                let strict = $(this).attr('strict') || false
                let value = strict && this.value ? "^" + this.value + "$" : this.value

                let index = $(this).parent().index()
                if (visibleColumnsIndexes !== null) {
                    index = visibleColumnsIndexes[index]
                }

                table
                    .column(index)
                    .search(value, strict)
                    .draw()
            });
            table.on('column-visibility.dt', function(e, settings, column, state) {
                visibleColumnsIndexes = []
                table.columns(":visible").every(function(colIdx) {
                    visibleColumnsIndexes.push(colIdx);
                });
            })
        });

    </script>
@endsection
