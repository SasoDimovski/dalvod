@extends('admin/master')

@section('content')

    <?php
    $id_module = $module->id ?? '';
    $lang = request()->segment(2);
    $query = request()->getQueryString();
    $listing = app('request')->input('listing', config('insulators.pagination'));

    $global_style = "cursor: pointer; color: #BD362F";
    $global_style_search = "color: #f09404; ";

    $url = url('admin/' . $lang . '/' . $module->link);

    //$url_base= 'admin/'.$lang.'/'.$id_module.'/Insulators/';

    $url_create= url($url.'/create');
    $url_edit = url($url.'/edit');
    $url_show = url($url.'/show');
    $url_delete = url($url.'/delete');


    ?>
    @include('Insulators::insulators._include-functions.function-highlight-search')
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
                                    $desc = __('insulators.id');
                                    $desc_long = __('insulators.id_des');
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
                                           placeholder="{{$desc}}" maxlength="{{$maxlength}}" title="{{$desc_long}}">
                                </div>

                                <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2">
                                    <?php
                                    $name = 'sifra';
                                    $desc = __('insulators.sifra');
                                    $desc_long = __('insulators.sifra_des');
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
                                           placeholder="{{$desc}}" maxlength="{{$maxlength}}" title="{{$desc_long}}">
                                </div>
                                <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2">
                                    <?php
                                    $name = 'type';
                                    $desc = __('insulators.type');
                                    $desc_long = __('insulators.type_des');
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
                                           placeholder="{{$desc}}" maxlength="{{$maxlength}}" title="{{$desc_long}}">
                                </div>
                                <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2">
                                    <?php
                                    $name = 'length';
                                    $desc = __('insulators.length');
                                    $desc_long = __('insulators.length_des');
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
                                           placeholder="{{$desc}}" maxlength="{{$maxlength}}" title="{{$desc_long}}">
                                </div>
                                <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2">
                                    <?php
                                    $name = 'mass';
                                    $desc = __('insulators.mass');
                                    $desc_long = __('insulators.mass_des');
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
                                           placeholder="{{$desc}}" maxlength="{{$maxlength}}" title="{{$desc_long}}">
                                </div>
                                <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2">
                                    <?php
                                    $name = 'massd';
                                    $desc = __('insulators.massd');
                                    $desc_long = __('insulators.massd_des');
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
                                           placeholder="{{$desc}}" maxlength="{{$maxlength}}" title="{{$desc_long}}">
                                </div>


                            </div>
                            <div class="row" style="height: 7px"></div>

                            <div class="row">
                                <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2">
                                    <div class="custom-control custom-checkbox">
                                        <?php
                                        $name = 'support_insulator';
                                        $desc = __('insulators.support_insulator');
                                        ?>
                                        <input class="custom-control-input" type="checkbox" id="{{$name}}"
                                               name="{{$name}}" value="1"
                                               {{ ((app('request')->input($name))!='')? 'checked' : '' }}  onchange="this.form.submit()">
                                        <label for="{{$name}}"
                                               class="custom-control-label"
                                               id="{{$name}}">{{$desc}}</label>
                                    </div>
                                </div>


                            </div>
                            <div class="row" style="height: 7px"></div>

                            <div class="row">

                                <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2">
                                    <?php
                                    $name = 'voltage';
                                    $desc = __('insulators.voltage');
                                    $desc_long = __('insulators.voltage_des');

                                    $value = app('request')->input($name) ? app('request')->input($name) : null;
                                    $style = app('request')->input($name) ? $global_style : null;
                                    $x = app('request')->input($name) ? ('    x') : null;
                                    ?>
                                    <label class="control-label" title="{{$desc_long}}">{{$desc}}
                                        <b onclick="deleteSearchField('{{$name}}')" style="{{$style}}"
                                           title="{{__('global.delete_search_field')}}">{{$x}}</b>
                                    </label>
                                    <select class="select2bs4"
                                            id="{{$name}}" name="{{$name}}" onchange="this.form.submit()"
                                            style="width: 100%" title="{{$desc_long}}">
                                        @if(count($voltages) > 0)
                                            <option value="">&nbsp;</option>
                                            @foreach($voltages as $voltage)
                                                <option
                                                    value="{{$voltage->title}}" {{ ((app('request')->input($name))==$voltage->title)? 'selected' : '' }}>{{$voltage->title}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2">
                                    <?php
                                    $name = 'id_insulator_chain';
                                    $desc = __('insulators.id_insulator_chain');
                                    $desc_long = __('insulators.id_insulator_chain_des');

                                    $value = app('request')->input($name) ? app('request')->input($name) : null;
                                    $style = app('request')->input($name) ? $global_style : null;
                                    $x = app('request')->input($name) ? ('    x') : null;
                                    ?>
                                    <label class="control-label" title="{{$desc_long}}">{{$desc}}
                                        <b onclick="deleteSearchField('{{$name}}')" style="{{$style}}"
                                           title="{{__('global.delete_search_field')}}">{{$x}}</b>
                                    </label>
                                    <select class="select2bs4"
                                            id="{{$name}}" name="{{$name}}" onchange="this.form.submit()"
                                            style="width: 100%" title="{{$desc_long}}">
                                        @if(count($insulator_chain) > 0)
                                            <option value="">&nbsp;</option>
                                            @foreach($insulator_chain as $insulator_chain_)
                                                <option
                                                    value="{{$insulator_chain_->id}}" {{ ((app('request')->input($name))==$insulator_chain_->id)? 'selected' : '' }}>{{$insulator_chain_->title}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2">
                                    <?php
                                    $name = 'number';
                                    $desc = __('insulators.number');
                                    $desc_long = __('insulators.number_des');

                                    $value = app('request')->input($name) ? app('request')->input($name) : null;
                                    $style = app('request')->input($name) ? $global_style : null;
                                    $x = app('request')->input($name) ? ('    x') : null;
                                    ?>
                                    <label class="control-label" title="{{$desc_long}}">{{$desc}}
                                        <b onclick="deleteSearchField('{{$name}}')" style="{{$style}}"
                                           title="{{__('global.delete_search_field')}}">{{$x}}</b>
                                    </label>
                                    <select class="select2bs4"
                                            id="{{$name}}" name="{{$name}}" onchange="this.form.submit()"
                                            style="width: 100%" title="{{$desc_long}}">

                                            <option value="">&nbsp;</option>

                                            @for($i = 1; $i <= 24; $i++)
                                                <option value="{{ $i }}" {{ ((app('request')->input($name)) == $i) ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                    </select>
                                </div>

                                <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2">
                                    <?php
                                    $name = 'breaking_load';
                                    $desc = __('insulators.breaking_load');
                                    $desc_long = __('insulators.breaking_load_des');

                                    $value = app('request')->input($name) ? app('request')->input($name) : null;
                                    $style = app('request')->input($name) ? $global_style : null;
                                    $x = app('request')->input($name) ? ('    x') : null;
                                    ?>
                                    <label class="control-label" title="{{$desc_long}}">{{$desc}}
                                        <b onclick="deleteSearchField('{{$name}}')" style="{{$style}}"
                                           title="{{__('global.delete_search_field')}}">{{$x}}</b>
                                    </label>
                                    <select class="select2bs4"
                                            id="{{$name}}" name="{{$name}}" onchange="this.form.submit()"
                                            style="width: 100%" title="{{$desc_long}}">

                                        <option value="">&nbsp;</option>

                                        <option value="">&nbsp;</option>
                                        <option value="1.25" {{ ((app('request')->input($name))=='1.25') ? 'selected' : '' }}>1.25</option>
                                        <option value="80" {{ ((app('request')->input($name))=='80') ? 'selected' : '' }}>80</option>
                                        <option value="120" {{ ((app('request')->input($name))=='120') ? 'selected' : '' }}>120</option>
                                        <option value="160" {{ ((app('request')->input($name))=='160') ? 'selected' : '' }}>160</option>
                                        <option value="320" {{ ((app('request')->input($name))=='320') ? 'selected' : '' }}>320</option>
                                    </select>
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
                                               {{ ((app('request')->input($name))!='')? 'checked' : '' }}  onchange="this.form.submit()">
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
                        @if(count($insulators) > 0)
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
                                                class="badge badge-warning">{{ $insulators->firstItem() }}</span></strong>
                                        {{__('global.to')}}
                                        <strong> <span
                                                class="badge badge-warning">{{$insulators->lastItem() }}</span></strong>
                                        ({{__('global.sum')}}
                                        <strong> <span
                                                class="badge badge-danger">{{ $insulators->total() }}</span></strong>
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
                                                    $column_desc = __('insulators.id');
                                                    $column_desc_long = __('insulators.id_des');
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
                                                    $column_name = 'sifra';
                                                    $column_desc = __('insulators.sifra');
                                                    $column_desc_long = __('insulators.sifra_des');
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
                                                    $column_name = 'type';
                                                    $column_desc = __('insulators.type');
                                                    $column_desc_long = __('insulators.type_des');
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
                                                    $column_name = 'voltage';
                                                    $column_desc = __('insulators.voltage');
                                                    $column_desc_long = __('insulators.voltage_des');
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
                                                    $column_name = 'length';
                                                    $column_desc = __('insulators.length');
                                                    $column_desc_long = __('insulators.length_des');
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
                                                    $column_desc = __('insulators.mass');
                                                    $column_desc_long = __('insulators.mass_des');
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
                                                    $column_name = 'massd';
                                                    $column_desc = __('insulators.massd');
                                                    $column_desc_long = __('insulators.massd_des');
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
                                                    $column_name = 'id_insulator_chain';
                                                    $column_desc = __('insulators.id_insulator_chain');
                                                    $column_desc_long = __('insulators.id_insulator_chain_des');
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
                                                    $column_name = 'support_insulator';
                                                    $column_desc = __('insulators.support_insulator');
                                                    $column_desc_long = __('insulators.support_insulator_des');
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
                                                    $column_name = 'number';
                                                    $column_desc = __('insulators.number');
                                                    $column_desc_long = __('insulators.number_des');
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
                                                    $column_name = 'breaking_load';
                                                    $column_desc = __('insulators.breaking_load');
                                                    $column_desc_long = __('insulators.breaking_load_des');
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
                                            @foreach($insulators as $insulator)

                                                <tr @if($insulator->active == 0) style="color: #cccccc" @endif>
                                                    <td>{!! highlightSearch($insulator->id, 'id', $global_style_search) !!}</td>
                                                    <td  class="target-cell"> </td>
                                                    <td>{!! highlightSearch($insulator->sifra, 'sifra', $global_style_search) !!}</td>
                                                    <td>{!! highlightSearch($insulator->type, 'type', $global_style_search) !!}</td>
                                                    <td>{!! $insulator->voltage !!}</td>
                                                    <td>{!! highlightSearch($insulator->length, 'length', $global_style_search) !!}</td>
                                                    <td>{!! highlightSearch($insulator->mass, 'mass', $global_style_search) !!}
{{--                                                        @if($insulator->comment)--}}
{{--                                                            &nbsp;<i class="fas fa-comment text-warning" title="{{ __('insulators.comment')}}: {{$insulator->comment}}"></i>--}}

{{--                                                        @endif--}}
                                                    </td>

                                                    <td>{!! highlightSearch($insulator->massd, 'massd', $global_style_search) !!}</td>
                                                    <td>{!! highlightSearch($insulator->insulatorChain->title, 'id_insulator_chain', $global_style_search) !!}</td>
                                                    <td  class="text-center">

                                                        @if($insulator->support_insulator == 1)
                                                            <i class="fas fa-check-circle"
                                                               title="{{__('insulators.support_insulator')}}"></i>
                                                        @endif



                                                    </td>
                                                    <td>{!! highlightSearch($insulator->number, 'number', $global_style_search) !!}</td>
                                                    <td>{!! highlightSearch($insulator->breaking_load, 'breaking_load', $global_style_search) !!}</td>
                                                    <td>
                                                        @if($insulator->active == 0)
                                                            <i class="fas fa-lock"
                                                               title="{{__('global.deactivated')}}"></i>
                                                        @endif
                                                    </td>
                                                    <td  class="source-cell">
                                                        <div class="btn-group btn-group-sm">
                                                            {{-------------------------------------------------------------------------------------------------------}}
                                                            <button class="btn btn-info"
{{--                                                                    onclick="getContentID('{{ $insulator->id }}','{{ $lang }}','{{ $id_module }}','ModalShow','{{ $module->title}}','Insulators')">--}}
                                                                    onclick="getContentID('{{$url_show.'/'. $insulator->id }}','ModalShow','{{ $module->title}}'); return false;">
                                                                <i class="fas fa-eye"
                                                                   title="{{__('global.show_hint')}}"></i></button>
                                                            {{-------------------------------------------------------------------------------------------------------}}
                                                            @if((Auth::id() != 1)&&($insulator->id !=1)||(Auth::id() == 1))
                                                                {{-------------------------------------------------------------------------------------------------------}}
                                                                <a href="{{$url_edit.'/'.$insulator->id.'?'.$query }}"
                                                                   class="btn btn-success"><i
                                                                        class="fa fa-edit"
                                                                        title="{{__('global.edit_hint')}}"></i></a>
                                                                {{-------------------------------------------------------------------------------------------------------}}
                                                                <a href="#" class="btn btn-danger modal_warning"
                                                                   data-toggle="modal"
                                                                   data-target="#ModalWarning"

                                                                   data-title="{{__('global.delete_record')}}"
                                                                   data-url="{{$url_delete.'/'.$insulator->id.'?'.$query }}"

                                                                   data-content_l="id: {{$insulator->id}}, "
                                                                   data-content_b="{{ $insulator->type}} "
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
                                            {{ $insulators->withQueryString()->links('pagination::bootstrap-4')  }}
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
