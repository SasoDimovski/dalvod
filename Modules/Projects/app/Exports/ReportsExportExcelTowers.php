<?php

namespace Modules\Projects\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportsExportExcelTowers implements FromCollection, WithHeadings
{
    protected Collection $records;

    public function __construct(Collection $records)
    {
        $this->records = $records;
    }

    public function collection(): Collection
    {
        $fmt = function ($v) {
            return is_numeric($v) ? number_format((float)$v, 2, '.', '') : $v;
        };

        return $this->records->map(function ($record) use ($fmt) {
            return [
                $record['zp'],
                $record['stolb_no'],
                $fmt($record['stac_t']),
                $record['tower_name'],
                $record['izolator'],
                $fmt($record['agol']),
                $fmt($record['horiz']),
                $fmt($record['avg']),
                $fmt($record['left']),
                $fmt($record['right']),
                $fmt($record['total']),
                $fmt($record['pole_dol']),
                $fmt($record['nap_pro']),
                $fmt($record['nap_zaj']),
                $fmt($record['kndt']),
                $fmt($record['kidt']),
                $record['priv'],
            ];
        });
    }

    public function headings(): array
    {
        return [
            __('projects.ReportsExportExcelTowers.zp_des'),
            __('projects.ReportsExportExcelTowers.towers_des'),
            __('projects.ReportsExportExcelTowers.stac_des'),
            __('projects.ReportsExportExcelTowers.tower_des'),
            __('projects.ReportsExportExcelTowers.insulator_des'),
            __('projects.ReportsExportExcelTowers.angle_des'),
            __('projects.ReportsExportExcelTowers.hr_des'),
            __('projects.ReportsExportExcelTowers.sr_des'),
            __('projects.ReportsExportExcelTowers.glr_des'),
            __('projects.ReportsExportExcelTowers.gdr_des'),
            __('projects.ReportsExportExcelTowers.gvr_des'),
            __('projects.ReportsExportExcelTowers.dzp_des'),
            __('projects.ReportsExportExcelTowers.ns_des'),
            __('projects.ReportsExportExcelTowers.nzj_des'),
            __('projects.ReportsExportExcelTowers.kndt_des'),
            __('projects.ReportsExportExcelTowers.kidt_des'),
            __('projects.ReportsExportExcelTowers.pv_des'),
        ];
    }
}
