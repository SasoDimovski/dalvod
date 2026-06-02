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

    $id_point = $point->id ?? '';
    $title = $project->title ?? old('title');


    $id_point = $point->id ?? old('id_point');
    $stac_t_point = $point->stac_t ?? old('stac_t');
    $kota_t_point = $point->kota_t ?? old('kota_t');
    $agol_tr_point = $point->agol_tr ?? old('agol_tr');
    $id_tower_point = $point->id_tower ?? old('id_tower');
    $tower_tip_point = $point->tower->tip ?? old('id_tower_');
    $id_insulator1_point = $point->id_insulator1 ?? old('insulator1');
    $insulator1_tip_point = $point->insulator1->type ?? old('insulator1_');
    $id_insulator2_point = $point->id_insulator2 ?? old('insulator2');
    $insulator2_tip_point = $point->insulator2->type ?? old('insulator2_');

    $nap_pro_point = $point->nap_pro?? old('nap_pro');
    $nap_zaj_point = $point->nap_zaj?? old('nap_zaj');
    $nap_zaj2_point = $point->nap_zaj2 ?? old('nap_zaj2');
    $kndt_point = $point->kndt?? old('kndt');
    $kidt_point = $point->kidt?? old('kidt');
    $priv_point = $point->priv?? old('priv');




    $url = url('admin/' . $lang . '/' . $module->link);

    $url_store_points = $url . '/store-point/' . $id;
    $url_update_points = $url . '/update-point/' . $id.'/'.$id_point;
    $url_action_points = !empty($id_point) ? $url_update_points : $url_store_points;

    $url_delete_points = $url . '/delete_points';
    $url_delete_imported_points = $url . '/delete_imported_points';
    $url_return_points = $url . '/edit_points/' . $id;
    $url_import_points = $url . '/import_points/' . $id;

    $url_edit_point = $url . '/edit_point/' . $id;;

    $url_edit_towers = $url . '/towers';
    $url_edit_insulators = $url . '/insulators';



    $url_show_tower = $url . '/show-tower';

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
    $url_export_excel = $url .'/export-excel-forces/'. $id;

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
                                    {{--=========================================================--}}


                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">

                                        @if(count($data) > 0)

                                            @foreach($data as $item)

                                                <div class="card card-primary mb-4">

                                                    <div class="card-header bg-primary text-white">
                                                        <h3 class="card-title">
                                                           Столб број:
                                                            {{ $item['summary']['br_stolb'] ?? '' }}
                                                        </h3>
                                                    </div>

                                                    <div class="card-body scrollmenu">

                                                        <table class="table_grid table table-bordered text-center">
                                                            <thead>
                                                            <tr>
                                                                <th>Сила [daN]</th>
                                                                <th></th>
                                                                <th>Vx</th>
                                                                <th>Vy</th>
                                                                <th>Vz</th>
                                                                <th>Zx</th>
                                                                <th>Zy</th>
                                                                <th>Zz</th>
                                                                <th>Sx</th>
                                                                <th>Sy</th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                            @foreach($item['forces'] ?? [] as $row)
                                                                <tr>
                                                                    <td>{{ $row['group'] ?? '' }}</td>
                                                                    <td><b>{{ $row['code'] ?? '' }}</b></td>

                                                                    <td>{{ ($row['data']['vx'] ?? null) !== null ? number_format((float)$row['data']['vx'], 2, '.', '') : '' }}</td>
                                                                    <td>{{ ($row['data']['vy'] ?? null) !== null ? number_format((float)$row['data']['vy'], 2, '.', '') : '' }}</td>
                                                                    <td>{{ ($row['data']['vz'] ?? null) !== null ? number_format((float)$row['data']['vz'], 2, '.', '') : '' }}</td>
                                                                    <td>{{ ($row['data']['zx'] ?? null) !== null ? number_format((float)$row['data']['zx'], 2, '.', '') : '' }}</td>
                                                                    <td>{{ ($row['data']['zy'] ?? null) !== null ? number_format((float)$row['data']['zy'], 2, '.', '') : '' }}</td>
                                                                    <td>{{ ($row['data']['zz'] ?? null) !== null ? number_format((float)$row['data']['zz'], 2, '.', '') : '' }}</td>
                                                                    <td>{{ ($row['data']['sx'] ?? null) !== null ? number_format((float)$row['data']['sx'], 2, '.', '') : '' }}</td>
                                                                    <td>{{ ($row['data']['sy'] ?? null) !== null ? number_format((float)$row['data']['sy'], 2, '.', '') : '' }}</td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>

                                                        <div class="row mt-3">
                                                            <div class="col-md-4">
                                                                <b>Тип на столб:</b>
                                                                {{ $item['summary']['tower_type'] ?? '' }}
                                                            </div>

                                                            <div class="col-md-4">
                                                                <b>Тип на изолациона верига:</b>
                                                                {{ $item['summary']['insulator'] ?? '' }}
                                                            </div>

                                                            <div class="col-md-4">
                                                                <b>Агол</b>
                                                                {{ number_format((float)($item['summary']['agol_t'] ?? 0), 3, '.', '') }} [°]
                                                            </div>
                                                        </div>

                                                        <div class="row mt-2">
                                                            <div class="col-md-4">
                                                                <b>Гравитационен распон на спроводник:</b>
                                                                {{ number_format((float)($item['summary']['grr_vpro'] ?? 0), 2, '.', '') }} [m]
                                                            </div>

                                                            <div class="col-md-4">
                                                                <b>Гравитационен распон на з. ј.:</b>
                                                                {{ number_format((float)($item['summary']['grr_vzaj'] ?? 0), 2, '.', '') }} [m]
                                                            </div>

                                                            <div class="col-md-4">
                                                                <b>Среден распон:</b>
                                                                {{ number_format((float)($item['summary']['sre_ras'] ?? 0), 2, '.', '') }} [m]
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            @endforeach

                                        @else
                                            {{ __('global.no_records') }}
                                        @endif

                                    </div>


                                </div>

                                <div class="row">
                                    <a class="btn btn-default btn-sm float-right"
                                       href="{{$url_export_excel}}"
                                       title="{{__('global.export_excel')}}"><i
                                            class="fa fa-print"></i> {{__('global.export_excel')}}
                                    </a>
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







