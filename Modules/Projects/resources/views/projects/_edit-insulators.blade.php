

<?php
$id_module = $module->id ?? '';
$lang = request()->segment(2);
$query = request()->getQueryString();
$listing = app('request')->input('listing', config('insulators.pagination'));

$global_style = "cursor: pointer; color: #BD362F";
$global_style_search = "color: #f09404; ";

$url = url('admin/' . $lang . '/' . $module->link);

//$url_base= 'admin/'.$lang.'/'.$id_module.'/insulators/';

$url_create= url($url.'/create');
$url_edit = url($url.'/edit');
$url_show = url($url.'/show');
$url_delete = url($url.'/delete');


$id = request()->segment(6);
$url_edit_insulators = $url . '/insulators/'.$id;

$path_upload = 'uploads/insulators/';
?>
@include('insulators::insulators._include-functions.function-highlight-search')
<!-- Content Wrapper. Contains page content -->





<div class="container-fluid">

    <!-- Search =============================================================================================== -->
    <form class="form-horizontal" name="form_search" id="form_search" method="get" action="{{ $url_edit_insulators }}"
          accept-charset="UTF-8" autocomplete="off">
        <input type="hidden" id="page" name="page" value="{{ app('request')->input('page') }}">
        <input type="hidden" id="container" name="container" value="edit-elements-container">

        <input type="hidden" name="order" id="order"
               value="{{ request()->query('order') }}">
        <input type="hidden" name="sort" id="sort"
               value="{{ request()->query('sort') }}">
        <input type="hidden" id="name" name="name" value="{{ app('request')->input('name') }}">
        <input type="hidden" id="value" name="value" value="{{ app('request')->input('value') }}">


        <!-- card card-red card-outline =============================================================================================== -->
        <div class="card card-red card-outline">
            <div class="card-body">
                <div class="row">
                    {{$query}}
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-1 col-lg-1 col-xl-1">
                        <?php
                        $name = 'id';
                        $desc = __('projects.edit-insulators.id');
                        $desc_long = __('projects.edit-insulators.id_des');
                        $maxlength = 100;

                        $value = app('request')->input($name) ? app('request')->input($name) : null;
                        $style = app('request')->input($name) ? $global_style : null;
                        $x = app('request')->input($name) ? ('    x') : null;
                        ?>
                        <label class="control-label" title="{{$desc_long}}">{{$desc}}
                            <b onclick="deleteSearchFieldElements('{{$name}}')" style="{{$style}}"
                               title="{{__('global.delete_search_field')}}">{{$x}}</b>
                        </label>
                        <input type="text" id="{{$name}}" name="{{$name}}"
                               class="form-control form-control-sm"
                               value="{{$value}}"
                               placeholder="{{$desc}}" maxlength="{{$maxlength}}" title="{{$desc_long}}">
                    </div>
                    <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2">
                        <?php
                        $name = 'voltage';
                        $desc = __('projects.edit-insulators.voltage');
                        $desc_long = __('projects.edit-insulators.voltage_des');

                        $value = app('request')->input($name) ? app('request')->input($name) : null;
                        $style = app('request')->input($name) ? $global_style : null;
                        $x = app('request')->input($name) ? ('    x') : null;
                        ?>
                        <label class="control-label" title="{{$desc_long}}">{{$desc}}
                            <b onclick="deleteSearchFieldElements('{{$name}}')" style="{{$style}}"
                               title="{{__('global.delete_search_field')}}">{{$x}}</b>
                        </label>
                        <select class="form-control form-control-sm"
                                id="{{$name}}" name="{{$name}}" onchange="dropdownChangeElements()"
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
                        $name = 'type';
                        $desc = __('projects.edit-insulators.type');
                        $desc_long = __('projects.edit-insulators.type_des');
                        $maxlength = 100;

                        $value = app('request')->input($name) ? app('request')->input($name) : null;
                        $style = app('request')->input($name) ? $global_style : null;
                        $x = app('request')->input($name) ? ('    x') : null;
                        ?>
                        <label class="control-label" title="{{$desc_long}}">{{$desc}}
                            <b onclick="deleteSearchFieldElements('{{$name}}')" style="{{$style}}"
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
                        $desc = __('projects.edit-insulators.length');
                        $desc_long = __('projects.edit-insulators.length_des');
                        $maxlength = 100;

                        $value = app('request')->input($name) ? app('request')->input($name) : null;
                        $style = app('request')->input($name) ? $global_style : null;
                        $x = app('request')->input($name) ? ('    x') : null;
                        ?>
                        <label class="control-label" title="{{$desc_long}}">{{$desc}}
                            <b onclick="deleteSearchFieldElements('{{$name}}')" style="{{$style}}"
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
                        $desc = __('projects.edit-insulators.mass');
                        $desc_long = __('projects.edit-insulators.mass_des');
                        $maxlength = 20;

                        $value = app('request')->input($name) ? app('request')->input($name) : null;
                        $style = app('request')->input($name) ? $global_style : null;
                        $x = app('request')->input($name) ? ('    x') : null;
                        ?>
                        <label class="control-label" title="{{$desc_long}}">{{$desc}}
                            <b onclick="deleteSearchFieldElements('{{$name}}')" style="{{$style}}"
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
                        $desc = __('projects.edit-insulators.massd');
                        $desc_long = __('projects.edit-insulators.massd_des');
                        $maxlength = 20;

                        $value = app('request')->input($name) ? app('request')->input($name) : null;
                        $style = app('request')->input($name) ? $global_style : null;
                        $x = app('request')->input($name) ? ('    x') : null;
                        ?>
                        <label class="control-label" title="{{$desc_long}}">{{$desc}}
                            <b onclick="deleteSearchFieldElements('{{$name}}')" style="{{$style}}"
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
                            $desc = __('projects.edit-insulators.support_insulator');
                            ?>
                            <input class="custom-control-input" type="checkbox" id="{{$name}}"
                                   name="{{$name}}" value="1"
                                   {{ ((app('request')->input($name))!='')? 'checked' : '' }}  onchange="checkboxChangeElements()">
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
                        $name = 'id_insulator_chain';
                        $desc = __('projects.edit-insulators.id_insulator_chain');
                        $desc_long = __('projects.edit-insulators.id_insulator_chain_des');

                        $value = app('request')->input($name) ? app('request')->input($name) : null;
                        $style = app('request')->input($name) ? $global_style : null;
                        $x = app('request')->input($name) ? ('    x') : null;
                        ?>
                        <label class="control-label" title="{{$desc_long}}">{{$desc}}
                            <b onclick="deleteSearchFieldElements('{{$name}}')" style="{{$style}}"
                               title="{{__('global.delete_search_field')}}">{{$x}}</b>
                        </label>
                        <select class="form-control form-control-sm"
                                id="{{$name}}" name="{{$name}}" onchange="dropdownChangeElements()"
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
                        $desc = __('projects.edit-insulators.number');
                        $desc_long = __('projects.edit-insulators.number_des');

                        $value = app('request')->input($name) ? app('request')->input($name) : null;
                        $style = app('request')->input($name) ? $global_style : null;
                        $x = app('request')->input($name) ? ('    x') : null;
                        ?>
                        <label class="control-label" title="{{$desc_long}}">{{$desc}}
                            <b onclick="deleteSearchFieldElements('{{$name}}')" style="{{$style}}"
                               title="{{__('global.delete_search_field')}}">{{$x}}</b>
                        </label>
                        <select class="form-control form-control-sm"
                                id="{{$name}}" name="{{$name}}" onchange="dropdownChangeElements()"
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
                        $desc = __('projects.edit-insulators.breaking_load');
                        $desc_long = __('projects.edit-insulators.breaking_load_des');

                        $value = app('request')->input($name) ? app('request')->input($name) : null;
                        $style = app('request')->input($name) ? $global_style : null;
                        $x = app('request')->input($name) ? ('    x') : null;
                        ?>
                        <label class="control-label" title="{{$desc_long}}">{{$desc}}
                            <b onclick="deleteSearchFieldElements('{{$name}}')" style="{{$style}}"
                               title="{{__('global.delete_search_field')}}">{{$x}}</b>
                        </label>
                        <select class="form-control form-control-sm"
                                id="{{$name}}" name="{{$name}}"  onchange="dropdownChangeElements()"
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
                                   {{ ((app('request')->input($name))!='')? 'checked' : '' }}  onchange="checkboxChangeElements()">
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
                                   {{ ((app('request')->input($name))!='')? 'checked' : '' }}  onchange="checkboxChangeElements()">
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
                        <select id="{{ $name }}" name="{{ $name }}" class="form-control form-control-sm" onchange="dropdownChangeElements()">
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
                                onClick="resetSearchElements('{{ app('request')->input('value') }}', '{{ app('request')->input('name') }}')"> {{__('global.reset_button')}}
                        </button>
                    </div>
                    <div class="col-sm-6 col-md-2  col-lg-2 col-xl-2">
                        <label class="control-label"> &nbsp;</label>
                        {{--                        <button type="submit"--}}
                        {{--                                class="form-control form-control-sm btn btn-submit ajax btn-outline-danger btn-sm"--}}
                        {{--                                title="{{__('global.search_button')}} ">{{__('global.search_button')}}--}}
                        {{--                        </button>--}}
                        <button type="button"
                                class="form-control form-control-sm btn btn-outline-danger btn-sm"
                                onclick="searchElements()"
                                title="{{ __('global.search_button') }}">
                            {{ __('global.search_button') }}
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </form>
    <!-- card card-red card-outline  END =============================================================================================== -->
    <!-- Search end=============================================================================================== -->

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
                                        $column_desc = __('projects.edit-insulators.id');
                                        $column_desc_long = __('projects.edit-insulators.id_des');
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
                                        onclick="orderByElements('id','{{$sort}}')" title="{{$column_desc_long}}">{{$column_desc}}&nbsp;&nbsp;&nbsp;&nbsp;
                                    </th>
                                    {{-- ========================================================================--}}
                                    <th style="white-space: nowrap; width: 1px;" class="target-cell"></th>
                                    {{-- ========================================================================--}}

                                        <?php
                                        $column_name = 'type';
                                        $column_desc = __('projects.edit-insulators.type');
                                        $column_desc_long = __('projects.edit-insulators.type_des');
                                        $query_sort = request()->query('sort');
                                        $style_acs_desc = match (true) {
                                            $query_sort == 'asc' && $order == $column_name => 'asc',
                                            $query_sort == 'desc' && $order == $column_name => 'desc',
                                            default => $style_acs_desc = '',
                                        };
                                        ?>
                                    <th class="sortable {{$style_acs_desc}}"

                                        onclick="orderByElements('{{$column_name}}','{{$sort}}')" title="{{$column_desc_long}}">{{$column_desc}}
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                    </th>
                                    {{-- ========================================================================--}}
                                        <?php
                                        $column_name = 'voltage';
                                        $column_desc = __('projects.edit-insulators.voltage');
                                        $column_desc_long = __('projects.edit-insulators.voltage_des');
                                        $query_sort = request()->query('sort');
                                        $style_acs_desc = match (true) {
                                            $query_sort == 'asc' && $order == $column_name => 'asc',
                                            $query_sort == 'desc' && $order == $column_name => 'desc',
                                            default => $style_acs_desc = '',
                                        };
                                        ?>
                                    <th class="sortable {{$style_acs_desc}}"

                                        onclick="orderByElements('{{$column_name}}','{{$sort}}')" title="{{$column_desc_long}}">{{$column_desc}}
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                    </th>
                                    {{-- ========================================================================--}}
                                        <?php
                                        $column_name = 'length';
                                        $column_desc = __('projects.edit-insulators.length');
                                        $column_desc_long = __('projects.edit-insulators.length_des');
                                        $query_sort = request()->query('sort');
                                        $style_acs_desc = match (true) {
                                            $query_sort == 'asc' && $order == $column_name => 'asc',
                                            $query_sort == 'desc' && $order == $column_name => 'desc',
                                            default => $style_acs_desc = '',
                                        };
                                        ?>
                                    <th class="sortable {{$style_acs_desc}}"

                                        onclick="orderByElements('{{$column_name}}','{{$sort}}')" title="{{$column_desc_long}}">{{$column_desc}}
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                    </th>
                                    {{-- ========================================================================--}}
                                        <?php
                                        $column_name = 'mass';
                                        $column_desc = __('projects.edit-insulators.mass');
                                        $column_desc_long = __('projects.edit-insulators.mass_des');
                                        $query_sort = request()->query('sort');
                                        $style_acs_desc = match (true) {
                                            $query_sort == 'asc' && $order == $column_name => 'asc',
                                            $query_sort == 'desc' && $order == $column_name => 'desc',
                                            default => $style_acs_desc = '',
                                        };
                                        ?>
                                    <th class="sortable {{$style_acs_desc}}"
                                        onclick="orderByElements('{{$column_name}}','{{$sort}}')" title="{{$column_desc_long}}">{{$column_desc}}
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                    </th>
                                    {{-- ========================================================================--}}
                                        <?php
                                        $column_name = 'massd';
                                        $column_desc = __('projects.edit-insulators.massd');
                                        $column_desc_long = __('projects.edit-insulators.massd_des');
                                        $query_sort = request()->query('sort');
                                        $style_acs_desc = match (true) {
                                            $query_sort == 'asc' && $order == $column_name => 'asc',
                                            $query_sort == 'desc' && $order == $column_name => 'desc',
                                            default => $style_acs_desc = '',
                                        };
                                        ?>
                                    <th class="sortable {{$style_acs_desc}}"
                                        onclick="orderByElements('{{$column_name}}','{{$sort}}')" title="{{$column_desc_long}}">{{$column_desc}}
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                    </th>
                                    {{-- ========================================================================--}}
                                        <?php
                                        $column_name = 'id_insulator_chain';
                                        $column_desc = __('projects.edit-insulators.id_insulator_chain');
                                        $column_desc_long = __('projects.edit-insulators.id_insulator_chain_des');
                                        $query_sort = request()->query('sort');
                                        $style_acs_desc = match (true) {
                                            $query_sort == 'asc' && $order == $column_name => 'asc',
                                            $query_sort == 'desc' && $order == $column_name => 'desc',
                                            default => $style_acs_desc = '',
                                        };
                                        ?>
                                    <th class="sortable {{$style_acs_desc}}"
                                        onclick="orderByElements('{{$column_name}}','{{$sort}}')" title="{{$column_desc_long}}">{{$column_desc}}
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                    </th>
                                    {{-- ========================================================================--}}
                                        <?php
                                        $column_name = 'support_insulator';
                                        $column_desc = __('projects.edit-insulators.support_insulator');
                                        $column_desc_long = __('projects.edit-insulators.support_insulator_des');
                                        $query_sort = request()->query('sort');
                                        $style_acs_desc = match (true) {
                                            $query_sort == 'asc' && $order == $column_name => 'asc',
                                            $query_sort == 'desc' && $order == $column_name => 'desc',
                                            default => $style_acs_desc = '',
                                        };
                                        ?>
                                    <th class="sortable {{$style_acs_desc}}"
                                        onclick="orderByElements('{{$column_name}}','{{$sort}}')" title="{{$column_desc_long}}">{{$column_desc}}
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                    </th>
                                    {{-- ========================================================================--}}
                                        <?php
                                        $column_name = 'number';
                                        $column_desc = __('projects.edit-insulators.number');
                                        $column_desc_long = __('projects.edit-insulators.number_des');
                                        $query_sort = request()->query('sort');
                                        $style_acs_desc = match (true) {
                                            $query_sort == 'asc' && $order == $column_name => 'asc',
                                            $query_sort == 'desc' && $order == $column_name => 'desc',
                                            default => $style_acs_desc = '',
                                        };
                                        ?>
                                    <th class="sortable {{$style_acs_desc}}"
                                        onclick="orderByElements('{{$column_name}}','{{$sort}}')" title="{{$column_desc_long}}">{{$column_desc}}
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                    </th>
                                    {{-- ========================================================================--}}
                                        <?php
                                        $column_name = 'breaking_load';
                                        $column_desc = __('projects.edit-insulators.breaking_load');
                                        $column_desc_long = __('projects.edit-insulators.breaking_load_des');
                                        $query_sort = request()->query('sort');
                                        $style_acs_desc = match (true) {
                                            $query_sort == 'asc' && $order == $column_name => 'asc',
                                            $query_sort == 'desc' && $order == $column_name => 'desc',
                                            default => $style_acs_desc = '',
                                        };
                                        ?>
                                    <th class="sortable {{$style_acs_desc}}"
                                        onclick="orderByElements('{{$column_name}}','{{$sort}}')" title="{{$column_desc_long}}">{{$column_desc}}
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
                                        <td>{!! highlightSearch($insulator->type, 'type', $global_style_search) !!}</td>
                                        <td>{!! highlightSearch($insulator->voltage, 'voltage', $global_style_search) !!}</td>
                                        <td>{!! highlightSearch($insulator->length, 'length', $global_style_search) !!}</td>
                                        <td>{!! highlightSearch($insulator->mass, 'mass', $global_style_search) !!}</td>
                                        <td>{!! highlightSearch($insulator->massd, 'massd', $global_style_search) !!}</td>
                                        <td>{!! highlightSearch($insulator->insulatorChain->title, 'id_insulator_chain', $global_style_search) !!}</td>
                                        <td  class="text-center">
                                            @if($insulator->support_insulator == 1)
                                                <i class="fas fa-check-circle"
                                                   title="{{__('projects.edit-insulators.potp')}}"></i>
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
                                                @php
                                                    $picture=$insulator->picture;
                                                @endphp
                                                @if(!empty($picture))
                                                    @php
                                                        $css = empty($picture) ? 'display: none' : '';
                                                        $src = !empty($picture) ? $path_upload . $insulator->id . '/' . $picture : '';
                                                        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443 ? "https://" : "http://";
                                                        $domain = $protocol . $_SERVER['HTTP_HOST'];
                                                    @endphp

                                                    <button type="button"
                                                            class="btn btn-warning modal_image"
                                                            id="upload_image"
                                                            data-target="#ModalImage"
                                                            data-toggle="modal"
                                                            src="{{asset($src)}}"
                                                            data-url="{{$domain}}/{{$path_upload}}{{$insulator->id}}/{{ $picture}}"
                                                            data-title="{{$picture}}"
                                                            title="{{ $picture}}">
                                                        <i class="fas fa-eye" title="{{__('projects.edit-towers.view_pic')}}"></i>
                                                    </button>
                                                @endif
                                                {{-------------------------------------------------------------------------------------------------------}}
                                                @if($insulator->active == 1)
                                                    @if($insulator->id ==  app('request')->input('value'))
                                                        <button type="button"
                                                                class="btn btn-danger"
                                                                onclick="deleteElementSelected('{{ app('request')->input('name') }}')">
                                                            <i class="fas fa-trash"
                                                               title="{{__('projects.edit-towers.select_tower')}}"></i>
                                                        </button>

                                                    @else
                                                        <button type="button"
                                                                class="btn btn-info"
                                                                onclick="selectElement({{ $insulator->id }},'{{ $insulator->type }}','{{ app('request')->input('name') }}')">
                                                            <i class="fas fa-arrow-alt-circle-right"
                                                               title="{{__('projects.edit-towers.select_tower')}}"></i>
                                                        </button>
                                                    @endif
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
                            <div class="pagination pagination-sm float-right" id="elements-pagination">
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







