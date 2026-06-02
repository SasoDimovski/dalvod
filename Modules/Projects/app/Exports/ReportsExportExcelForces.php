<?php

namespace Modules\Projects\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReportsExportExcelForces implements FromArray, ShouldAutoSize, WithStyles
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

        foreach ($this->records as $item) {

            $summary = $item['summary'] ?? [];

            $rows[] = [
                'ТАБЕЛА НА СИЛИ ЗА СТОЛБ БР.: ' . ($summary['br_stolb'] ?? ''),
            ];

            $rows[] = [];

            $rows[] = [
                'Sila [daN]',
                '',
                'Vx',
                'Vy',
                'Vz',
                'Zx',
                'Zy',
                'Zz',
                'Sx',
                'Sy',
            ];

            foreach (($item['forces'] ?? []) as $force) {

                $data = $force['data'] ?? [];

                $rows[] = [
                    $force['group'] ?? '',
                    $force['code'] ?? '',

                    $this->formatValue($data['vx'] ?? null),
                    $this->formatValue($data['vy'] ?? null),
                    $this->formatValue($data['vz'] ?? null),

                    $this->formatValue($data['zx'] ?? null),
                    $this->formatValue($data['zy'] ?? null),
                    $this->formatValue($data['zz'] ?? null),

                    $this->formatValue($data['sx'] ?? null),
                    $this->formatValue($data['sy'] ?? null),
                ];
            }

            $rows[] = [];

            $rows[] = [
                'Тип на столб:',
                $summary['tower_type'] ?? '',
                '',
                'Изолациона верига:',
                $summary['insulator'] ?? '',
                '',
                'a =',
                isset($summary['agol_t'])
                    ? number_format((float)$summary['agol_t'], 3, '.', '') . ' [°]'
                    : '',
            ];

            $rows[] = [
                'Гравитационен распон на спроводник:',
                isset($summary['grr_vpro'])
                    ? number_format((float)$summary['grr_vpro'], 2, '.', '') . ' [m]'
                    : '',
                '',
                'Гравитационен распон на з. ј.:',
                isset($summary['grr_vzaj'])
                    ? number_format((float)$summary['grr_vzaj'], 2, '.', '') . ' [m]'
                    : '',
                '',
                'Среден распон:',
                isset($summary['sre_ras'])
                    ? number_format((float)$summary['sre_ras'], 2, '.', '') . ' [m]'
                    : '',
            ];

            $rows[] = [];
            $rows[] = [];
        }

        return $rows;
    }

    private function formatValue($value): string
    {
        if ($value === null || $value === '') {
            return '';
        }

        return number_format((float)$value, 2, '.', '');
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 14,
                ],
            ],
        ];
    }
}
