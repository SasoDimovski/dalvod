@extends('admin/master')
@section('content')
    <?php
    $id_module = $module->id ?? '';
    $lang = request()->segment(2);
    $query = request()->getQueryString();

    $listing = app('request')->input('listing', config('projects.pagination'));

    $id = $project->id ?? '';
    $title = $project->title ?? old('title');
    $id_voltage = $project->id_voltage ?? old('id_voltage');
    $id_conductor = $project->id_conductor ?? old('id_conductor');
    $id_ground_wires = $project->id_ground_wires ?? old('id_ground_wires');
    $id_starting_point = $project->id_starting_point ?? old('id_starting_point');
    $id_ending_point = $project->id_ending_point ?? old('id_ending_point');
    $tensile_stress_cond = $project->tensile_stress_cond ?? old('tensile_stress_cond');
    $tensile_stress_ground = $project->tensile_stress_ground ?? old('tensile_stress_ground');
    $kn = $project->kn ?? old('kn');
    $ki = $project->ki ?? old('ki');
    $id_wind_pressure = $project->id_wind_pressure ?? old('id_wind_pressure');
    $id_insulator_chain = $project->id_insulator_chain ?? old('id_insulator_chain');
    $approx_field_length = $project->approx_field_length ?? old('approx_field_length');
    $approx_number_towers = $project->approx_number_towers ?? old('approx_number_towers');
    $num_cond_systems = $project->num_cond_systems ?? old('num_cond_systems');
    $num_cond_bundle = $project->num_cond_bundle ?? old('num_cond_bundle');
    $num_ground_wires = $project->num_ground_wires ?? old('num_ground_wires');


    $created_at = (isset($project->created_at)) ? date("d.m.Y H:i:s", strtotime($project->created_at)) : old('created_at');
    $updated_at = (isset($project->updated_at)) ? date("d.m.Y H:i:s", strtotime($project->updated_at)) : old('updated_at');


    $created_by = $project->created_by ?? old('created_by');
    $updated_by = $project->updated_by ?? old('updated_by');

    $active = $project->active ?? '';

    $url = url('admin/' . $lang . '/' . $module->link);

    $url_return_situation = $url . '/situation/' . $id;
    $url_import_situation = $url . '/import_situation/' . $id;
    $url_delete_situation = $url . '/delete_situation/' ;

    /*======================================================================================*/
    $url_edit = $url . '/edit';
    $url_edit_endpoints = $url . '/edit_endpoints';
    $url_edit_points = $url . '/edit_points';
    /*======================================================================================*/
    $url_show_raspres = $url . '/show_raspres';
    $url_show_zatpol = $url . '/show_zatpol';
    $url_show_gapres = $url . '/show_gapres';
    $url_all_tables = $url . '/calculations';
    $url_controls = $url . '/controls';
    $url_situation = $url . '/situation';
    $url_show_table_forces = $url . '/show_table_forces';
    $url_show_table_towers = $url . '/show_table_towers';
    $url_show_table_stringing = $url . '/show_table_stringing';
    /*======================================================================================*/

    $path_upload = 'uploads/projects/';

    $message_error = (isset($id)) ? __('global.update_error') : __('global.save_error');
    $message_success = (isset($id)) ? __('global.update_success') : __('global.save_success');

    ?>


        <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">

                <div class="row mb-2">

                    <div class="col-sm-6">
                        <h1><i class="fa {{$module->design->icon}}"></i> {{$module->title }} </h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{$url}}">{{$module->title }}</a>
                            </li>
                        </ol>
                    </div>

                </div>


            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- / Content Header (Page header) -->

        <section class="content">
            <div class="container-fluid">

                @include('admin._flash-message')
                @if (count($errors) > 0)
                    <div id="toast-container" class="toast-top-full-width" onclick="closeErrorWindow(this)"
                         style="width:100%" >

                        <div class="toast toast-error" aria-live="assertive" style="width:100%" >
                            <div class="toast-progress" style="width:100%;"></div>
                            <button type="button" class="close" data-dismiss="toast-top-full-width"
                                    role="button" onclick="closeErrorWindow(this)">×
                            </button>
                            <p><strong>{{__('global.error_not')}}</strong></p>
                            <div class="toast-message">
                                @foreach ($errors->all() as $error)
                                    <div class="callout callout-danger"
                                         style="color: #0a0a0a!important;padding: 5px!important;">
                                        {!! $error !!}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif



                <div class="row">
                    @if($id)
                        @include('Projects::projects.edit-submenu')
                    @endif
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xll-12">

                        {{--=========================================================--}}
                        <div class="card card">

                            <div class="card-header">

                                @if($active==0)
                                    &nbsp;<i class="fas fa-lock text-danger"
                                             title="{{__('global.deactivated')}}"></i>
                                @endif
                                <h3 class="card-title">  @if(isset($id)&&!empty($id))
                                        <b>{{$title}}</b>, id: {{$id}}
                                    @else
                                        {{__('global.new_record')}}
                                    @endif</h3>&nbsp;&nbsp;


                            </div>
                            <!-- /.card-header -->

                            <div class="card-body scrollmenu">
                                <div class="row">
                                    <div class="col-12">

                                        <form class="needs-validation"
                                              method="POST"
                                              action="{{ $url_import_situation }}"
                                              enctype="multipart/form-data">

                                            @csrf

                                            <input type="hidden" name="page" value="{{ app('request')->input('page') }}">
                                            <input type="hidden" name="url_return" value="{{ $url_return_situation }}">
                                            <input type="hidden" name="query" value="{{ $query }}">

                                            <div class="form-row align-items-end">

                                                <!-- LABEL -->
                                                <div class="col-auto">
                                                    <label class="mb-1">
                                                        {{ __('projects.edit-points.import_excel') }}
                                                    </label>
                                                </div>

                                                <!-- FILE -->
                                                <div class="col-md-5">
                                                    <div class="custom-file">
                                                        <input type="file"
                                                               class="custom-file-input"
                                                               name="exel"
                                                               id="exel">

                                                        <label class="custom-file-label"
                                                               for="exel">
                                                            Choose file
                                                        </label>
                                                    </div>
                                                </div>

                                                <!-- IMPORT -->
                                                <div class="col-auto">
                                                    <button type="submit"
                                                            class="btn btn-success">
                                                        {{ __('projects.edit-points.import') }}
                                                    </button>
                                                </div>

                                                <!-- DELETE -->
                                                <div class="col-auto">
                                                    <a href="#"
                                                       class="btn btn-danger modal_warning"
                                                       data-toggle="modal"
                                                       data-target="#ModalWarning"
                                                       data-url="{{ $url_delete_situation.'/'.$id.'?'.$query }}">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </div>

                                            </div>

                                        </form>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        @php
                                            $planPoints = $situation->values()->map(function($row) {
                                                return [
                                                    'x' => (float) ($row->x ?? 0),
                                                    'y' => (float) ($row->y ?? 0),
                                                    'z' => (float) ($row->z ?? 0),
                                                    'id'=> (int)   ($row->id ?? 0),
                                                ];
                                            });
                                        @endphp

                                        <div class="card card-primary mt-3">
                                            <div class="card-header">
                                                <h3 class="card-title">Situation – план (поглед одозгора)</h3>
                                            </div>
                                            <div class="card-body" style="height: 600px;">
                                                <canvas id="planChart"></canvas>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                {{--=========================================================--}}
                            </div>
                        </div>



                    </div>
                    {{--=========================================================--}}


                </div>

            </div>
        </section>
        <!-- /.Main content -->
    </div>
    <!-- /.Content Wrapper. Contains page content -->
