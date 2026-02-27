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


                                    <div class="col-sm-12">

                                        @if(!$towers->isEmpty())

                                            <div class="row">
                                                <div class="col-sm-12  scrollmenu">

                                                    <table class="table table-bordered table-sm" style="width:100%; border-collapse:collapse;">
                                                        <thead>
                                                        <tr>
                                                            <th rowspan="2">Број на<br>зат. поле</th>
                                                            <th rowspan="2">Број на<br>столб</th>
                                                            <th rowspan="2">Стационажа<br>(m)</th>
                                                            <th rowspan="2">Тип на столб</th>
                                                            <th rowspan="2">Тип на изолатор<br>(берерија)</th>
                                                            <th rowspan="2">Агол на траса<br>(°)</th>

                                                            <th colspan="2">Карактеристични распони</th>

                                                            <th colspan="3">Гравитационен распон</th>

                                                            <th rowspan="2">Должина<br>на зат. поле<br>(m)</th>

                                                            <th colspan="4">Климатски услови</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Хориз.<br>распон<br>(m)</th>
                                                            <th>Сред.<br>распон<br>(m)</th>

                                                            <th>Лев<br>(m)</th>
                                                            <th>Десен<br>(m)</th>
                                                            <th>Вкупен<br>(m)</th>

                                                            <th>Напрегање<br>спров.<br>(daN/mm2)</th>
                                                            <th>Напрегање<br>з.ј.<br>(daN/mm2)</th>
                                                            <th>КНДТ</th>
                                                            <th>КИДТ</th>
                                                        </tr>
                                                        </thead>

                                                        <tbody>
                                                        @php $fieldIndex = 0; @endphp

                                                        @foreach($grouped as $g)
                                                            @php
                                                                $fieldIndex++;
                                                                $rowspan = $g->count();

                                                                // field објектот е ист за сите во групата (земи од првиот ред)
                                                                $field = $g->first()['field'];

                                                                $poleDol = $field ? (float)($field->pole_dol ?? 0) : null;
                                                                $napPro  = $field ? (float)($field->nap_pro ?? 0) : null;
                                                                $napZaj  = $field ? (float)($field->nap_zaj ?? 0) : null;
                                                                $kndt    = $field ? (float)($field->kndt ?? 0) : null;
                                                                $kidt    = $field ? (float)($field->kidt ?? 0) : null;
                                                            @endphp

                                                            @foreach($g as $idx => $r)
                                                                <tr>
                                                                    {{-- ГРУПНИ КОЛОНИ (само на првиот ред од групата) --}}
                                                                    @if($idx === 0)
                                                                        <td rowspan="{{ $rowspan }}" style="vertical-align:middle; text-align:center;">
                                                                            {{ $fieldIndex }}
                                                                        </td>
                                                                    @endif

                                                                    <td style="text-align:center;">{{ $r['stolb_no'] }}</td>
                                                                    <td style="text-align:right;">{{ number_format($r['stac_t'], 2, '.', '') }}</td>
                                                                    <td>{{ $r['tower_type'] }}</td>
                                                                    <td>{{ $r['izolator'] }}</td>
                                                                    <td style="text-align:center;">
                                                                        {{ $r['agol'] !== null ? number_format($r['agol'], 0) : '' }}
                                                                    </td>

                                                                    <td style="text-align:right;">
                                                                        {{ $r['horiz'] !== null ? number_format($r['horiz'], 2, '.', '') : '' }}
                                                                    </td>
                                                                    <td style="text-align:right;">{{ number_format($r['avg'], 2, '.', '') }}</td>

                                                                    <td style="text-align:right;">{{ number_format($r['grav_left'], 2, '.', '') }}</td>
                                                                    <td style="text-align:right;">{{ number_format($r['grav_right'], 2, '.', '') }}</td>
                                                                    <td style="text-align:right;">{{ number_format($r['grav_total'], 2, '.', '') }}</td>

                                                                    @if($idx === 0)
                                                                        <td rowspan="{{ $rowspan }}" style="vertical-align:middle; text-align:right;">
                                                                            {{ $poleDol !== null ? number_format($poleDol, 2, '.', '') : '' }}
                                                                        </td>

                                                                        <td rowspan="{{ $rowspan }}" style="vertical-align:middle; text-align:right;">
                                                                            {{ $napPro !== null ? number_format($napPro, 2, '.', '') : '' }}
                                                                        </td>
                                                                        <td rowspan="{{ $rowspan }}" style="vertical-align:middle; text-align:right;">
                                                                            {{ $napZaj !== null ? number_format($napZaj, 2, '.', '') : '' }}
                                                                        </td>
                                                                        <td rowspan="{{ $rowspan }}" style="vertical-align:middle; text-align:right;">
                                                                            {{ $kndt !== null ? number_format($kndt, 2, '.', '') : '' }}
                                                                        </td>
                                                                        <td rowspan="{{ $rowspan }}" style="vertical-align:middle; text-align:right;">
                                                                            {{ $kidt !== null ? number_format($kidt, 2, '.', '') : '' }}
                                                                        </td>
                                                                    @endif
                                                                </tr>
                                                            @endforeach
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>


                                        @else
                                            {{__('global.no_records')}}
                                        @endif

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







