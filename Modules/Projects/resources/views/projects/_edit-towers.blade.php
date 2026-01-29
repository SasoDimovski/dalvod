

<?php
$id_module = $module->id ?? '';
$lang = request()->segment(2);
$query = request()->getQueryString();
$listing = app('request')->input('listing', config('towers.pagination'));

$global_style = "cursor: pointer; color: #BD362F";
$global_style_search = "color: #f09404; ";

$url = url('admin/' . $lang . '/' . $module->link);

//$url_base= 'admin/'.$lang.'/'.$id_module.'/towers/';

$url_create= url($url.'/create');
$url_edit = url($url.'/edit');
$url_show = url($url.'/show');
$url_delete = url($url.'/delete');


$id = request()->segment(6);
$url_edit_towers = $url . '/towers/'.$id;

$path_upload = 'uploads/towers/';
?>
@include('towers::towers._include-functions.function-highlight-search')
<!-- Content Wrapper. Contains page content -->





<div class="container-fluid">

    <!-- Search =============================================================================================== -->
    <form class="form-horizontal" name="form_search" id="form_search" method="get" action="{{ $url_edit_towers }}"
          accept-charset="UTF-8" autocomplete="off">
        <input type="hidden" id="page" name="page" value="{{ app('request')->input('page') }}">
        <input type="hidden" id="container" name="container" value="edit-elements-container">

        <input type="hidden" name="order" id="order"
               value="{{ request()->query('order') }}">
        <input type="hidden" name="sort" id="sort"
               value="{{ request()->query('sort') }}">

        <input type="hidden" id="name" name="name" value="{{ app('request')->input('name') }}">
        <input type="hidden" id="value" name="value" value="{{ app('request')->input('value') }}">




        {{csrf_field()}}
        @method('POST')
        <!-- card card-red card-outline =============================================================================================== -->
        <div class="card card-red card-outline">
            <div class="card-body">
                <div class="row">
                    {{$query}}
                </div>
                <div class="row">


                    <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2">
                        <?php
                        $name = 'id';
                        $desc = __('projects.edit-towers.id');
                        $desc_long = __('projects.edit-towers.id_des');
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
                        $name = 'type';
                        $desc = __('projects.edit-towers.type');
                        $desc_long = __('projects.edit-towers.type_des');
                        $maxlength = 100;

                        $value = app('request')->input($name) ? app('request')->input($name) : null;
                        $style = app('request')->input($name) ? $global_style : null;
                        $x = app('request')->input($name) ? ('    x') : null;
                        ?>
                        <label class="control-label" title="{{$desc_long}}">{{$desc}}
                            <b onclick="deleteSearchFieldAJAX('{{$name}}', this)" style="{{$style}}"
                               title="{{__('global.delete_search_field')}}">{{$x}}</b>
                        </label>
                        <input type="text" id="{{$name}}" name="{{$name}}"
                               class="form-control form-control-sm"
                               value="{{$value}}"
                               placeholder="{{$desc}}" maxlength="{{$maxlength}}" title="{{$desc_long}}">
                    </div>
                    <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2">
                        <?php
                        $name = 'angle';
                        $desc = __('projects.edit-towers.angle');
                        $desc_long = __('projects.edit-towers.angle_des');
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
                               placeholder="{{$desc}}" maxlength="{{$maxlength}}"  title="{{$desc_long}}">
                    </div>
                    <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2">
                        <?php
                        $name = 'mass';
                        $desc = __('projects.edit-towers.mass');
                        $desc_long = __('projects.edit-towers.mass_des');
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

                    <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2">
                        <?php
                        $name = 'vid';
                        $desc = __('projects.edit-towers.vid');
                        $desc_long = __('projects.edit-towers.vid_des');
                        $options = [
                            '' => '',
                            'E' => 'Е (Единечен)',
                            'D' => 'D (Двоен)',

                        ];

                        $value = app('request')->input($name) ? app('request')->input($name) : null;
                        $style = app('request')->input($name) ? $global_style : null;
                        $x = app('request')->input($name) ? ('    x') : null;
                        ?>
                        <label class="control-label" title="{{$desc_long}}">{{ $desc }}
                            <b onclick="deleteSearchFieldElements('{{$name}}')" style="{{$style}}"
                               title="{{__('global.delete_search_field')}}">{{$x}}</b></label>
                        <select id="{{ $name }}" name="{{ $name }}" class="form-control form-control-sm" onchange="dropdownChangeElements()" title="{{$desc_long}}">
                            @foreach($options as $value => $label)
                                <option value="{{ $value }}"
                                    {{ app('request')->input($name)  == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2">
                        <?php
                        $name = 'rap';
                        $desc = __('projects.edit-towers.rap');
                        $desc_long = __('projects.edit-towers.rap_des');
                        $options = [
                            '' => '',
                            'H' => 'H (Хоризонтален)',
                            'V' => 'V (Вертикален)',
                            'K' => 'K (Кос)',
                        ];
                        $value = app('request')->input($name) ? app('request')->input($name) : null;
                        $style = app('request')->input($name) ? $global_style : null;
                        $x = app('request')->input($name) ? ('    x') : null;
                        ?>
                        <label class="control-label" title="{{$desc_long}}">{{ $desc }}
                            <b onclick="deleteSearchFieldElements('{{$name}}')" style="{{$style}}"
                               title="{{__('global.delete_search_field')}}">{{$x}}</b>
                        </label>
                        <select id="{{ $name }}" name="{{ $name }}" class="form-control form-control-sm" onchange="dropdownChangeElements()" title="{{$desc_long}}">
                            @foreach($options as $value => $label)
                                <option value="{{ $value }}"
                                    {{ app('request')->input($name)  == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                </div>

                <div class="row" style="height: 7px"></div>

                <div class="row">
                    <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2">
                        <?php
                        $name = 'vis';
                        $desc = __('projects.edit-towers.vis');
                        $desc_long = __('projects.edit-towers.vis_des');
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
                        $name = 'vig';
                        $desc = __('projects.edit-towers.vig');
                        $desc_long = __('projects.edit-towers.vig_des');
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
                        $name = 'mhr';
                        $desc = __('projects.edit-towers.mhr');
                        $desc_long = __('projects.edit-towers.mhr_des');
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
                        $name = 'dkp';
                        $desc = __('projects.edit-towers.dkp');
                        $desc_long = __('projects.edit-towers.dkp_des');
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
                        $name = 'dkz';
                        $desc = __('projects.edit-towers.dkz');
                        $desc_long = __('projects.edit-towers.dkz_des');
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
                    <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2">
                        <?php
                        $name = 'raz';
                        $desc = __('projects.edit-towers.raz');
                        $desc_long = __('projects.edit-towers.raz_des');
                        $options = [
                            '' => '',
                            'H' => 'H (Хоризонтален)',
                            'V' => 'V (Вертикален)',
                            'K' => 'K (Кос)',
                        ];
                        $value = app('request')->input($name) ? app('request')->input($name) : null;
                        $style = app('request')->input($name) ? $global_style : null;
                        $x = app('request')->input($name) ? ('    x') : null;
                        ?>
                        <label class="control-label" title="{{$desc_long}}">{{ $desc }}
                            <b onclick="deleteSearchFieldElements('{{$name}}')" style="{{$style}}"
                               title="{{__('global.delete_search_field')}}">{{$x}}</b>
                        </label>
                        <select id="{{ $name }}" name="{{ $name }}" class="form-control form-control-sm" onchange="dropdownChangeElements()" title="{{$desc_long}}">
                            @foreach($options as $value => $label)
                                <option value="{{ $value }}"
                                    {{ app('request')->input($name)  == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="row" style="height: 7px"></div>
                <div class="row">
                    <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2">
                        <?php
                        $name = 'nap';
                        $desc = __('projects.edit-towers.nap');
                        $desc_long = __('projects.edit-towers.nap_des');

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
                                onclick="searchElements()" autofocus
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
            @if(count($towers) > 0)
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
                                    class="badge badge-warning">{{ $towers->firstItem() }}</span></strong>
                            {{__('global.to')}}
                            <strong> <span
                                    class="badge badge-warning">{{$towers->lastItem() }}</span></strong>
                            ({{__('global.sum')}}
                            <strong> <span
                                    class="badge badge-danger">{{ $towers->total() }}</span></strong>
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
                                        $column_desc = __('projects.edit-towers.id');
                                        $column_desc_long = __('projects.edit-towers.id_des');
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
                                        $column_desc = __('projects.edit-towers.type');
                                        $column_desc_long = __('projects.edit-towers.type_des');
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
                                        $column_desc = __('projects.edit-towers.voltage');
                                        $column_desc_long = __('projects.edit-towers.voltage_des');
                                        $query_sort = request()->query('sort');
                                        $style_acs_desc = match (true) {
                                            $query_sort == 'asc' && $order == $column_name => 'asc',
                                            $query_sort == 'desc' && $order == $column_name => 'desc',
                                            default => $style_acs_desc = '',
                                        };
                                        ?>
                                    <th class="sortable {{$style_acs_desc}}"
                                        style="white-space: nowrap; width: 1px;"
                                        onclick="orderByElements('{{$column_name}}','{{$sort}}')" title="{{$column_desc_long}}">{{$column_desc}}
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                    </th>
                                    {{-- ========================================================================--}}
                                        <?php
                                        $column_name = 'angle';
                                        $column_desc = __('projects.edit-towers.angle');
                                        $column_desc_long = __('projects.edit-towers.angle_des');
                                        $query_sort = request()->query('sort');
                                        $style_acs_desc = match (true) {
                                            $query_sort == 'asc' && $order == $column_name => 'asc',
                                            $query_sort == 'desc' && $order == $column_name => 'desc',
                                            default => $style_acs_desc = '',
                                        };
                                        ?>
                                    <th class="sortable {{$style_acs_desc}}"
                                        style="white-space: nowrap; width: 1px;"
                                        onclick="orderByElements('{{$column_name}}','{{$sort}}')" title="{{$column_desc_long}}">{{$column_desc}}
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                    </th>
                                    {{-- ========================================================================--}}
                                        <?php
                                        $column_name = 'mass';
                                        $column_desc = __('projects.edit-towers.mass');
                                        $column_desc_long = __('projects.edit-towers.mass_des');
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
                                        $column_name = 'vid';
                                        $column_desc = __('projects.edit-towers.vid');
                                        $column_desc_long = __('projects.edit-towers.vid_des');
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
                                        $column_name = 'vis';
                                        $column_desc = __('projects.edit-towers.vis');
                                        $column_desc_long = __('projects.edit-towers.vis_des');
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
                                        $column_name = 'vig';
                                        $column_desc = __('projects.edit-towers.vig');
                                        $column_desc_long = __('projects.edit-towers.vig_des');
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
                                        $column_name = 'mhr';
                                        $column_desc = __('projects.edit-towers.mhr');
                                        $column_desc_long = __('projects.edit-towers.mhr_des');
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
                                        $column_name = 'dkp';
                                        $column_desc = __('projects.edit-towers.dkp');
                                        $column_desc_long = __('projects.edit-towers.dkp_des');
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
                                        $column_name = 'dkz';
                                        $column_desc = __('projects.edit-towers.dkz');
                                        $column_desc_long = __('projects.edit-towers.dkz_des');
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
                                        $column_name = 'rap';
                                        $column_desc = __('projects.edit-towers.rap');
                                        $column_desc_long = __('projects.edit-towers.rap_des');
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
                                        $column_name = 'raz';
                                        $column_desc = __('projects.edit-towers.raz');
                                        $column_desc_long = __('projects.edit-towers.raz_des');
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
                                @foreach($towers as $tower)

                                    <tr @if($tower->active == 0) style="color: #cccccc" @endif @if($tower->id ==  app('request')->input('id_element') ) style="background-color: #ffe187" @endif>
                                        <td>{!! highlightSearch($tower->id, 'id', $global_style_search) !!}</td>
                                        <td  class="target-cell"> </td>
                                        <td>{!! highlightSearch($tower->type, 'type', $global_style_search) !!}</td>
                                        <td>{!! highlightSearch($tower->voltage, 'voltage', $global_style_search) !!}</td>
                                        <td>{!! highlightSearch($tower->angle, 'angle', $global_style_search) !!}</td>
                                        <td>{!! highlightSearch($tower->mass, 'mass', $global_style_search) !!}</td>
                                        <td>{!! highlightSearch($tower->vid, 'vid', $global_style_search) !!}</td>
                                        <td>{!! highlightSearch($tower->vis, 'vis', $global_style_search) !!}</td>
                                        <td>{!! highlightSearch($tower->vig, 'vig', $global_style_search) !!}</td>
                                        <td>{!! highlightSearch($tower->mhr, 'mhr', $global_style_search) !!}</td>
                                        <td>{!! highlightSearch($tower->dkp, 'dkp', $global_style_search) !!}</td>
                                        <td>{!! highlightSearch($tower->dkz, 'dkz', $global_style_search) !!}</td>
                                        <td>{!! highlightSearch($tower->rap, 'rap', $global_style_search) !!}</td>
                                        <td>{!! highlightSearch($tower->raz, 'raz', $global_style_search) !!}</td>
                                        <td>
                                            @if($tower->active == 0)
                                                <i class="fas fa-lock"
                                                   title="{{__('global.deactivated')}}"></i>
                                            @endif
                                        </td>
                                        <td  class="source-cell">
                                            <div class="btn-group btn-group-sm">
                                                {{-------------------------------------------------------------------------------------------------------}}
                                                <!--   ================================================================================-->
                                                @php
                                                    $picture=$tower->picture;
                                                    @endphp
                                                @if(!empty($picture))
                                                    @php
                                                        $css = empty($picture) ? 'display: none' : '';
                                                        $src = !empty($picture) ? $path_upload . $tower->id . '/' . $picture : '';
                                                        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443 ? "https://" : "http://";
                                                        $domain = $protocol . $_SERVER['HTTP_HOST'];
                                                    @endphp

                                                    <button type="button"
                                                            class="btn btn-warning modal_image"
                                                            id="upload_image"
                                                            data-target="#ModalImage"
                                                            data-toggle="modal"
                                                            src="{{asset($src)}}"
                                                            data-url="{{$domain}}/{{$path_upload}}{{$tower->id}}/{{ $picture}}"
                                                            data-title="{{$picture}}"
                                                            title="{{ $picture}}">
                                                        <i class="fas fa-eye" title="{{__('projects.edit-towers.view_pic')}}"></i>
                                                    </button>


                                                @endif
                                                <!--   ================================================================================-->
                                                {{-------------------------------------------------------------------------------------------------------}}
                                                @if($tower->active == 1)
                                                @if($tower->id ==  app('request')->input('value'))
                                                    <button type="button"
                                                            class="btn btn-danger"
                                                            onclick="deleteElementSelected('{{ app('request')->input('name') }}')">
                                                        <i class="fas fa-trash"
                                                           title="{{__('projects.edit-towers.select_tower')}}"></i>
                                                    </button>

                                                @else
                                                    <button type="button"
                                                            class="btn btn-info"
                                                            onclick="selectElement({{ $tower->id }},'{{ $tower->type }}','{{ app('request')->input('name') }}')">
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
                            <div class="pagination pagination-sm float-right"  id="elements-pagination">
                                {{ $towers->withQueryString()->links('pagination::bootstrap-4')  }}
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






