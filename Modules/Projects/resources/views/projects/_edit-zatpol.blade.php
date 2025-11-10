

    <?php
    $id_module = $module->id ?? '';
    $lang = request()->segment(2);
    $query = request()->getQueryString();


    $id = $project->id ?? '';
    $title = $project->title ?? old('title');
    $id_voltage = $project->id_voltage ?? old('id_voltage');
    $id_conductor = $project->id_conductor  ?? old('id_conductor');
    $id_ground_wires = $project->id_ground_wires  ?? old('id_ground_wires');
    $id_starting_point = $project->id_starting_point  ?? old('id_starting_point');
    $id_ending_point = $project->id_ending_point  ?? old('id_ending_point');
    $tensile_stress_cond = $project->tensile_stress_cond  ?? old('tensile_stress_cond');
    $tensile_stress_ground = $project->tensile_stress_ground  ?? old('tensile_stress_ground');
    $kn = $project->kn  ?? old('kn');
    $ki = $project->ki  ?? old('ki');
    $id_wind_pressure = $project->id_wind_pressure  ?? old('id_wind_pressure');
    $id_insulator_chain = $project->id_insulator_chain  ?? old('id_insulator_chain');
    $approx_field_length = $project->approx_field_length  ?? old('approx_field_length');
    $approx_number_towers = $project->approx_number_towers  ?? old('approx_number_towers');
    $num_cond_systems = $project->num_cond_systems  ?? old('num_cond_systems');
    $num_cond_bundle = $project->num_cond_bundle  ?? old('num_cond_bundle');
    $num_ground_wires = $project->num_ground_wires  ?? old('num_ground_wires');


    $created_at = (isset($project->created_at)) ? date("d.m.Y H:i:s", strtotime($project->created_at)) : old('created_at');
    $updated_at = (isset($project->updated_at)) ? date("d.m.Y H:i:s", strtotime($project->updated_at)) : old('updated_at');


    $created_by = $project->created_by ?? old('created_by');
    $updated_by= $project->updated_by ?? old('updated_by');

    $active = $project->active ?? '';

    $url_base = 'admin/' . $lang . '/' . $module->link;

    $url = url($url_base);
    $url_action = url($url_base.'/store-point/'. $id);

    $url_return = url($url_base.'/edit_points/'. $id);
    $url_delete = url($url_base.'/delete-point/');
    $query = '';

    $path_upload = 'uploads/projects/';

    $message_error = (isset($id)) ? __('global.update_error') : __('global.save_error');
    $message_success = (isset($id)) ? __('global.update_success') : __('global.save_success');



