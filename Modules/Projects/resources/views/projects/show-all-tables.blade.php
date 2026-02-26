

    <div class="container-fluid">




<div>  РАСПРЕС</div>
        @if(!$raspres->isEmpty())

            <div class="row">
                <div class="col-sm-12  scrollmenu">

                    <table id="example2" class="table_grid">
                        <thead>
                        <tr><th class="text-center" style="white-space: nowrap; width: 1px;"></th>
                            <th class="text-center" style="white-space: nowrap; width: 1px;">id</th>
                            <th class="text-center" style="white-space: nowrap; width: 1px;">id_project</th>
                            <th class="text-center">stac_t</th>
                            <th class="text-center" style="white-space: nowrap; width: 1px;">kota_t</th>
                            <th class="text-center">raspon</th>
                            <th class="text-center">vr_pro</th>
                            <th class="text-center">vr_zaj </th>
                            <th class="text-center">kota_pro</th>
                            <th class="text-center">kota_zaj</th>
                            <th class="text-center">ras_totp</th>
                            <th class="text-center">ras_t2op</th>
                            <th class="text-center">ras_totz</th>
                            <th class="text-center">ras_t2oz</th>
                            <th class="text-center">dol_pro</th>
                            <th class="text-center">dol_zaj</th>

                        </tr>
                        </thead>

                        <tbody>
                            <?php
                            $n=0;
                                ?>
                        @foreach($raspres as $raspres_)

                                <?php
                                    $n=$n+1;
                                $id = $raspres_->id ?? '';
                                $id_project= $raspres_->id_project ?? '';
                                $stac_t = $raspres_->stac_t ?? '';
                                $kota_t = $raspres_->kota_t ?? '';
                                $raspon= $raspres_->raspon ?? '';
                                $vr_pro= $raspres_->vr_pro?? '';
                                $vr_zaj= $raspres_->vr_zaj?? '';
                                $kota_pro= $raspres_->kota_pro ?? '';
                                $kota_zaj= $raspres_->kota_zaj?? '';
                                $ras_totp = $raspres_->ras_totp?? '';
                                $ras_t2op = $raspres_->ras_t2op?? '';
                                $ras_totz = $raspres_->ras_totz?? '';
                                $ras_t2oz = $raspres_->ras_t2oz?? '';
                                $dol_pro= $raspres_->dol_pro?? '';
                                $dol_zaj = $raspres_->dol_zaj?? '';
                                ?>

                            <tr>
                                <td class="text-center">{{$n}}</td>
                                <td class="text-center">{{$id}}</td>
                                <td class="text-center">{{$id_project}}</td>
                                <td class="text-center">{{$stac_t}}</td>
                                <td class="text-center">{{$kota_t}}</td>
                                <td class="text-center">{{$raspon}}</td>
                                <td class="text-center">{{$vr_pro}}</td>
                                <td class="text-center">{{$vr_zaj}}</td>
                                <td class="text-center">{{$kota_pro}}</td>
                                <td class="text-center">{{$kota_zaj}}</td>
                                <td class="text-center">{{$ras_totp}}</td>
                                <td class="text-center">{{$ras_t2op}}</td>
                                <td class="text-center">{{$ras_totz}}</td>
                                <td class="text-center">{{$ras_t2oz}}</td>
                                <td class="text-center">{{$dol_pro}}</td>
                                <td class="text-center">{{$dol_zaj}}</td>


                            </tr>
                        @endforeach

                        </tbody>


                    </table>
                </div>
            </div>


        @else
            {{__('global.no_records')}}
        @endif

        <div>  ЗАТПОЛ</div>
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
        <div>  ГАПРЕС</div>
            @if(!$gapres->isEmpty())

                <div class="row">
                    <div class="col-sm-12  scrollmenu">

                        <table id="example2" class="table_grid">
                            <thead>
                            <tr>
                                <th class="text-center">id</th>
                                <th class="text-center">id_project</th>
                                <th class="text-center">br_stolb</th>
                                <th class="text-center">stac_t</th>
                                <th class="text-center">raspon	</th>
                                <th class="text-center">grr_lpro</th>
                                <th class="text-center">grr_dpro</th>
                                <th class="text-center">grr_vpro</th>
                                <th class="text-center">proc_gv</th>
                                <th class="text-center">grr_st</th>
                                <th class="text-center">grr_lprk</th>
                                <th class="text-center">grr_dprk</th>
                                <th class="text-center">grr_vprk</th>
                                <th class="text-center">elr_pro1</th>
                                <th class="text-center">elr_pro2</th>
                                <th class="text-center">sre_ras</th>
                                <th class="text-center">proc_sr</th>
                                <th class="text-center">s_ra_st</th>
                                <th class="text-center">grr_lzaj</th>
                                <th class="text-center">grr_dzaj</th>
                                <th class="text-center">grr_vzaj</th>
                                <th class="text-center">proc_gz</th>
                                <th class="text-center">elr_zaj1</th>
                                <th class="text-center">elr_zaj2</th>
                                <th class="text-center">kota_pro</th>
                                <th class="text-center">kota_zaj</th>
                                <th class="text-center">ras_totp</th>
                                <th class="text-center">ras_totz</th>
                                <th class="text-center">agol_t</th>
                                <th class="text-center">stol_ag1</th>
                                <th class="text-center">br_ras</th>

                            </tr>
                            </thead>

                            <tbody>
                            @foreach($gapres as $gapres_)

                                    <?php
                                    $id        =$gapres_->id         ?? '';
                                    $id_project=$gapres_->id_project ?? '';
                                    $br_stolb  =$gapres_->br_stolb   ?? '';
                                    $stac_t    =$gapres_->stac_t     ?? '';
                                    $raspon    =$gapres_->raspon     ?? '';
                                    $grr_lpro  =$gapres_->grr_lpro   ?? '';
                                    $grr_dpro  =$gapres_->grr_dpro   ?? '';
                                    $grr_vpro  =$gapres_->grr_vpro   ?? '';
                                    $proc_gv   =$gapres_->proc_gv    ?? '';
                                    $grr_st    =$gapres_->grr_st     ?? '';
                                    $grr_lprk  =$gapres_->grr_lprk   ?? '';
                                    $grr_dprk  =$gapres_->grr_dprk   ?? '';
                                    $grr_vprk  =$gapres_->grr_vprk   ?? '';
                                    $elr_pro1  =$gapres_->elr_pro1   ?? '';
                                    $elr_pro2  =$gapres_->elr_pro2   ?? '';
                                    $sre_ras   =$gapres_->sre_ras    ?? '';
                                    $proc_sr   =$gapres_->proc_sr    ?? '';
                                    $s_ra_st   =$gapres_->s_ra_st    ?? '';
                                    $grr_lzaj  =$gapres_->grr_lzaj   ?? '';
                                    $grr_dzaj  =$gapres_->grr_dzaj   ?? '';
                                    $grr_vzaj  =$gapres_->grr_vzaj   ?? '';
                                    $proc_gz   =$gapres_->proc_gz    ?? '';
                                    $elr_zaj1  =$gapres_->elr_zaj1   ?? '';
                                    $elr_zaj2  =$gapres_->elr_zaj2   ?? '';
                                    $kota_pro  =$gapres_->kota_pro   ?? '';
                                    $kota_zaj  =$gapres_->kota_zaj   ?? '';
                                    $ras_totp  =$gapres_->ras_totp   ?? '';
                                    $ras_totz  =$gapres_->ras_totz   ?? '';
                                    $agol_t    =$gapres_->agol_t     ?? '';
                                    $stol_ag1  =$gapres_->stol_ag1   ?? '';
                                    $br_ras    =$gapres_->br_ras     ?? '';
                                    ?>

                                <tr>
                                    <td class="text-center">{{$id}}</td>
                                    <td class="text-center">{{$id_project}}</td>
                                    <td class="text-center">{{$br_stolb}}</td>
                                    <td class="text-center">{{$stac_t}}</td>
                                    <td class="text-center">{{$raspon	}}</td>
                                    <td class="text-center">{{$grr_lpro}}</td>
                                    <td class="text-center">{{$grr_dpro}}</td>
                                    <td class="text-center">{{$grr_vpro}}</td>
                                    <td class="text-center">{{$proc_gv}}</td>
                                    <td class="text-center">{{$grr_st}}</td>
                                    <td class="text-center">{{$grr_lprk}}</td>
                                    <td class="text-center">{{$grr_dprk}}</td>
                                    <td class="text-center">{{$grr_vprk}}</td>
                                    <td class="text-center">{{$elr_pro1}}</td>
                                    <td class="text-center">{{$elr_pro2}}</td>
                                    <td class="text-center">{{$sre_ras}}</td>
                                    <td class="text-center">{{$proc_sr}}</td>
                                    <td class="text-center">{{$s_ra_st}}</td>
                                    <td class="text-center">{{$grr_lzaj}}</td>
                                    <td class="text-center">{{$grr_dzaj}}</td>
                                    <td class="text-center">{{$grr_vzaj}}</td>
                                    <td class="text-center">{{$proc_gz}}</td>
                                    <td class="text-center">{{$elr_zaj1}}</td>
                                    <td class="text-center">{{$elr_zaj2}}</td>
                                    <td class="text-center">{{$kota_pro}}</td>
                                    <td class="text-center">{{$kota_zaj}}</td>
                                    <td class="text-center">{{$ras_totp}}</td>
                                    <td class="text-center">{{$ras_totz}}</td>
                                    <td class="text-center">{{$agol_t}}</td>
                                    <td class="text-center">{{$stol_ag1}}</td>
                                    <td class="text-center">{{$br_ras}}</td>


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


