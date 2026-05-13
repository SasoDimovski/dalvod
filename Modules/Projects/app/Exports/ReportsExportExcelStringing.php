<?php

namespace Modules\Projects\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class ReportsExportExcelStringing implements FromArray
{
    protected array $records;
    protected $project;

    public function __construct(array $records, $project = null)
    {
        $this->records = $records;
        $this->project = $project;
    }

    public function array(): array
    {
        $rows = [];

        $fmt2 = function ($v) {
            return is_numeric($v) ? number_format((float)$v, 2, '.', '') : ($v ?? '');
        };

        $fmt0 = function ($v) {
            return is_numeric($v) ? number_format((float)$v, 0, '.', '') : ($v ?? '');
        };

        // =========================================================
        // ПРОВОДНИК
        // =========================================================
        foreach ($this->records as $record) {
            $rows[] = [__('projects.ReportsExportExcelStringing.mon_conductor').': '. $record['summary']['conductor'].', '. __('projects.ReportsExportExcelStringing.mon_tab').' '. $record['number']];
            $rows[] = [''];

            $rows[] = [
                __('projects.ReportsExportExcelStringing.sp').': '.$record['summary']['conductor'] ?? '',
                __('projects.ReportsExportExcelStringing.ns').': '.$fmt2($record['summary']['nap_pro'] ?? ''),
                __('projects.ReportsExportExcelStringing.kndt').': '.$fmt2($record['summary']['kndt'] ?? ''),
            ];



            $rows[] = [''];

            $temps = $record['matrix']['temps'] ?? [];

            $rows[] = array_merge([__('projects.ReportsExportExcelStringing.temp')], $temps);
            $rows[] = array_merge(
                [__('projects.ReportsExportExcelStringing.np')],
                array_map($fmt2, $record['matrix']['napreg_p'] ?? [])
            );
            $rows[] = array_merge(
                [__('projects.ReportsExportExcelStringing.sz')],
                array_map($fmt2, $record['matrix']['sila_zateg'] ?? [])
            );
            $rows[] = array_merge(
                [__('projects.ReportsExportExcelStringing.pir')],
                array_map($fmt0, $record['matrix']['proves_idr'] ?? [])
            );

            $rows[] = [''];

            foreach ($record['spans'] ?? [] as $span) {
                $rows[] = [
                    __('projects.ReportsExportExcelStringing.rb').': '.$span['raspon_br'] ?? '',
                    __('projects.ReportsExportExcelStringing.rs').': '.$fmt2($span['raspon'] ?? ''),
                    __('projects.ReportsExportExcelStringing.vr').': '.$fmt2($span['vr'] ?? ''),
                ];

                $rows[] = array_merge([__('projects.ReportsExportExcelStringing.temp')], $temps);
                $rows[] = array_merge(
                    [__('projects.ReportsExportExcelStringing.pvr')],
                    array_map($fmt0, $span['provesi'] ?? [])
                );

                $rows[] = [''];
            }

            $rows[] = [''];
            $rows[] = [''];
        }

        // =========================================================
        // ЗАШТИТНО ЈАЖЕ
        // =========================================================
        foreach ($this->records as $record) {
            $rows[] = [__('projects.ReportsExportExcelStringing.mon_zaj').': '. $record['summary']['conductor'].', '. __('projects.ReportsExportExcelStringing.mon_tab').' '. $record['number']];
            $rows[] = [''];

            $rows[] = [
                __('projects.ReportsExportExcelStringing.sp').': '.$record['summary']['conductor'] ?? '',
                __('projects.ReportsExportExcelStringing.ns').': '.$fmt2($record['summary']['nap_zaj'] ?? ''),
                __('projects.ReportsExportExcelStringing.kndt').': '.$fmt2($record['summary']['kndt'] ?? ''),
            ];


            $rows[] = [''];

            $temps = $record['matrix_zj']['temps'] ?? [];

            $rows[] = array_merge([__('projects.ReportsExportExcelStringing.temp')], $temps);
            $rows[] = array_merge(
                [__('projects.ReportsExportExcelStringing.np')],
                array_map($fmt2, $record['matrix']['napreg_p'] ?? [])
            );
            $rows[] = array_merge(
                [__('projects.ReportsExportExcelStringing.sz')],
                array_map($fmt2, $record['matrix']['sila_zateg'] ?? [])
            );
            $rows[] = array_merge(
                [__('projects.ReportsExportExcelStringing.pir')],
                array_map($fmt0, $record['matrix']['proves_idr'] ?? [])
            );

            $rows[] = [''];

            foreach ($record['spans_zj'] ?? [] as $span) {
                $rows[] = [
                    __('projects.ReportsExportExcelStringing.rb').': '.$span['raspon_br'] ?? '',
                    __('projects.ReportsExportExcelStringing.rs').': '.$fmt2($span['raspon'] ?? ''),
                    __('projects.ReportsExportExcelStringing.vr').': '.$fmt2($span['vr'] ?? ''),
                ];


                $rows[] = array_merge([__('projects.ReportsExportExcelStringing.temp')], $temps);
                $rows[] = array_merge(
                    [__('projects.ReportsExportExcelStringing.pvr')],
                    array_map($fmt0, $span['provesi'] ?? [])
                );

                $rows[] = [''];
            }

            $rows[] = [''];
            $rows[] = [''];
        }

        return $rows;
    }
}