/*   // $id_trasa = $zatpol->id ?? '';
    $id_stac_t = $zatpol->stac_t ?? 'stac_t';
    $id_kota_t = $zatpol->kota_t ?? 'kota_t';
    $id_agol_tr = $zatpol->agol_tr ?? 'agol_tr';
    $id_stolb = $zatpol->id_stolb ?? 'id_stolb';
    $id_trafo = $zatpol->id_trafo ?? 'id_trafo';
    $id_izolator1 = $zatpol->id_izolator1 ?? 'id_izolator1';
    $id_izolator2= $zatpol->id_izolator2 ?? 'id_izolator2';*/

    ?>




            <div class="container-fluid">





                @if(!$zatpol->isEmpty())

                    <div class="row">
                        <div class="col-sm-12  scrollmenu">

                            <table id="example2" class="table_grid">
                                <thead>
                                <tr>
                                    <th class="text-center">id</th>
                                    <th class="text-center">id_project</th>
                                    <th class="text-center">po_stolb</th>
                                    <th class="text-center">stac_po</th>
                                    <th class="text-center">kr_stolb</th>
                                    <th class="text-center">stac_kr</th>
                                    <th class="text-center">pole_dol</th>
                                    <th class="text-center">nap_pro</th>
                                    <th class="text-center">nap_zaj</th>
                                    <th class="text-center">kndt</th>
                                    <th class="text-center">kidt</th>
                                    <th class="text-center">priv</th>
                                    <th class="text-center">id_raspon</th>
                                    <th class="text-center">tovpro</th>
                                    <th class="text-center">tovpro_1</th>
                                    <th class="text-center">tovpro_2</th>
                                    <th class="text-center">napreg1_p</th>
                                    <th class="text-center">napreg2_p</th>
                                    <th class="text-center">napreg3_p</th>
                                    <th class="text-center">napreg4_p</th>
                                    <th class="text-center">napreg5_p</th>
                                    <th class="text-center">napreg6_p</th>
                                    <th class="text-center">napreg7_p</th>
                                    <th class="text-center">napreg8_p</th>
                                    <th class="text-center">krit_te_p</th>
                                    <th class="text-center">krit_ra_p</th>
                                    <th class="text-center">tovzaj</th>
                                    <th class="text-center">tovzaj_1</th>
                                    <th class="text-center">tovzaj_2</th>
                                    <th class="text-center">napreg1_z</th>
                                    <th class="text-center">napreg2_z</th>
                                    <th class="text-center">napreg3_z</th>
                                    <th class="text-center">napreg4_z</th>
                                    <th class="text-center">napreg5_z</th>
                                    <th class="text-center">napreg6_z</th>
                                    <th class="text-center">napreg7_z</th>
                                    <th class="text-center">napreg8_z</th>
                                    <th class="text-center">krit_te_z</th>
                                    <th class="text-center">krit_ra_z</th>

                                </tr>
                                </thead>

                                <tbody>
                                @foreach($zatpol as $zatpol_)

                                        <?php
                                        $id=$zatpol_->id ?? '';
                                        $id_project=$zatpol_->id_project ?? '';
                                        $po_stolb=$zatpol_->po_stolb ?? '';
                                        $stac_po=$zatpol_->stac_po ?? '';
                                        $kr_stolb=$zatpol_->kr_stolb ?? '';
                                        $stac_kr=$zatpol_->stac_kr ?? '';
                                        $pole_dol=$zatpol_->pole_dol ?? '';
                                        $nap_pro=$zatpol_->nap_pro ?? '';
                                        $nap_zaj=$zatpol_->nap_zaj ?? '';
                                        $kndt=$zatpol_->kndt ?? '';
                                        $kidt=$zatpol_->kidt ?? '';
                                        $priv=$zatpol_->priv ?? '';
                                        $id_raspon=$zatpol_->id_raspon ?? '';
                                        $tovpro=$zatpol_->tovpro ?? '';
                                        $tovpro_1=$zatpol_->tovpro_1 ?? '';
                                        $tovpro_2=$zatpol_->tovpro_2 ?? '';
                                        $napreg1_p=$zatpol_->napreg1_p ?? '';
                                        $napreg2_p=$zatpol_->napreg2_p ?? '';
                                        $napreg3_p=$zatpol_->napreg3_p ?? '';
                                        $napreg4_p=$zatpol_->napreg4_p ?? '';
                                        $napreg5_p=$zatpol_->napreg5_p ?? '';
                                        $napreg6_p=$zatpol_->napreg6_p ?? '';
                                        $napreg7_p=$zatpol_->napreg7_p ?? '';
                                        $napreg8_p=$zatpol_->napreg8_p ?? '';
                                        $krit_te_p=$zatpol_->krit_te_p ?? '';
                                        $krit_ra_p=$zatpol_->krit_ra_p ?? '';
                                        $tovzaj=$zatpol_->tovzaj ?? '';
                                        $tovzaj_1=$zatpol_->tovzaj_1 ?? '';
                                        $tovzaj_2=$zatpol_->tovzaj_2 ?? '';
                                        $napreg1_z=$zatpol_->napreg1_z ?? '';
                                        $napreg2_z=$zatpol_->napreg2_z ?? '';
                                        $napreg3_z=$zatpol_->napreg3_z ?? '';
                                        $napreg4_z=$zatpol_->napreg4_z ?? '';
                                        $napreg5_z=$zatpol_->napreg5_z ?? '';
                                        $napreg6_z=$zatpol_->napreg6_z ?? '';
                                        $napreg7_z=$zatpol_->napreg7_z ?? '';
                                        $napreg8_z=$zatpol_->napreg8_z ?? '';
                                        $krit_te_z=$zatpol_->krit_te_z ?? '';
                                        $krit_ra_z=$zatpol_->krit_ra_z ?? '';
                                        ?>

                                    <tr>
                                        <td class="text-center">{{$id}}</td>
                                        <td class="text-center">{{$id_project}}</td>
                                        <td class="text-center">{{$po_stolb}}</td>
                                        <td class="text-center">{{$stac_po}}</td>
                                        <td class="text-center">{{$kr_stolb}}</td>
                                        <td class="text-center">{{$stac_kr}}</td>
                                        <td class="text-center">{{$pole_dol}}</td>
                                        <td class="text-center">{{$nap_pro}}</td>
                                        <td class="text-center">{{$nap_zaj}}</td>
                                        <td class="text-center">{{$kndt}}</td>
                                        <td class="text-center">{{$kidt}}</td>
                                        <td class="text-center">{{$priv}}</td>
                                        <td class="text-center">{{$id_raspon}}</td>
                                        <td class="text-center">{{$tovpro}}</td>
                                        <td class="text-center">{{$tovpro_1}}</td>
                                        <td class="text-center">{{$tovpro_2}}</td>
                                        <td class="text-center">{{$napreg1_p}}</td>
                                        <td class="text-center">{{$napreg2_p}}</td>
                                        <td class="text-center">{{$napreg3_p}}</td>
                                        <td class="text-center">{{$napreg4_p}}</td>
                                        <td class="text-center">{{$napreg5_p}}</td>
                                        <td class="text-center">{{$napreg6_p}}</td>
                                        <td class="text-center">{{$napreg7_p}}</td>
                                        <td class="text-center">{{$napreg8_p}}</td>
                                        <td class="text-center">{{$krit_te_p}}</td>
                                        <td class="text-center">{{$krit_ra_p}}</td>
                                        <td class="text-center">{{$tovzaj}}</td>
                                        <td class="text-center">{{$tovzaj_1}}</td>
                                        <td class="text-center">{{$tovzaj_2}}</td>
                                        <td class="text-center">{{$napreg1_z}}</td>
                                        <td class="text-center">{{$napreg2_z}}</td>
                                        <td class="text-center">{{$napreg3_z}}</td>
                                        <td class="text-center">{{$napreg4_z}}</td>
                                        <td class="text-center">{{$napreg5_z}}</td>
                                        <td class="text-center">{{$napreg6_z}}</td>
                                        <td class="text-center">{{$napreg7_z}}</td>
                                        <td class="text-center">{{$napreg8_z}}</td>
                                        <td class="text-center">{{$krit_te_z}}</td>
                                        <td class="text-center">{{$krit_ra_z}}</td>


                                    </tr>
                                @endforeach

                                </tbody>


                            </table>
                        </div>
                    </div>


                @else
                    {{__('global.no_records')}}
                @endif





                </div>












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
        @media (min-width: 1300px) {
            .col-xll-6{
                flex: 0 0 70%;
                max-width: 70%;
            }
        }
    </style>




    <script>

        $(document).ready(function () {
            // Иницијализација на bsCustomFileInput
            bsCustomFileInput.init();

            // Конфигурација за Date Range Picker со вклучено време
            const dateTimePickerConfig = {
                singleDatePicker: true,
                autoUpdateInput: false,
                timePicker: false, // Овозможете време
                timePicker24Hour: true, // 24-часовен формат
                timePickerSeconds: true, // Вклучете секунди
                showDropdowns: true,
                locale: {
                    format: "DD.MM.YYYY HH:mm:ss", // Формат за датум и време
                    // applyLabel: "Внеси",
                    // cancelLabel: "Бриши",
                    fromLabel: "From",
                    toLabel: "To",
                    customRangeLabel: "Custom",
                    weekLabel: "W",
                    // daysOfWeek: ["Не", "По", "Вт", "Ср", "Че", "Пе", "Са"],
                    // monthNames: [
                    //     "Јануари", "Февруари", "Март", "Април", "Мај", "Јуни",
                    //     "Јули", "Август", "Септември", "Октомври", "Ноември", "Декември"
                    // ],
                    firstDay: 1
                }
            };

            // Функција за иницијализација на Date Range Picker за дадено поле
            function initializeDateTimePicker(selector) {
                const inputField = $(selector);

                inputField.daterangepicker(dateTimePickerConfig);

                inputField.on('apply.daterangepicker', function (ev, picker) {
                    // Поставување на времето на 23:59:59 за end_date
                    // if (selector.includes('end_date')) {
                    //     const endOfDay = picker.startDate.clone().set({
                    //         hour: 23,
                    //         minute: 59,
                    //         second: 59
                    //     });
                    //     picker.setStartDate(endOfDay);  // Поставување нов датум со крај на денот
                    // }
                    // Форматирање и пополнување на полето
                    $(this).val(picker.startDate.format('DD.MM.YYYY HH:mm:ss'));
                    $('#start_date_hidden').val(picker.startDate.format('DD.MM.YYYY HH:mm:ss'));
                });

                inputField.on('cancel.daterangepicker', function () {
                    $(this).val('');
                });
            }
            // Функција за end_date која секогаш го поставува времето на 23:59:59
            function initializeEndDateTimePicker(selector) {
                const inputField = $(selector);

                inputField.daterangepicker(dateTimePickerConfig);

                inputField.on('apply.daterangepicker', function (ev, picker) {
                    // Присилно поставување на 23:59:59 за end_date
                    picker.startDate.set({
                        hour: 23,
                        minute: 59,
                        second: 59
                    });
                    $(this).val(picker.startDate.format('DD.MM.YYYY HH:mm:ss'));
                    $('#end_date_hidden').val(picker.startDate.format('DD.MM.YYYY HH:mm:ss'));
                });

                inputField.on('cancel.daterangepicker', function () {
                    $(this).val('');
                });
            }
            // Иницијализација за `start_date`
            initializeDateTimePicker('input[name="start_date"]');
            // Иницијализација за `end_date` (ако е потребно)
            initializeEndDateTimePicker('input[name="end_date"]');
        });



        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4',
            //dropdownAutoWidth: true,
            //width: 'auto'
        })


    </script>


