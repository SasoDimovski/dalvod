@extends('admin/master')

@section('content')

    <?php
    $id_module = $module->id ?? '';
    $lang = request()->segment(2);
    $query = request()->getQueryString();
    $listing = app('request')->input('listing', config('conductors.pagination'));

    $global_style = "cursor: pointer; color: #BD362F";
    $global_style_search = "color: #f09404; ";

    $url = url('admin/' . $lang . '/' . $module->link);

    //$url_base= 'admin/'.$lang.'/'.$id_module.'/Insulators/';

    $url_create= url($url.'/create');
    $url_edit = url($url.'/edit');
    $url_show = url($url.'/show');
    $url_delete = url($url.'/delete');


    ?>
    @include('Conductors::conductors._include-functions.function-highlight-search')
        <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><i class="fa {{$module->design->icon}}"></i> {{$module->title}} <a class="btn btn-danger btn-sm" href="{{$url_create}}">{{__('global.new_record')}}</a></h1>



                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{$url}}">{{$module->title}}</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <!-- Search =============================================================================================== -->
                <form class="form-horizontal" name="form_search" id="form_search" method="get" action=""
                      accept-charset="UTF-8">
                    <input type="hidden" id="page" name="page" value="{{ app('request')->input('page') }}">
                    <!-- card card-red card-outline =============================================================================================== -->
                    <div class="card card-red card-outline">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-1 col-lg-1 col-xl-1">
                                    <?php
                                    $name = 'id';
                                    $desc = __('conductors.id');
                                    $desc_long = __('conductors.id_des');
                                    $maxlength = 100;

                                    $value = app('request')->input($name) ? app('request')->input($name) : null;
                                    $style = app('request')->input($name) ? $global_style : null;
                                    $x = app('request')->input($name) ? ('    x') : null;
                                    ?>
                                    <label class="control-label" title="{{$desc_long}}">{{$desc}}
                                        <b onclick="deleteSearchField('{{$name}}')" style="{{$style}}"
                                           title="{{__('global.delete_search_field')}}">{{$x}}</b>
                                    </label>
                                    <input type="text" id="{{$name}}" name="{{$name}}"
                                           class="form-control form-control-sm"
                                           value="{{$value}}"
                                           placeholder="{{$desc}}" maxlength="{{$maxlength}}" title="{{$desc_long}}" autocomplete="off">
                                </div>

                                <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2">
                                    <?php
                                    $name = 'type';
                                    $desc = __('conductors.type');
                                    $desc_long = __('conductors.type_des');
                                    $maxlength = 100;

                                    $value = app('request')->input($name) ? app('request')->input($name) : null;
                                    $style = app('request')->input($name) ? $global_style : null;
                                    $x = app('request')->input($name) ? ('    x') : null;
                                    ?>
                                    <label class="control-label" title="{{$desc_long}}">{{$desc}}
                                        <b onclick="deleteSearchField('{{$name}}')" style="{{$style}}"
                                           title="{{__('global.delete_search_field')}}">{{$x}}</b>
                                    </label>
                                    <input type="text" id="{{$name}}" name="{{$name}}"
                                           class="form-control form-control-sm"
                                           value="{{$value}}"
                                           placeholder="{{$desc}}" maxlength="{{$maxlength}}" title="{{$desc_long}}" autocomplete="off">
                                </div>

                                <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2">
                                    <?php
                                    $name = 'diameter';
                                    $desc = __('conductors.diameter');
                                    $desc_long = __('conductors.diameter_des');
                                    $maxlength = 100;

                                    $value = app('request')->input($name) ? app('request')->input($name) : null;
                                    $style = app('request')->input($name) ? $global_style : null;
                                    $x = app('request')->input($name) ? ('    x') : null;
                                    ?>
                                    <label class="control-label" title="{{$desc_long}}">{{$desc}}
                                        <b onclick="deleteSearchField('{{$name}}')" style="{{$style}}"
                                           title="{{__('global.delete_search_field')}}">{{$x}}</b>
                                    </label>
                                    <input type="text" id="{{$name}}" name="{{$name}}"
                                           class="form-control form-control-sm"
                                           value="{{$value}}"
                                           placeholder="{{$desc}}" maxlength="{{$maxlength}}" title="{{$desc_long}}" autocomplete="off">
                                </div>
                                <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2">
                                    <?php
                                    $name = 'mass';
                                    $desc = __('conductors.mass');
                                    $desc_long = __('conductors.mass_des');
                                    $maxlength = 20;

                                    $value = app('request')->input($name) ? app('request')->input($name) : null;
                                    $style = app('request')->input($name) ? $global_style : null;
                                    $x = app('request')->input($name) ? ('    x') : null;
                                    ?>
                                    <label class="control-label" title="{{$desc_long}}">{{$desc}}
                                        <b onclick="deleteSearchField('{{$name}}')" style="{{$style}}"
                                           title="{{__('global.delete_search_field')}}">{{$x}}</b>
                                    </label>
                                    <input type="text" id="{{$name}}" name="{{$name}}"
                                           class="form-control form-control-sm"
                                           value="{{$value}}"
                                           placeholder="{{$desc}}" maxlength="{{$maxlength}}" title="{{$desc_long}}" autocomplete="off">
                                </div>
                                <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2">
                                    <?php
                                    $name = 'model';
                                    $desc = __('conductors.model');
                                    $desc_long = __('conductors.model_des');
                                    $maxlength = 20;

                                    $value = app('request')->input($name) ? app('request')->input($name) : null;
                                    $style = app('request')->input($name) ? $global_style : null;
                                    $x = app('request')->input($name) ? ('    x') : null;
                                    ?>
                                    <label class="control-label" title="{{$desc_long}}">{{$desc}}
                                        <b onclick="deleteSearchField('{{$name}}')" style="{{$style}}"
                                           title="{{__('global.delete_search_field')}}">{{$x}}</b>
                                    </label>
                                    <input type="text" id="{{$name}}" name="{{$name}}"
                                           class="form-control form-control-sm"
                                           value="{{$value}}"
                                           placeholder="{{$desc}}" maxlength="{{$maxlength}}" title="{{$desc_long}}" autocomplete="off">
                                </div>

                                <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2">
                                    <?php
                                    $name = 'temp_exp_coeff';
                                    $desc = __('conductors.temp_exp_coeff');
                                    $desc_long = __('conductors.temp_exp_coeff_des');
                                    $maxlength = 20;

                                    $value = app('request')->input($name) ? app('request')->input($name) : null;
                                    $style = app('request')->input($name) ? $global_style : null;
                                    $x = app('request')->input($name) ? ('    x') : null;
                                    ?>
                                    <label class="control-label" title="{{$desc_long}}">{{$desc}}
                                        <b onclick="deleteSearchField('{{$name}}')" style="{{$style}}"
                                           title="{{__('global.delete_search_field')}}">{{$x}}</b>
                                    </label>
                                    <input type="text" id="{{$name}}" name="{{$name}}"
                                           class="form-control form-control-sm"
                                           value="{{$value}}"
                                           placeholder="{{$desc}}" maxlength="{{$maxlength}}" title="{{$desc_long}}" autocomplete="off">
                                </div>


                            </div>
                            <div class="row" style="height: 7px"></div>


                            <div class="row">

                                <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2">
                                    <?php
                                    $name = 'allowable_stress_normal';
                                    $desc = __('conductors.allowable_stress_normal');
                                    $desc_long = __('conductors.allowable_stress_normal_des');
                                    $maxlength = 20;

                                    $value = app('request')->input($name) ? app('request')->input($name) : null;
                                    $style = app('request')->input($name) ? $global_style : null;
                                    $x = app('request')->input($name) ? ('    x') : null;
                                    ?>
                                    <label class="control-label" title="{{$desc_long}}">{{$desc}}
                                        <b onclick="deleteSearchField('{{$name}}')" style="{{$style}}"
                                           title="{{__('global.delete_search_field')}}">{{$x}}</b>
                                    </label>
                                    <input type="text" id="{{$name}}" name="{{$name}}"
                                           class="form-control form-control-sm"
                                           value="{{$value}}"
                                           placeholder="{{$desc}}" maxlength="{{$maxlength}}" title="{{$desc_long}}" autocomplete="off">
                                </div>
                                <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2">
                                    <?php
                                    $name = 'allowable_stress_emergency';
                                    $desc = __('conductors.allowable_stress_emergency');
                                    $desc_long = __('conductors.allowable_stress_emergency_des');
                                    $maxlength = 20;

                                    $value = app('request')->input($name) ? app('request')->input($name) : null;
                                    $style = app('request')->input($name) ? $global_style : null;
                                    $x = app('request')->input($name) ? ('    x') : null;
                                    ?>
                                    <label class="control-label" title="{{$desc_long}}">{{$desc}}
                                        <b onclick="deleteSearchField('{{$name}}')" style="{{$style}}"
                                           title="{{__('global.delete_search_field')}}">{{$x}}</b>
                                    </label>
                                    <input type="text" id="{{$name}}" name="{{$name}}"
                                           class="form-control form-control-sm"
                                           value="{{$value}}"
                                           placeholder="{{$desc}}" maxlength="{{$maxlength}}" title="{{$desc_long}}" autocomplete="off">
                                </div>


                            </div>


                            <div class="row" style="height: 7px"></div>
                            <div class="row">

                                <div class="col-sm-6 col-md-2 col-lg-3 col-xl-2">
                                    <div class="row" style="height: 17px"></div>
                                    <div class="custom-control custom-checkbox">
                                        <?php
                                        $name = 'active';
                                        $desc = __('global.active');
                                        ?>
                                        <input class="custom-control-input" type="checkbox" id="{{$name}}"
                                               name="{{$name}}" value="1"
                                               {{ ((app('request')->input($name))!='')? 'checked' : '' }}  onchange="this.form.submit()" >
                                        <label for="{{$name}}"
                                               class="custom-control-label"
                                               id="{{$name}}">{{$desc}}</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <?php
                                        $name = 'deactivated';
                                        $desc = __('global.deactivated');
                                        ?>
                                        <input class="custom-control-input" type="checkbox" id="{{$name}}"
                                               name="{{$name}}" value="1"
                                               {{ ((app('request')->input($name))!='')? 'checked' : '' }}  onchange="this.form.submit()">
                                        <label for="{{$name}}"
                                               class="custom-control-label"
                                               id="{{$name}}">{{$desc}}</label>
                                    </div>

                                </div>

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
                                    <select id="{{ $name }}" name="{{ $name }}" class="form-control form-control-sm" onchange="this.form.submit()">
                                        @foreach($options as $value => $label)
                                            <option value="{{ $value }}"
                                                {{ $listing == $value ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6 col-md-2  col-lg-2 col-xl-2">
                                    <label class="control-label"> &nbsp;</label>
                                    <button type="button"
                                            class="form-control form-control-sm btn btn-outline-secondary btn-sm"
                                            title="{{__('global.reset_button_des')}}"
                                            onClick="window.open('{{ $url}}','_self');"> {{__('global.reset_button')}}
                                    </button>
                                </div>
                                <div class="col-sm-6 col-md-2  col-lg-2 col-xl-2">
                                    <label class="control-label"> &nbsp;</label>
                                    <button type="submit"
                                            class="form-control form-control-sm btn btn-outline-danger btn-sm"
                                            title="{{__('global.search_button')}} ">{{__('global.search_button')}}
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
                <!-- card card-red card-outline  END =============================================================================================== -->
                <!-- Search end=============================================================================================== -->
                @include('admin._flash-message')
                <!-- Table =============================================================================================== -->
                <div class="card card-gray card-outline">

                    <div class="card-body scrollmenu">
                        @include('flash::message')
                        @if(count($conductors) > 0)
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
                                                class="badge badge-warning">{{ $conductors->firstItem() }}</span></strong>
                                        {{__('global.to')}}
                                        <strong> <span
                                                class="badge badge-warning">{{$conductors->lastItem() }}</span></strong>
                                        ({{__('global.sum')}}
                                        <strong> <span
                                                class="badge badge-danger">{{ $conductors->total() }}</span></strong>
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
                                                    $column_desc = __('conductors.id');
                                                    $column_desc_long = __('conductors.id_des');
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
                                                <th style="white-space: nowrap; width: 1px;" class="target-cell"></th>
                                                {{-- ========================================================================--}}
                                                    <?php
                                                    $column_name = 'type';
                                                    $column_desc = __('conductors.type');
                                                    $column_desc_long = __('conductors.type_des');
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
                                                    $column_name = 'cross_section';
                                                    $column_desc = __('conductors.cross_section');
                                                    $column_desc_long = __('conductors.cross_section_des');
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
                                                    $column_name = 'diameter';
                                                    $column_desc = __('conductors.diameter');
                                                    $column_desc_long = __('conductors.diameter_des');
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
                                                    $column_name = 'mass';
                                                    $column_desc = __('conductors.mass');
                                                    $column_desc_long = __('conductors.mass_des');
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
                                                    $column_name = 'model';
                                                    $column_desc = __('conductors.model');
                                                    $column_desc_long = __('conductors.model_des');
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
                                                    $column_name = 'temp_exp_coeff';
                                                    $column_desc = __('conductors.temp_exp_coeff');
                                                    $column_desc_long = __('conductors.temp_exp_coeff_des');
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
                                                    $column_name = 'allowable_stress_normal';
                                                    $column_desc = __('conductors.allowable_stress_normal');
                                                    $column_desc_long = __('conductors.allowable_stress_normal_des');
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
                                                    $column_name = 'allowable_stress_emergency';
                                                    $column_desc = __('conductors.allowable_stress_emergency');
                                                    $column_desc_long = __('conductors.allowable_stress_emergency_des');
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
                                                <th style="white-space: nowrap; width: 1px;"><i class="fas fa-lock"  title="{{__('global.active_status')}}"></i>
                                                </th>
                                                {{-- ========================================================================--}}
                                                <th style="white-space: nowrap; width: 1px;" class="source-cell"></th>
                                                {{-- ========================================================================--}}
                                            </tr>
                                            </thead>


                                            <tbody>
                                            @foreach($conductors as $conductor)

                                                <tr @if($conductor->active == 0) style="color: #cccccc" @endif>
                                                    <td>{!! highlightSearch($conductor->id, 'id', $global_style_search) !!}</td>
                                                    <td  class="target-cell"> </td>
                                                    <td>{!! highlightSearch($conductor->type, 'type', $global_style_search) !!}</td>
                                                    <td>{!! highlightSearch($conductor->cross_section, 'cross_section', $global_style_search) !!}</td>
                                                    <td>{!! highlightSearch($conductor->diameter, 'diameter', $global_style_search) !!}</td>
                                                    <td>{!! highlightSearch($conductor->mass, 'mass', $global_style_search) !!}</td>
                                                    <td>{!! highlightSearch($conductor->model, 'model', $global_style_search) !!}</td>

                                                    @php
                                                        $v = sprintf('%.15f', (float)$conductor->temp_exp_coeff); // доволно децимали
                                                        $v = rtrim(rtrim($v, '0'), '.'); // тргни trailing zeros и точка
                                                    @endphp
                                                    <td>{!! highlightSearch($v, 'temp_exp_coeff', $global_style_search) !!}</td>
                                                    <td>{!! highlightSearch($conductor->allowable_stress_normal, 'allowable_stress_normal', $global_style_search) !!}</td>
                                                    <td>{!! highlightSearch($conductor->allowable_stress_emergency, 'allowable_stress_emergency', $global_style_search) !!}</td>
                                                    <td>
                                                        @if($conductor->active == 0)
                                                            <i class="fas fa-lock"
                                                               title="{{__('global.deactivated')}}"></i>
                                                        @endif
                                                    </td>
                                                    <td  class="source-cell">
                                                        <div class="btn-group btn-group-sm">
                                                            {{-------------------------------------------------------------------------------------------------------}}
                                                            <button class="btn btn-info"
{{--                                                                    onclick="getContentID('{{ $conductor->id }}','{{ $lang }}','{{ $id_module }}','ModalShow','{{ $module->title}}','Insulators')">--}}
                                                                    onclick="getContentID('{{$url_show.'/'. $conductor->id }}','ModalShow','{{ $module->title}}'); return false;">
                                                                <i class="fas fa-eye"
                                                                   title="{{__('global.show_hint')}}"></i></button>
                                                            {{-------------------------------------------------------------------------------------------------------}}
                                                            @if((Auth::id() != 1)&&($conductor->id !=1)||(Auth::id() == 1))
                                                                {{-------------------------------------------------------------------------------------------------------}}
                                                                <a href="{{$url_edit.'/'.$conductor->id.'?'.$query }}"
                                                                   class="btn btn-success"><i
                                                                        class="fa fa-edit"
                                                                        title="{{__('global.edit_hint')}}"></i></a>
                                                                {{-------------------------------------------------------------------------------------------------------}}
                                                                <a href="#" class="btn btn-danger modal_warning"
                                                                   data-toggle="modal"
                                                                   data-target="#ModalWarning"

                                                                   data-title="{{__('global.delete_record')}}"
                                                                   data-url="{{$url_delete.'/'.$conductor->id.'?'.$query }}"

                                                                   data-content_l="id: {{$conductor->id}}, "
                                                                   data-content_b="{{ $conductor->type}} "
                                                                   data-content_sub_l=""
                                                                   data-content_sub_b=""

                                                                   data-query="{{$query}}"
                                                                   data-url_return="{{$url}}"
                                                                   data-success="{{__('global.delete_success')}}"
                                                                   data-error="{{__('global.delete_error')}}"

                                                                   data-method="DELETE"

                                                                   title="{{__('global.delete_hint')}}">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                                {{-------------------------------------------------------------------------------------------------------}}
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

                                            <?php
                                            $query = request()->getQueryString();
                                            if (empty($query)) {
                                                $query = 'r';
                                            }
                                            ?>
{{--                                        <a class="btn btn-default btn-sm"
                                           href="{{ $url_pdf}}"
                                           title="{{__('global.export_pdf')}}"><i
                                                class="fa fa-print"></i> {{__('global.export_pdf')}}
                                        </a>
                                        <a class="btn btn-default btn-sm"
                                           href="{{$url_excel}}"
                                           title="{{__('global.export_csv')}}"><i
                                                class="fa fa-print"></i> {{__('global.export_csv')}}
                                        </a>--}}
                                    </div>


                                    <div class="col-sm-6 col-md-6">
                                        <div class="pagination pagination-sm float-right">
                                            {{ $conductors->withQueryString()->links('pagination::bootstrap-4')  }}
                                        </div>

                                    </div>

                                </div>
                                <!-- Page end =============================================================================================== -->
                            </div>
                        @else
                            {{__('global.no_records')}}
                        @endif
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <!-- Table end =============================================================================================== -->


            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->


    </div>



@endsection
@section('additional_css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ url('LTE/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ url('LTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <style>
        .daterangepicker.single .drp-buttons {
            display: block !important;
        }
        .target-cell {
            display: none;
        }

        @media (max-width: 1400px) {
            .source-cell {
                display: none;
            }

            .target-cell {
                display: table-cell;
            }
        }
    </style>
@endsection
@section('additional_js')
    <!-- Select2 -->
    <script src="{{url('LTE/plugins/select2/js/select2.full.min.js')}}"></script>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })
    </script>
@endsection
