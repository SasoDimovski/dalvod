
<div class="container-fluid">


    @if(!$zatpol->isEmpty())

        <div class="row">
            <div class="col-sm-12  scrollmenu">

                <table id="example2" class="table_grid">
                    <thead>
                    <tr> <th class="text-center" style="white-space: nowrap; width: 1px;"></th>
                        <th class="text-center">id</th>
                        <th class="text-center">id_project</th>
                        <th class="text-center">po_stolb</th>
                        <th class="text-center">kr_stolb</th>
                        <th class="text-center">stac_po</th>
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
                        <?php
                        $n=0;
                        ?>
                    @foreach($zatpol as $zatpol_)

                            <?php
                            $n=$n+1;
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

                                <td class="text-center">{{$n}}</td>
                            <td class="text-center">{{$id}}</td>
                            <td class="text-center">{{$id_project}}</td>
                            <td class="text-center">{{$po_stolb}}</td>
                            <td class="text-center">{{$kr_stolb}}</td>
                            <td class="text-center">{{$stac_po}}</td>
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