@endsection

@section('additional_css')

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ url('LTE/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ url('LTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ url('LTE/plugins/toastr/toastr.min.css')}}">
@endsection

<script src="{{url('LTE/plugins/chart.js/Chart.min.js')}}"></script>
<!-- REQUIRED for PAN -->
<script src="https://cdn.jsdelivr.net/npm/hammerjs@2.0.8/hammer.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom@0.7.7"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const pts = @json($planPoints);
        if (!pts || !pts.length) return;

        const xVals = pts.map(p => Number(p.x));
        const yVals = pts.map(p => Number(p.y));

        const xMin = Math.min(...xVals), xMax = Math.max(...xVals);
        const yMin = Math.min(...yVals), yMax = Math.max(...yVals);

        // мал padding за да не “лепи” до раб
        const padX = (xMax - xMin) * 0.05 || 1;
        const padY = (yMax - yMin) * 0.05 || 1;

        const ctx = document.getElementById('planChart').getContext('2d');

        window.planChart = new Chart(ctx, {
            type: 'scatter',
            data: {
                datasets: [{
                    label: 'Геодетски точки (X,Y)',
                    data: pts,

                    showLine: false,   // ✅ ОВА го исклучува поврзувањето

                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 1)',

                    pointRadius: 4,
                    pointHoverRadius: 6,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,

                scales: {
                    xAxes: [{
                        type: 'linear',
                        scaleLabel: { display: true, labelString: 'X (m)' }
                    }],
                    yAxes: [{
                        scaleLabel: { display: true, labelString: 'Y (m)' }
                    }]
                },

                tooltips: {
                    callbacks: {
                        label: function (t, data) {
                            const p = data.datasets[t.datasetIndex].data[t.index];
                            return `ID:${p.id}  X:${p.x.toFixed(2)}  Y:${p.y.toFixed(2)}  Z:${p.z.toFixed(3)}`;
                        }
                    }
                }
            }
        });
    });
</script>



