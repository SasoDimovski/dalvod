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
    $insulator1_tip_point = $point->insulator1->tip ?? old('insulator1_');
    $id_insulator2_point = $point->id_insulator2 ?? old('insulator2');
    $insulator2_tip_point = $point->insulator2->tip ?? old('insulator2_');



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
    $url_edit_raspres = $url . '/edit_raspres';
    $url_edit_zatpol = $url . '/edit_zatpol';
    $url_edit_gapres = $url . '/edit_gapres';


    $path_upload = 'uploads/projects/';

    $message_error = (isset($id)) ? __('global.update_error') : __('global.save_error');
    $message_success = (isset($id)) ? __('global.update_success') : __('global.save_success');

    ?>

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
                         style="width:100%" ;>

                        <div class="toast toast-error" aria-live="assertive" style="width:100%" ;>
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
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xll-6">
                        <form class="needs-validation" role="form" id="form_edit" name="form_edit"
                              action="{{$url_action_points}}"
                              method="POST" enctype="multipart/form-data" autocomplete="off">

                            <input type="hidden" id="id" name="id" value="{{$id}}">
                            <input type="hidden" id="id_point" name="id_point" value="{{$id_point}}">
                            <input type="hidden" id="url_return" name="url_return" value="{{$url_return_points}}">
                            <input type="hidden" id="message_error" name="message_error" value="{{ $message_error }}">
                            <input type="hidden" id="message_success" name="message_success" value="{{ $message_success }}">


                            {{csrf_field()}}
                            @method('POST')
                            <div class="card {{ $id_point ? 'border-danger bg-success text-white' : '' }}">

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
                                <div class="card-body">
                                    {{--=========================================================--}}
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <?php
                                            $input_value = $stac_t_point;
                                            $input_name = 'stac_t';
                                            $input_id = 'stac_t';
                                            $input_desc = __('projects.edit-points.stacionaza');
                                            $input_maxlength = 7;
                                            $input_readonly = '';
                                            $input_css = 'text-red';
                                            $input_mandatory = '*'; //*
                                            $input_style = 'width: 80%;';
                                            ?>
                                            <div class="form-group">
                                                <label for="{{$input_id}}" class="{{$input_css}}">{{$input_desc}}
                                                    {{$input_mandatory}}</label>
                                                <input type="text" id="{{$input_id}}" name="{{$input_name}}"
                                                       style="{{$input_style}}"
                                                       class="form-control only-decimal" value="{{$input_value}}"
                                                       maxlength="{{$input_maxlength}}" {{$input_readonly}}>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <?php
                                            $input_value = $kota_t_point;
                                            $input_name = 'kota_t';
                                            $input_id = 'kota_t';
                                            $input_desc = __('projects.edit-points.kota');
                                            $input_maxlength = 7;
                                            $input_readonly = '';
                                            $input_css = 'text-red';
                                            $input_mandatory = '*'; //*
                                            $input_style = 'width: 80%;';
                                            ?>
                                            <div class="form-group">
                                                <label for="{{$input_id}}" class="{{$input_css}}">{{$input_desc}}
                                                    {{$input_mandatory}}</label>
                                                <input type="text" id="{{$input_id}}" name="{{$input_name}}"
                                                       style="{{$input_style}}"
                                                       class="form-control only-decimal" value="{{$input_value}}"
                                                       maxlength="{{$input_maxlength}}" {{$input_readonly}}>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <?php
                                            $input_value = $agol_tr_point;
                                            $input_name = "agol_tr";
                                            $input_id = "agol_tr";
                                            $input_desc = __('projects.edit-points.agol');
                                            $input_maxlength = 7;
                                            $input_readonly = '';
                                            $input_css = '';
                                            $input_mandatory = ''; //*
                                            $input_style = 'width: 80%;';
                                            ?>
                                            <div class="form-group">
                                                <label for="{{$input_id}}" class="{{$input_css}}">{{$input_desc}}
                                                    {{$input_mandatory}}</label>
                                                <input type="text" id="{{$input_id}}" name="{{$input_name}}"
                                                       style="{{$input_style}}"
                                                       class="form-control only-decimal" value="{{$input_value}}"
                                                       maxlength="{{$input_maxlength}}" {{$input_readonly}}>
                                            </div>
                                        </div>


                                        <div class="col-sm-4">
                                            <?php
                                            $input_value = $tower_tip_point;
                                            $input_name = "id_tower_";
                                            $input_id = "id_tower_";

                                            $input_value_hidden = $id_tower_point;
                                            $input_name_hidden = "id_tower";
                                            $input_id_hidden = "id_tower";

                                            $input_desc = __('projects.edit-points.tower');
                                            $input_readonly = 'readonly';
                                            $input_css = '';
                                            $input_mandatory = ''; //*
                                            ?>
                                            <div class="form-group">

                                                <label
                                                    class="{{ $input_css }}">{{ $input_desc }} {{$input_mandatory}}</label>
                                                <div class="d-flex align-items-center">
                                                    <!-- INPUT -->
                                                    <input type="hidden"
                                                           id="{{ $input_id_hidden }}"
                                                           name="{{ $input_name_hidden }}"
                                                           value="{{ $input_value_hidden }}">
                                                    <input type="text"
                                                           id="{{ $input_id}}"
                                                           name="{{ $input_name}}"
                                                           class="form-control"
                                                           value="{{ $input_value}}"
                                                           maxlength="{{$input_maxlength}}"
                                                           {{$input_readonly}}
                                                           style="{{$input_style}}">
                                                    <!-- BUTTON 1 -->
                                                    <button type="button" class="btn btn-success ml-2 modal90"
                                                            onclick="  getContentIDCustom('{{ $url_edit_towers.'/'.$id }}?name=id_tower&value='+ (document.getElementById('{{ $input_id_hidden }}').value || ''),'ModalShow','{{ __('projects.edit-endpoints.list_towers') }}',true);">
                                                        <i class="fa fa-arrow-alt-circle-right"
                                                           title="{{ __('projects.edit-endpoints.chose_tower') }}"></i>
                                                    </button>
                                                    <!-- BUTTON 2 -->
                                                    <button type="button" class="btn btn-danger ml-2"
                                                            onclick=" deleteElementSelected('id_tower')">
                                                        <i class="fa fa-trash"
                                                           title="{{__('projects.edit-endpoints.delete')}}"></i>
                                                    </button>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <?php

                                            $input_value = $insulator1_tip_point;
                                            $input_name = "id_insulator1_";
                                            $input_id = "id_insulator1_";

                                            $input_value_hidden = $id_insulator1_point;
                                            $input_name_hidden = "id_insulator1";
                                            $input_id_hidden = "id_insulator1";


                                            $input_desc = __('projects.edit-points.insulator1');
                                            $input_readonly = 'readonly';
                                            $input_css = '';
                                            $input_mandatory = ''; //*

                                            ?>
                                            <div class="form-group">

                                                <label
                                                    class="{{ $input_css }}">{{ $input_desc }} {{$input_mandatory}}</label>
                                                <div class="d-flex align-items-center">
                                                    <!-- INPUT -->
                                                    <input type="hidden"
                                                           id="{{ $input_id_hidden }}"
                                                           name="{{ $input_name_hidden }}"
                                                           value="{{ $input_value_hidden }}">
                                                    <input type="text"
                                                           id="{{ $input_id}}"
                                                           name="{{ $input_name}}"
                                                           class="form-control"
                                                           value="{{ $input_value}}"
                                                           maxlength="{{$input_maxlength}}"
                                                           {{$input_readonly}}
                                                           style="{{$input_style}}">
                                                    <!-- BUTTON 1 -->
                                                    <button type="button" class="btn btn-success ml-2 modal90"
                                                            onclick="  getContentIDCustom('{{ $url_edit_insulators.'/'.$id }}?name=id_insulator1&value='+ (document.getElementById('{{ $input_id_hidden }}').value || ''),'ModalShow','{{ __('projects.edit-endpoints.list_insulators') }}',true);">
                                                        <i class="fa fa-arrow-alt-circle-right"
                                                           title="{{ __('projects.edit-endpoints.chose_insulator') }}"></i>
                                                    </button>
                                                    <!-- BUTTON 2 -->
                                                    <button type="button" class="btn btn-danger ml-2"
                                                            onclick=" deleteElementSelected('id_insulator1')">
                                                        <i class="fa fa-trash"
                                                           title="{{__('projects.edit-endpoints.delete')}}"></i>
                                                    </button>
                                                </div>

                                            </div>

                                        </div>


                                        <div class="col-sm-4">
                                            <?php

                                            $input_value = $insulator2_tip_point;
                                            $input_name = "id_insulator2_";
                                            $input_id = "id_insulator2_";

                                            $input_value_hidden = $id_insulator2_point;
                                            $input_name_hidden = "id_insulator2";
                                            $input_id_hidden = "id_insulator2";


                                            $input_desc = __('projects.edit-points.insulator2');
                                            $input_readonly = 'readonly';
                                            $input_css = '';
                                            $input_mandatory = ''; //*

                                            ?>
                                            <div class="form-group">

                                                <label
                                                    class="{{ $input_css }}">{{ $input_desc }} {{$input_mandatory}}</label>
                                                <div class="d-flex align-items-center">
                                                    <!-- INPUT -->
                                                    <input type="hidden"
                                                           id="{{ $input_id_hidden }}"
                                                           name="{{ $input_name_hidden }}"
                                                           value="{{ $input_value_hidden }}">
                                                    <input type="text"
                                                           id="{{ $input_id}}"
                                                           name="{{ $input_name}}"
                                                           class="form-control"
                                                           value="{{ $input_value}}"
                                                           maxlength="{{$input_maxlength}}"
                                                           {{$input_readonly}}
                                                           style="{{$input_style}}">
                                                    <!-- BUTTON 1 -->
                                                    <button type="button" class="btn btn-success ml-2 modal90"
                                                            onclick="  getContentIDCustom('{{ $url_edit_insulators.'/'.$id }}?name=id_insulator2&value='+ (document.getElementById('{{ $input_id_hidden }}').value || ''),'ModalShow','{{ __('projects.edit-endpoints.list_insulators') }}',true);">
                                                        <i class="fa fa-arrow-alt-circle-right"
                                                           title="{{ __('projects.edit-endpoints.chose_insulator') }}"></i>
                                                    </button>
                                                    <!-- BUTTON 2 -->
                                                    <button type="button" class="btn btn-danger ml-2"
                                                            onclick=" deleteElementSelected('id_insulator2')">
                                                        <i class="fa fa-trash"
                                                           title="{{__('projects.edit-endpoints.delete')}}"></i>
                                                    </button>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-sm-2 d-flex justify-content-end align-items-end">
                                            @if ($id_point)
                                            <button type="submit"
                                                    class="btn btn-submit btn-warning float-right mb-3">
                                                {{__('projects.edit-points.edit_element')}}
                                            </button>
                                                @else
                                                <button type="submit"
                                                        class="btn btn-submit btn-success float-right mb-3">
                                                    {{__('projects.edit-points.add_element')}}
                                                </button>
                                                @endif
                                        </div>


                                    </div>
                                    {{--=========================================================--}}
                                </div>
                            </div>
                        </form>

                        @php
                            $trasaPoints = $pointsGR->map(function($row) use ($url_edit_point,$url_show_tower ) {
                                return [
                                    'x'         => (float) $row->stac_t,
                                    'y'         => (float) $row->kota_t,
                                    'id'        => (int) $row->id,
                                    'url'       => $url_edit_point . '/' . $row->id,

                                    'tower_vis' => (float) optional($row->tower)->vis,
                                    'agol_tr'   => (float) optional($row->tower)->angle,


                                    'tower_id'  => (int) optional($row->tower)->id,   // или ->id_tower (ако ти е така)
                                    'tower_url' => !empty(optional($row->tower)->id) ? ($url_show_tower . '/' . optional($row->tower)->id) : null,

                                    // за наслов во modal (ако сакаш)
                                    'tower_title' => $module->title ?? 'Tower',

                                ];
                            })->values();

                            $activePoint = !empty($point) && !empty($point->id)
                                ? [
                                    'id' => (int) $point->id,
                                    'x'  => (float) $point->stac_t,
                                    'y'  => (float) $point->kota_t,
                                    'url'=> $url_edit_point . '/' . $point->id,
                                ]
                                : null;
                        @endphp

                        <div class="card card-primary mt-3">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('projects.edit-points.profile') }}</h3>
                            </div>
                            <div class="card-body" style="height: 500px;">
                                <canvas id="trasaChart"></canvas>
                            </div>
                        </div>

                        @if(!$trasa->isEmpty())
                            <form class="form-horizontal"
                                  name="form_import"
                                  id="form_import"
                                  method="POST"
                                  action="{{  $url_import_points }}"
                                  enctype="multipart/form-data"
                                  accept-charset="UTF-8">

                                @csrf

                                <input type="hidden" id="page" name="page" value="{{ app('request')->input('page') }}">
                                <input type="hidden" id="url_return" name="url_return" value="{{$url_return_points}}">
                                <input type="hidden" id="message_error" name="message_error" value="{{ $message_error }}">
                                <input type="hidden" id="message_success" name="message_success" value="{{ $message_success }}">
                                <input type="hidden" name="query" value="{{ $query }}">

                                <div class="card card-red card-outline">
                                    <div class="card-header">
                                        <div class="row d-flex justify-content-between align-items-end">

                                            <!-- ЛЕВО: Listing -->
                                            <div class="col-sm-6 col-md-2 col-lg-1 col-xl-1">
                                                    <?php
                                                    $name = 'listing';
                                                    $desc = __('global.listing');
                                                    $options = [
                                                        1 => '1',
                                                        15 => '15',
                                                        50 => '50',
                                                        100 => '100',
                                                        200 => '200',
                                                        'a' => __('global.all'),
                                                    ];
                                                    ?>
                                                <label class="control-label">{{ $desc }}</label>
                                                <select id="{{ $name }}" name="{{ $name }}"
                                                        class="form-control form-control-sm"
                                                        onchange="changeListingAndSubmit(this.form)">
                                                    @foreach($options as $value => $label)
                                                        <option value="{{ $value }}"
                                                            {{ $listing == $value ? 'selected' : '' }}>
                                                            {{ $label }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- ДЕСНО: Upload + Import (во еден флекс див) -->
                                            <div class="col-sm-12 col-md-5 col-lg-4 col-xl-4 d-flex justify-content-end">

                                                <div class="mr-2">
                                                    <label>{!! __('projects.edit-points.import_excel') !!}</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="exel" name="exel">
                                                            <label class="custom-file-label" id="custom-file-label"></label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-2 d-flex justify-content-end align-items-end">
                                                    <label>&nbsp;</label>
                                                    <button type="submit" class="btn btn-success btn-submit">
                                                        {{ __('projects.edit-points.import') }}
                                                    </button>
                                                </div>
                                                <div class="col-sm-2 d-flex justify-content-end align-items-end">
                                                    <label>&nbsp;</label>
                                                    <a href="#"
                                                       class="btn btn-danger modal_warning"
                                                       data-toggle="modal"
                                                       data-target="#ModalWarning"

                                                       data-title="{{__('projects.edit-points.delete_warnings')}}"
                                                       data-url="{{$url_delete_imported_points.'/'.$id.'?'.$query }}"
                                                       data-content_l="id: {{$id}} "
                                                       data-content_b="{{__('projects.edit-points.delete_warnings_des')}}"
                                                       data-content_sub_l="{{__('projects.edit-points.delete_warnings_des_')}}"
                                                       data-content_sub_b=""

                                                       data-query="{{$query}}"
                                                       data-url_return="{{$url_return_points}}"
                                                       data-success="{{__('projects.edit-points.delete_success')}}"
                                                       data-error="{{__('projects.edit-points.delete_error')}}"

                                                       data-method="DELETE"

                                                       title="{{__('global.delete_hint')}}">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="card-body scrollmenu">
                                        @include('flash::message')
                                        @if(count($trasa) > 0)
                                                <?php
                                                $order = request()->query('order');
                                                $sort = (request()->query('sort') == 'asc') ? 'desc' : 'asc';
                                                ?>
                                            <div class="dataTables_wrapper dt-bootstrap4">

                                                <!-- Page =============================================================================================== -->
                                                <div class="row">
                                                    <div class="col-sm-7 col-md-6  col-lg-5 col-xl-4">
                                                        {{__('global.show_from')}}
                                                        <strong> <span
                                                                class="badge badge-warning">{{ $trasa->firstItem() }}</span></strong>
                                                        {{__('global.to')}}
                                                        <strong> <span
                                                                class="badge badge-warning">{{$trasa->lastItem() }}</span></strong>
                                                        ({{__('global.sum')}}
                                                        <strong> <span
                                                                class="badge badge-danger">{{ $trasa->total() }}</span></strong>
                                                        {{__('global.records')}})
                                                    </div>
                                                </div>
                                                <!-- Page end =============================================================================================== -->


                                                <div class="row">
                                                    <div class="col-sm-12">

                                                        <table id="example2" class="table_grid">
                                                            <thead>
                                                            <tr>
                                                                {{-- ========================================================================--}}
                                                                    <?php
                                                                    $column_name = 'id';
                                                                    $column_desc = __('projects.edit-points.id');
                                                                    $column_desc_long = __('projects.edit-points.id');
                                                                    $query_sort = request()->query('sort');
                                                                    $style_acs_desc = match (true) {
                                                                        $query_sort == 'asc' && $order == $column_name => 'asc',
                                                                        $query_sort == 'desc' && $order == $column_name => 'desc',
                                                                        $query_sort == '' => 'desc',
                                                                        default => $style_acs_desc = '',
                                                                    };
                                                                    ?>
                                                                <th class="sortable {{$style_acs_desc}}"
                                                                    style="white-space: nowrap; width: 1px;"
                                                                    onclick="orderBy('id','{{$sort}}')" title="{{$column_desc_long}}">{{$column_desc}}&nbsp;&nbsp;&nbsp;&nbsp;
                                                                </th>
                                                                {{-- ========================================================================--}}
                                                                    <?php
                                                                    $column_name = 'stac_t';
                                                                    $column_desc = __('projects.edit-points.stacionaza');
                                                                    $column_desc_long = __('projects.edit-points.stacionaza');
                                                                    $query_sort = request()->query('sort');
                                                                    $style_acs_desc = match (true) {
                                                                        $query_sort == 'asc' && $order == $column_name => 'asc',
                                                                        $query_sort == 'desc' && $order == $column_name => 'desc',
                                                                        default => $style_acs_desc = '',
                                                                    };
                                                                    ?>
                                                                <th class="sortable {{$style_acs_desc}}"
                                                                    style="white-space: nowrap; width: 1px;"
                                                                    onclick="orderBy('{{$column_name}}','{{$sort}}')" title="{{$column_desc_long}}">{{$column_desc}}
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                                </th>
                                                                {{-- ========================================================================--}}

                                                                    <?php
                                                                    $column_name = 'kota_t';
                                                                    $column_desc = __('projects.edit-points.kota');
                                                                    $column_desc_long = __('projects.edit-points.kota');
                                                                    $query_sort = request()->query('sort');
                                                                    $style_acs_desc = match (true) {
                                                                        $query_sort == 'asc' && $order == $column_name => 'asc',
                                                                        $query_sort == 'desc' && $order == $column_name => 'desc',
                                                                        default => $style_acs_desc = '',
                                                                    };
                                                                    ?>
                                                                <th class="sortable {{$style_acs_desc}}"
                                                                    style="white-space: nowrap; width: 1px;"
                                                                    onclick="orderBy('{{$column_name}}','{{$sort}}')" title="{{$column_desc_long}}">{{$column_desc}}
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                                </th>
                                                                {{-- ========================================================================--}}

                                                                    <?php
                                                                    $column_name = 'x_t';
                                                                    $column_desc = __('projects.edit-points.x');
                                                                    $column_desc_long = __('projects.edit-points.x');
                                                                    $query_sort = request()->query('sort');
                                                                    $style_acs_desc = match (true) {
                                                                        $query_sort == 'asc' && $order == $column_name => 'asc',
                                                                        $query_sort == 'desc' && $order == $column_name => 'desc',
                                                                        default => $style_acs_desc = '',
                                                                    };
                                                                    ?>
                                                                <th class="sortable {{$style_acs_desc}}"
                                                                    style="white-space: nowrap; width: 1px;"
                                                                    onclick="orderBy('{{$column_name}}','{{$sort}}')" title="{{$column_desc_long}}">{{$column_desc}}
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                                </th>
                                                                {{-- ========================================================================--}}
                                                                    <?php
                                                                    $column_name = 'agol_tr';
                                                                    $column_desc = __('projects.edit-points.agol');
                                                                    $column_desc_long = __('projects.edit-points.agol');
                                                                    $query_sort = request()->query('sort');
                                                                    $style_acs_desc = match (true) {
                                                                        $query_sort == 'asc' && $order == $column_name => 'asc',
                                                                        $query_sort == 'desc' && $order == $column_name => 'desc',
                                                                        default => $style_acs_desc = '',
                                                                    };
                                                                    ?>
                                                                <th class="sortable {{$style_acs_desc}}"
                                                                    style="white-space: nowrap; width: 1px;"
                                                                    onclick="orderBy('{{$column_name}}','{{$sort}}')" title="{{$column_desc_long}}">{{$column_desc}}
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                                </th>
                                                                {{-- ========================================================================--}}
                                                                    <?php
                                                                    $column_name = 'id_tower';
                                                                    $column_desc = __('projects.edit-points.element');
                                                                    $column_desc_long = __('projects.edit-points.element');
                                                                    $query_sort = request()->query('sort');
                                                                    $style_acs_desc = match (true) {
                                                                        $query_sort == 'asc' && $order == $column_name => 'asc',
                                                                        $query_sort == 'desc' && $order == $column_name => 'desc',
                                                                        default => $style_acs_desc = '',
                                                                    };
                                                                    ?>
                                                                <th class="sortable {{$style_acs_desc}}"
                                                                    style=""
                                                                    onclick="orderBy('{{$column_name}}','{{$sort}}')" title="{{$column_desc_long}}">{{$column_desc}}
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                                </th>
                                                                {{-- ========================================================================--}}
                                                                    <?php
                                                                    $column_name = 'id_insulator1';
                                                                    $column_desc = __('projects.edit-points.insulator1');
                                                                    $column_desc_long = __('projects.edit-points.insulator1');
                                                                    $query_sort = request()->query('sort');
                                                                    $style_acs_desc = match (true) {
                                                                        $query_sort == 'asc' && $order == $column_name => 'asc',
                                                                        $query_sort == 'desc' && $order == $column_name => 'desc',
                                                                        default => $style_acs_desc = '',
                                                                    };
                                                                    ?>
                                                                <th class="sortable {{$style_acs_desc}}"
                                                                    onclick="orderBy('{{$column_name}}','{{$sort}}')" title="{{$column_desc_long}}">{{$column_desc}}
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                                </th>
                                                                {{-- ========================================================================--}}
                                                                    <?php
                                                                    $column_name = 'id_insulator2';
                                                                    $column_desc = __('projects.edit-points.insulator2');
                                                                    $column_desc_long = __('projects.edit-points.insulator2');
                                                                    $query_sort = request()->query('sort');
                                                                    $style_acs_desc = match (true) {
                                                                        $query_sort == 'asc' && $order == $column_name => 'asc',
                                                                        $query_sort == 'desc' && $order == $column_name => 'desc',
                                                                        default => $style_acs_desc = '',
                                                                    };
                                                                    ?>
                                                                <th class="sortable {{$style_acs_desc}}"
                                                                    onclick="orderBy('{{$column_name}}','{{$sort}}')" title="{{$column_desc_long}}">{{$column_desc}}
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                                </th>
                                                                {{-- ========================================================================--}}
                                                                <th style="white-space: nowrap; width: 1px;" class="source-cell"></th>
                                                                {{-- ========================================================================--}}
                                                            </tr>
                                                            </thead>


                                                            <tbody>
                                                            @foreach($trasa as $trasa_)
                                                                    <?php


                                                                    $id = $trasa_->id ?? '';
                                                                    $stac_t = $trasa_->stac_t ?? '';
                                                                    $kota_t = $trasa_->kota_t ?? '';
                                                                    $x_t = $trasa_->x_t ?? '';
                                                                    $agol_tr = $trasa_->agol_tr ?? '';

                                                                    $id_tower = $trasa_->tower->id_tower ?? '';
                                                                    $tower_tip = $trasa_->tower->type ?? '';


                                                                    $id_trafo = $trasa_->id_trafo ?? '';
                                                                    $ime = $trasa_->trafo->ime ?? '';

                                                                    $id_insulator1 = $trasa_->insulator1->id_insulator1 ?? '';
                                                                    $insulator1_tip = $trasa_->insulator1->type ?? '';
                                                                    $insulator1_napon = $trasa_->insulator1->voltage ?? '';

                                                                    $id_insulator2 = $trasa_->insulator2->id_insulator2 ?? '';
                                                                    $insulator2_tip = $trasa_->insulator2->type ?? '';
                                                                    $insulator2_napon = $trasa_->insulator2->voltage ?? '';



                                                                    $idTrafo = $trasa_->id_trafo ?? null;

                                                                    if ($idTrafo) {
                                                                        // ако постои trafo → користи го
                                                                        $value = $trasa_->trafo->ime ?? '';
                                                                    } else {
                                                                        // ако нема trafo → прикажи tower tip
                                                                        $value = $trasa_->tower->type ?? '';
                                                                    }
                                                                    ?>





                                                                <tr  @if(in_array($id, $firstTwoIds)) style="background-color:#ffe187 " @endif>

                                                                    <td>{{ $id }}</td>
                                                                    <td>{{ $stac_t }}</td>
                                                                    <td>{{ $kota_t }}</td>
                                                                    <td>{{ $x_t }}</td>
                                                                    <td>{{ $agol_tr }}</td>
                                                                    <td>{{ $value }}</td>
{{--                                                                    <td>{{ $ime }}</td>--}}
                                                                    <td>{{ $insulator1_tip }}</td>
                                                                    <td>{{ $insulator2_tip }}</td>
                                                                    <td  class="source-cell">
                                                                        <div class="btn-group btn-group-sm">




                                                                            @if(!in_array($id, $firstTwoIds))
                                                                                <a href="{{$url_edit_point.'/'.$trasa_->id }}"
                                                                                   class="btn btn-success"><i
                                                                                        class="fa fa-edit"
                                                                                        title="{{__('global.edit_hint')}}"></i></a>

                                                                                <a href="#"
                                                                                   class="btn btn-danger modal_warning"
                                                                                   data-toggle="modal"
                                                                                   data-target="#ModalWarning"

                                                                                   data-title="{{__('global.delete_record')}}"
                                                                                   data-url="{{$url_delete_points.'/'.$id.'?'.$query }}"

                                                                                   data-content_l="id: {{$id}}, "
                                                                                   data-content_b="{{ $stac_t}}, "
                                                                                   data-content_sub_l="{{ $kota_t}}"
                                                                                   data-content_sub_b=""

                                                                                   data-query="{{$query}}"
                                                                                   data-url_return="{{$url_return_points}}"
                                                                                   data-success="{{__('global.delete_success')}}"
                                                                                   data-error="{{__('global.delete_error')}}"

                                                                                   data-method="DELETE"

                                                                                   title="{{__('global.delete_hint')}}">
                                                                                    <i class="fa fa-trash"></i>
                                                                                </a>
                                                                            @endif
                                                                        </div>

                                                                    </td>
                                                                </tr>

                                                            @endforeach
                                                            </tbody>


                                                        </table>
                                                    </div>
                                                </div>

                                                <!-- Page =============================================================================================== -->

                                                <div class="row">
                                                    <div class="col-sm-6 col-md-6">
                                                        <div class="pagination pagination-sm float-right">
                                                            {{ $trasa->withQueryString()->links('pagination::bootstrap-4')  }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Page end =============================================================================================== -->
                                            </div>
                                        @else
                                            {{__('global.no_records')}}
                                        @endif
                                    </div>

                                </div>

                            </form>
                        @else
                            {{__('global.no_records')}}
                        @endif


                    </div>
                </div>
        </section>

    </div>

@endsection

@section('additional_css')

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ url('LTE/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ url('LTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ url('LTE/plugins/toastr/toastr.min.css')}}">
@endsection


<style>





</style>

<!-- Select2 -->

<script src="{{url('LTE/plugins/chart.js/Chart.min.js')}}"></script>

<!-- REQUIRED for PAN -->
<script src="https://cdn.jsdelivr.net/npm/hammerjs@2.0.8/hammer.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom@0.7.7"></script>
<script>

    document.addEventListener("input", function (e) {
        if (e.target.classList.contains("only-decimal")) {

            let value = e.target.value;

            // 1) задржи само бројки и точки
            value = value.replace(/[^0-9.]/g, "");
            value = value.replace(/(\.\d{2}).+/g, '$1');

            // 2) дозволи само една точка
            let parts = value.split('.');
            if (parts.length > 2) {
                value = parts[0] + '.' + parts.slice(1).join('');
            }

            e.target.value = value;
        }
    });
    function changeListingAndSubmit(form) {
        // Избриши вредност на page
        let pageField = form.querySelector('input[name="page"]');
        if (pageField) {
            pageField.value = "";
        }

        form.submit();
    }

    document.addEventListener('DOMContentLoaded', function () {

        // ===== DATA FROM PHP =====
        // points: [{x, y, id, url, tower_vis, tower_ag, ...}, ...]
        const points      = @json($trasaPoints);
        const activePoint = @json($activePoint);

        if (!points || !points.length) return;

        // ===== LIMITS (IMPORTANT: include tower TOPS so they don't "go out") =====
        const xValues = points.map(p => Number(p.x));
        const yBase   = points.map(p => Number(p.y));
        const yTops   = points.map(p => Number(p.y) + (Number(p.tower_vis || 0))); // kota + tower height

        const xMin = Math.min(...xValues);
        const xMax = Math.max(...xValues);

        const yMin = Math.min(...yBase);
        const yMax = Math.max(...yTops);

        const padY = (yMax - yMin) * 0.06 || 1;

        // ===== COLORS =====
        const LINE_COLOR = 'rgba(75, 192, 192, 1)';   // keep line as-is
        const DOT_BG     = '#555';                    // dark gray points
        const DOT_BORDER = '#333';

        const RED        = 'rgba(220,53,69,1)';

        // ===== MAIN DATASET (line + dark gray points) =====

        // ===== MAIN DATASET (line + dark gray points) =====
        const mainDataset = {
            label: 'kota_t според stac_t',
            data: points,                 // contains x,y,id,url,tower_vis,agol_tr
            showLine: true,
            fill: false,

            // линијата останува тиркизна
            borderColor: 'rgba(75, 192, 192, 1)',
            lineTension: 0,

            // точки темно сиви
            pointBackgroundColor: '#c0c0c0',
            pointBorderColor: '#000',
            pointHoverBackgroundColor: '#fff',
            //pointHoverBorderColor: '#c0c0c0',
            pointRadius: 3,
            pointHoverRadius: 4,

        };

        // ===== ACTIVE POINT (red) =====
        let activeDataset = null;
        if (activePoint) {
            activeDataset = {
                label: 'Селектирана точка',
                data: [{
                    x: Number(activePoint.x),
                    y: Number(activePoint.y),
                    id: activePoint.id,
                    url: activePoint.url
                }],
                showLine: false,
                borderColor: 'rgba(220,53,69,1)',
                backgroundColor: 'rgba(220,53,69,1)',
                pointBackgroundColor: 'rgba(220,53,69,1)',
                pointBorderColor: 'rgba(220,53,69,1)',
                pointRadius: 9,
                pointHoverRadius: 11
            };
        }

        // ===== TOWERS PLUGIN (draw vertical lines for tower_vis) =====
        const towerPlugin = {
            afterDatasetsDraw: function (chart) {
                const ctx = chart.chart.ctx;
                const xScale = chart.scales['x-axis-1'];
                const yScale = chart.scales['y-axis-1'];

                // towers only from main dataset (dataset 0)
                const ds = chart.data.datasets[0];
                if (!ds || !ds.data) return;

                ctx.save();

                ds.data.forEach(p => {
                    const vis  = Number(p.tower_vis || 0);
                    const agol = Number(p.agol_tr || 0);

                    if (!vis || vis <= 0) return;

                    // ако има агол → црвен столб
                    ctx.strokeStyle = agol > 0 ? '#dc3545' : '#888';
                    ctx.lineWidth = agol > 0 ? 3 : 2;

                    const xPix = xScale.getPixelForValue(Number(p.x));

                    const yBottomVal = Number(p.y);
                    const yTopVal    = Number(p.y) + vis;

                    const yBottomPix = yScale.getPixelForValue(yBottomVal);
                    const yTopPix    = yScale.getPixelForValue(yTopVal);

                    // вертикален столб
                    ctx.beginPath();
                    ctx.moveTo(xPix, yBottomPix);
                    ctx.lineTo(xPix, yTopPix);
                    ctx.stroke();

                    // капа на врвот
                    ctx.beginPath();
                    ctx.moveTo(xPix - 5, yTopPix);
                    ctx.lineTo(xPix + 5, yTopPix);
                    ctx.stroke();
                });

                ctx.restore();
            }
        };

        const canvas = document.getElementById('trasaChart');
        const ctx = canvas.getContext('2d');

        // ===== CHART =====
        window.trasaChart = new Chart(ctx, {
            type: 'scatter',
            plugins: [towerPlugin],
            data: {
                datasets: activeDataset ? [mainDataset, activeDataset] : [mainDataset]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,

                // cursor pointer on hover
                hover: {
                    onHover: function (e, elements) {
                        const chart = window.trasaChart;
                        if (!chart) return;

                        let overTowerIndex = null;

                        const zones = chart._towerHitZones || [];
                        if (zones.length) {
                            const rect = chart.canvas.getBoundingClientRect();
                            const mx = e.clientX - rect.left;
                            const my = e.clientY - rect.top;

                            const hit = zones.find(z =>
                                mx >= z.left && mx <= z.right &&
                                my >= z.top  && my <= z.bottom
                            );

                            if (hit) {
                                overTowerIndex = hit.index;
                            }
                        }

                        // ако hover-от се сменил → redraw
                        if (chart._hoverTowerIndex !== overTowerIndex) {
                            chart._hoverTowerIndex = overTowerIndex;
                            chart.update(0);
                        }

                        const overPoint = elements && elements.length;
                        e.target.style.cursor = (overPoint || overTowerIndex !== null)
                            ? 'pointer'
                            : 'default';
                    }
                },

                // click point => redirect
                onClick: function (evt, activeElements) {
                    if (!activeElements || !activeElements.length) return;

                    const el = activeElements[0];
                    const datasetIndex = el._datasetIndex;
                    const index = el._index;

                    const p = this.data.datasets[datasetIndex].data[index];

                    if (p && p.url) {
                        window.location.href = p.url; // ✅ .../edit_point/{projectId}/{pointId}
                    }
                },

                // pan + limits
                pan: {
                    enabled: true,
                    mode: 'x',
                    rangeMin: { x: xMin },
                    rangeMax: { x: xMax },
                },

                // zoom + limits
                zoom: {
                    enabled: true,
                    mode: 'x',
                    rangeMin: { x: xMin },
                    rangeMax: { x: xMax },
                    sensitivity: 0.05
                },

                // axes
                scales: {
                    xAxes: [{
                        type: 'linear',
                        ticks: {
                            min: xMin,
                            max: xMax,
                            autoSkip: false,

                            // 👉 да ги прикаже stac_t вредностите долу (не мора сите ако се многу)
                            callback: function (value) {
                                // прикажи 2 децимали ако има потреба
                                return Number(value).toFixed(2).replace(/\.00$/, '');
                            }
                        },
                        scaleLabel: { display: true, labelString: 'stac_t' }
                    }],
                    yAxes: [{
                        ticks: { min: yMin - padY, max: yMax + padY },
                        scaleLabel: { display: true, labelString: 'kota_t' }
                    }]
                },

                // tooltip
                tooltips: {
                    callbacks: {
                        label: function (tooltipItem, data) {
                            const p = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                            const ag = (p.agol_tr !== undefined) ? Number(p.agol_tr) : null;
                            return 'ID: ' + (p.id ?? '-') +
                                ', stac_t: ' + Number(p.x).toFixed(2) +
                                ', kota_t: ' + Number(p.y).toFixed(2) +
                                (ag !== null ? (', agol_tr: ' + ag) : '');
                        }
                    }
                }
            }
        });

        // double click reset zoom
        canvas.addEventListener('dblclick', function () {
            if (window.trasaChart) window.trasaChart.resetZoom();
        });

    });

        document.addEventListener('DOMContentLoaded', function () {

        const points      = @json($trasaPoints);
        const activePoint = @json($activePoint);
        if (!points || !points.length) return;

        const xValues = points.map(p => Number(p.x));
        const yBase   = points.map(p => Number(p.y));
        const yTops   = points.map(p => Number(p.y) + (Number(p.tower_vis || 0)));

        const xMin = Math.min(...xValues);
        const xMax = Math.max(...xValues);

        const yMin = Math.min(...yBase);
        const yMax = Math.max(...yTops);

        const padY = (yMax - yMin) * 0.06 || 1;

        // ✅ уникатен key по проект (за да не се меша zoom меѓу проекти)
        const STORAGE_KEY = 'trasa_zoom_xrange_' + {{ (int)$project->id }};

        function readSavedRange() {
        try {
        const raw = localStorage.getItem(STORAGE_KEY);
        if (!raw) return null;
        const obj = JSON.parse(raw);
        if (typeof obj.min !== 'number' || typeof obj.max !== 'number') return null;
        if (obj.min >= obj.max) return null;
        return obj;
    } catch (e) {
        return null;
    }
    }

        function saveRange(chart) {
        const xs = chart.scales['x-axis-1'] || chart.scales['x-axis-0'];
        if (!xs) return;

        const min = Number(xs.options.ticks.min);
        const max = Number(xs.options.ticks.max);

        if (!isFinite(min) || !isFinite(max) || min >= max) return;

        localStorage.setItem(STORAGE_KEY, JSON.stringify({ min, max }));
    }

        function clearRange() {
        localStorage.removeItem(STORAGE_KEY);
    }

        // ===== DATASETS =====
        const mainDataset = {
        label: 'kota_t според stac_t',
        data: points,
        showLine: true,
        fill: false,
        borderColor: 'rgba(75, 192, 192, 1)',
        lineTension: 0,
        pointBackgroundColor: '#c0c0c0',
        pointBorderColor: '#000',
        pointHoverBackgroundColor: '#fff',
        pointRadius: 3,
        pointHoverRadius: 4,
    };

        let activeDataset = null;
        if (activePoint) {
        activeDataset = {
        label: 'Селектирана точка',
        data: [{
        x: Number(activePoint.x),
        y: Number(activePoint.y),
        id: activePoint.id,
        url: activePoint.url
    }],
        showLine: false,
        borderColor: 'rgba(220,53,69,1)',
        backgroundColor: 'rgba(220,53,69,1)',
        pointBackgroundColor: 'rgba(220,53,69,1)',
        pointBorderColor: 'rgba(220,53,69,1)',
        pointRadius: 9,
        pointHoverRadius: 11
    };
    }

        // ===== TOWERS PLUGIN (draw + hit zones for click) =====
            const towerPlugin = {
                afterDatasetsDraw(chart) {
                    const ctx = chart.chart.ctx;
                    const xScale = chart.scales['x-axis-1'] || chart.scales['x-axis-0'];
                    const yScale = chart.scales['y-axis-1'] || chart.scales['y-axis-0'];

                    const ds = chart.data.datasets[0];
                    if (!ds || !ds.data || !xScale || !yScale) return;

                    chart._towerHitZones = [];
                    const hoverIndex = chart._hoverTowerIndex ?? null;

                    ctx.save();

                    ds.data.forEach((p, i) => {
                        const vis = Number(p.tower_vis || 0);
                        if (!vis || vis <= 0) return;

                        const xPix = xScale.getPixelForValue(Number(p.x));
                        const yBottomVal = Number(p.y);
                        const yTopVal    = Number(p.y) + vis;

                        const yBottomPix = yScale.getPixelForValue(yBottomVal);
                        const yTopPix    = yScale.getPixelForValue(yTopVal);

                        const agol = Number(p.agol_tr || 0);
                        const isHover = (i === hoverIndex);

                        // 🎨 STYLE
                        ctx.strokeStyle = isHover
                            ? '#0d6efd'            // hover = сино
                            : (agol > 0 ? '#dc3545' : '#888');

                        ctx.lineWidth = isHover ? 5 : (agol > 0 ? 3 : 2);

                        // столб
                        ctx.beginPath();
                        ctx.moveTo(xPix, yBottomPix);
                        ctx.lineTo(xPix, yTopPix);
                        ctx.stroke();

                        // капа
                        ctx.beginPath();
                        ctx.moveTo(xPix - 6, yTopPix);
                        ctx.lineTo(xPix + 6, yTopPix);
                        ctx.stroke();

                        // HIT ZONE
                        const padX = 10;
                        const top = Math.min(yTopPix, yBottomPix);
                        const height = Math.abs(yBottomPix - yTopPix);

                        chart._towerHitZones.push({
                            index: i,
                            left: xPix - padX,
                            right: xPix + padX,
                            top: top,
                            bottom: top + height,
                            tower_url: p.tower_url || null,
                            tower_title: p.tower_title || 'Tower'
                        });
                    });

                    ctx.restore();
                }
            };


        const canvas = document.getElementById('trasaChart');
        const ctx = canvas.getContext('2d');

        // ✅ ако има снимен zoom, стартувај со него
        const saved = readSavedRange();
        const startXMin = saved ? Math.max(xMin, saved.min) : xMin;
        const startXMax = saved ? Math.min(xMax, saved.max) : xMax;

        window.trasaChart = new Chart(ctx, {
        type: 'scatter',
        plugins: [towerPlugin],
        data: { datasets: activeDataset ? [mainDataset, activeDataset] : [mainDataset] },
        options: {
        responsive: true,
        maintainAspectRatio: false,

        hover: {
        onHover: function (e, elements) {
        const chart = window.trasaChart;
        if (!chart) return;

        // ✅ ако е над точка
        let overPoint = (elements && elements.length);

        // ✅ ако е над столб (hit-zone)
        let overTower = false;
        const zones = chart._towerHitZones || [];
        if (zones.length) {
        const rect = chart.canvas.getBoundingClientRect();
        const mx = e.clientX - rect.left;
        const my = e.clientY - rect.top;
        overTower = zones.some(z => mx >= z.left && mx <= z.right && my >= z.top && my <= z.bottom);
    }

        e.target.style.cursor = (overPoint || overTower) ? 'pointer' : 'default';
    }
    },

        onClick: function (evt, activeElements) {
        const chart = this;

        // ✅ 1) прво пробај клик на столб
        const zones = chart._towerHitZones || [];
        if (zones.length) {
        const rect = chart.canvas.getBoundingClientRect();
        const mx = evt.clientX - rect.left;
        const my = evt.clientY - rect.top;

        const hit = zones.find(z => mx >= z.left && mx <= z.right && my >= z.top && my <= z.bottom);
        if (hit && hit.tower_url) {
        // ✅ отварање tower modal
        if (typeof getContentID === 'function') {
        getContentID(hit.tower_url, 'ModalShow', hit.tower_title);
    } else {
        console.warn('getContentID не е дефинирана.');
        window.location.href = hit.tower_url; // fallback
    }
        return;
    }
    }

        // ✅ 2) ако не е столб → точка
        if (!activeElements || !activeElements.length) return;

        const el = activeElements[0];
        const p = chart.data.datasets[el._datasetIndex].data[el._index];
        if (p && p.url) window.location.href = p.url;
    },

        pan: {
        enabled: true,
        mode: 'x',
        rangeMin: { x: xMin },
        rangeMax: { x: xMax },
        onPanComplete: function ({chart}) { saveRange(chart); }
    },

        zoom: {
        enabled: true,
        mode: 'x',
        rangeMin: { x: xMin },
        rangeMax: { x: xMax },
        sensitivity: 0.05,
        onZoomComplete: function ({chart}) { saveRange(chart); }
    },

        scales: {
        xAxes: [{
        type: 'linear',
        ticks: {
        min: startXMin,
        max: startXMax,
        autoSkip: false,
        callback: function (value) {
        return Number(value).toFixed(2).replace(/\.00$/, '');
    }
    },
        scaleLabel: { display: true, labelString: 'stac_t' }
    }],
        yAxes: [{
        ticks: { min: yMin - padY, max: yMax + padY },
        scaleLabel: { display: true, labelString: 'kota_t' }
    }]
    },

        tooltips: {
        callbacks: {
        label: function (tooltipItem, data) {
        const p = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
        const ag = (p.agol_tr !== undefined) ? Number(p.agol_tr) : null;
        return 'ID: ' + (p.id ?? '-') +
        ', stac_t: ' + Number(p.x).toFixed(2) +
        ', kota_t: ' + Number(p.y).toFixed(2) +
        (ag !== null ? (', agol: ' + ag) : '');
    }
    }
    }
    }
    });

        // ✅ Double-click reset + избриши го saved zoom
        canvas.addEventListener('dblclick', function () {
        if (!window.trasaChart) return;
        window.trasaChart.resetZoom();

        const xs = window.trasaChart.scales['x-axis-1'] || window.trasaChart.scales['x-axis-0'];
        if (xs) {
        xs.options.ticks.min = xMin;
        xs.options.ticks.max = xMax;
    }
        window.trasaChart.update(0);

        clearRange();
    });

    });



</script>






