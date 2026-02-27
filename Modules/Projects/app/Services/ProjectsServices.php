<?php

namespace Modules\Projects\Services;

use App\Services\Responses\ResponseError;
use App\Services\Responses\ResponseSuccess;
use Illuminate\Http\Request;
use Modules\Projects\Dto\ProjectsDto;
use Modules\Projects\Repositories\ProjectsRepositories;
use PhpOffice\PhpSpreadsheet\IOFactory;


class ProjectsServices
{
    protected ?string $classPath;
    public function __construct(public ProjectsRepositories $projectsRepositories)
    {
        $this->classPath = __DIR__ . '/' . class_basename(__CLASS__) . '.php';
    }

    public function index($params): array
    {
        $projects= $this->projectsRepositories->getAllProjects($params);
        $voltages = $this->projectsRepositories->getAllVoltages();
        $conductors = $this->projectsRepositories->getAllConductors();
        $groundWires = $this->projectsRepositories->getAllGroundWires();

        return ['data' => [
            'projects' => $projects,
            'voltages' => $voltages,
            'conductors' => $conductors,
            'groundWires' => $groundWires,
        ]];
    }

    public function create(): array
    {
        $voltages = $this->projectsRepositories->getAllVoltages();
        $conductors = $this->projectsRepositories->getAllConductors();
        $groundWires= $this->projectsRepositories->getAllGroundWires();

        $endpoints = $this->projectsRepositories->getAllEndpoints();
        $windPressure= $this->projectsRepositories->getAllWindPressure();
        $insulatorChain= $this->projectsRepositories->getAllInsulatorChains();


        return ['data' => [
            'voltages' => $voltages,
            'conductors' => $conductors,
            'groundWires' => $groundWires,
            'endpoints' => $endpoints,
            'windPressure' => $windPressure,
            'insulatorChain' => $insulatorChain,

        ]];
    }

    public function store(ProjectsDto $projectsDto): ResponseError|ResponseSuccess
    {
        // STORE PROJECT
        $project = $this->projectsRepositories->storeProject($projectsDto);

        if ($project->id_starting_point==1){
            $trafo = $this->projectsRepositories->createTrafo($project->id);
            $id_trafo1 = $trafo->id;
        }
        else {$id_trafo1=null;}

        if ($project->id_ending_point==1){
            $trafo = $this->projectsRepositories->createTrafo($project->id);
            $id_trafo2 = $trafo->id;
        }
        else {$id_trafo2=null;}

        // CREATE STARTPOINT
       $this->projectsRepositories->createEndpoints($project->id,$project->id_starting_point,$id_trafo1);
        // CREATE ENDPOINT
       $this->projectsRepositories->createEndpoints($project->id,$project->id_ending_point,$id_trafo2);

        if (!$project) {
            return new ResponseError('method: storeProject($projectsDto)',  $this->classPath,[]);
        }

        return new ResponseSuccess('','',['id'=>$project->id]);
    }

    public function edit( int $id): array
    {
        $endpoints = $this->projectsRepositories->getAllEndpoints();
        $project = $this->projectsRepositories->getProjectById($id);
        $trafo = $this->projectsRepositories->getTrafoByIdProject($id);
        $voltages = $this->projectsRepositories->getAllVoltages();
        $conductors = $this->projectsRepositories->getAllConductors();
        $groundWires= $this->projectsRepositories->getAllGroundWires();
        $windPressure= $this->projectsRepositories->getAllWindPressure();
        $insulatorChain= $this->projectsRepositories->getAllInsulatorChains();



        return ['data' => [
            'endpoints' => $endpoints,
            'project' => $project,
            'trafo' => $trafo,
            'voltages' => $voltages,
            'conductors' => $conductors,
            'groundWires' => $groundWires,
            'windPressure' => $windPressure,
            'insulatorChain' => $insulatorChain,

        ]];
    }

    public function update(ProjectsDto $projectsDto): ResponseSuccess|ResponseError
    {


        $id = $projectsDto->id;

        //dd($id);
        // CHECK IF PROJECT EXIST ///////////////////////////////////////////////

        $project_old = $this->projectsRepositories->getProjectById($id);

        if (!$project_old) {
            return new ResponseError('method: getProjectById($id)',  $this->classPath, ['message_error'=>__('projects.ProjectServices.error_no_existing_projects')]);
        }
        //dd($projectsDto->id_starting_point);
        // UPDATE PROJECT
        $project = $this->projectsRepositories->updateProject($id, $projectsDto);
        if (!$project) {
            return new ResponseError('$id, $projectsDto',  $this->classPath,['message_error'=>__('error_update_project')]);
        }

        //dd($project->id_starting_point.'fgkhjf');

        if($project->id_starting_point==1&&$project_old->id_starting_point!=$project->id_starting_point) {

            //CREATE TRAFO
            $trafo1=$this->projectsRepositories->createTrafo($project->id);
            //RESET trasa
            $this->projectsRepositories->resetTrasa($project->id,$trafo1->id);
        }

        if($project->id_starting_point==2&&$project_old->id_starting_point!=$project->id_starting_point) {

            //RESET trasa
            $this->projectsRepositories->resetTrasa($project->id,null);
            //DELETE TRAFO
            $this->projectsRepositories->deleteTrafo($project->id);

        }

        if($project->id_ending_point==1&&$project_old->id_ending_point!=$project->id_ending_point) {

            //CREATE TRAFO
            $trafo2=$this->projectsRepositories->createTrafo($project->id);
            //RESET trasa
            $this->projectsRepositories->resetTrasaLatest($project->id,$trafo2->id);
        }

        if($project->id_ending_point==2&&$project_old->id_ending_point!=$project->id_ending_point) {

            //RESET trasa
            $this->projectsRepositories->resetTrasaLatest($project->id,null);
            //DELETE TRAFO
            $this->projectsRepositories->deleteTrafo($project->id);

        }


        return new ResponseSuccess('update($activities, ProjectsDto $projectsDto)',$this->classPath,[]);
    }

    public function deleteProject($id): ResponseSuccess|ResponseError
    {
        $return= $this->projectsRepositories->deleteProject($id);
        if (!$return) {
            return new ResponseError('method: deleteProject($id)',  $this->classPath,[]);
        }
        return new ResponseSuccess('','',[]);
    }



    public function editEndPoints( int $id_project): array
    {
        $project = $this->projectsRepositories->getProjectById($id_project);
        $trasa = $this->projectsRepositories->getTrasaByIdProjectTopTwo($id_project);

        return ['data' => [
            'project' => $project,
            'trasa' => $trasa,


        ]];
    }
    public function updateEndPoints(int $projectId, array $request): ResponseSuccess|ResponseError
    {
        // UPDATE END POINTS
        $project = $this->projectsRepositories->updateEndPoints($projectId, $request);
        if (!$project) {
            return new ResponseError('$id, $projectsDto',  $this->classPath,['message_error'=>__('error_update_project')]);
        }

        return new ResponseSuccess('update($activities, ProjectsDto $projectsDto)',$this->classPath,[]);
    }


    public function editPoints( int $id_project, $request): array
    {
        $project = $this->projectsRepositories->getProjectById($id_project);
        $trasa = $this->projectsRepositories->getTrasaByIdProject($id_project, $request);
        $firstTwoIds =$this->projectsRepositories->firstTwoIds($id_project);
        $pointsGR = $this->projectsRepositories->showProfile($id_project);
        return ['data' => [
            'firstTwoIds' => $firstTwoIds,
            'project' => $project,
            'trasa' => $trasa,
            'pointsGR' => $pointsGR,

        ]];
    }



    public function editPoint( int $id_project, $request,$id_point): array
    {

        $project = $this->projectsRepositories->getProjectById($id_project);
        $trasa = $this->projectsRepositories->getTrasaByIdProject($id_project, $request);
        $firstTwoIds =$this->projectsRepositories->firstTwoIds($id_project);
        $point = $this->projectsRepositories->getPointById($id_point);
        $pointsGR = $this->projectsRepositories->showProfile($id_project);

        return ['data' => [
            'firstTwoIds' => $firstTwoIds,
            'project' => $project,
            'trasa' => $trasa,
            'point' => $point,
            'pointsGR' => $pointsGR,


        ]];
    }

    public function storePoint($request): ResponseError|ResponseSuccess
    {
        // STORE POINT
        $point = $this->projectsRepositories->storePoint($request);
        if (!$point) {
            return new ResponseError('method: storeProject($projectsDto)',  $this->classPath,[]);
        }
        return new ResponseSuccess('','',[]);
    }

    public function updatePoint(int $projectId, $id_point, array $request): ResponseSuccess|ResponseError
    {
        // UPDATE POINT
        $project = $this->projectsRepositories->updatePoint($projectId, $id_point, $request);
        if (!$project) {
            return new ResponseError('$id, $projectsDto',  $this->classPath,['message_error'=>__('error_update_project')]);
        }
        return new ResponseSuccess('update($activities, ProjectsDto $projectsDto)',$this->classPath,[]);
    }

    public function deletePoint($id): ResponseSuccess|ResponseError
    {
        // DELETE POINT
        $return= $this->projectsRepositories->deletePoint($id);
        if (!$return) {
            return new ResponseError('method: deletePoint($id)',  $this->classPath,[]);
        }
        return new ResponseSuccess('','',[]);
    }





    public function showTower($id): array
    {

        $tower = $this->projectsRepositories->getTowerById($id);
        //dd($tower);
        $voltages = $this->projectsRepositories->getAllVoltages();
        return ['data' => [
            'tower' => $tower,
            'voltages' => $voltages,
        ]];

    }

    public function calculations( int $id_project): array
    {

        $this->projectsRepositories->deleteRaspres($id_project);
        $this->projectsRepositories->raspres($id_project);

        $this->projectsRepositories->deleteZatpol($id_project);
        $this->projectsRepositories->zatpol($id_project);

        $this->projectsRepositories->napreg($id_project);

        $this->projectsRepositories->rastotal($id_project);

        $this->projectsRepositories->deleteGraviras($id_project);
        $this->projectsRepositories->graviras($id_project);

        $raspres = $this->projectsRepositories->getRaspresByIdProject($id_project);
        $zatpol = $this->projectsRepositories->getZatpolByIdProject($id_project);
        $gapres = $this->projectsRepositories->getGapresByIdProject($id_project);

        $project = $this->projectsRepositories->getProjectById($id_project);

        return ['data' => [
            'raspres' => $raspres,
            'zatpol' => $zatpol,
            'gapres' => $gapres,
            'project' => $project,


        ]];
    }

    public function controls( int $id_project): array
    {

        $raspres = $this->projectsRepositories->getRaspresByIdProject($id_project);
        $zatpol = $this->projectsRepositories->getZatpolByIdProject($id_project);
        $gapres = $this->projectsRepositories->getGapresByIdProject($id_project);

        $project = $this->projectsRepositories->getProjectById($id_project);
        return ['data' => [
            'raspres' => $raspres,
            'zatpol' => $zatpol,
            'gapres' => $gapres,
            'project' => $project,
        ]];
    }

    public function situation( int $id_project): array
    {

        $situation = $this->projectsRepositories->getSituationByIdProject($id_project);
        $project = $this->projectsRepositories->getProjectById($id_project);
        return ['data' => [
            'situation' => $situation,
            'project' => $project,
        ]];
    }

    public function tableForces( int $id_project): array
    {

        $raspres = $this->projectsRepositories->getRaspresByIdProject($id_project);
        $zatpol = $this->projectsRepositories->getZatpolByIdProject($id_project);
        $gapres = $this->projectsRepositories->getGapresByIdProject($id_project);

        $project = $this->projectsRepositories->getProjectById($id_project);
        return ['data' => [
            'raspres' => $raspres,
            'zatpol' => $zatpol,
            'gapres' => $gapres,
            'project' => $project,
        ]];
    }
    public function tableTowers(int $id_project): array
    {
        $project = $this->projectsRepositories->_getProjectById($id_project);

        $towers  = $this->projectsRepositories->_getTowersByIdProject($id_project)->values();
        $spans   = $this->projectsRepositories->_getRaspresByIdProject($id_project)->values();
        $fields  = $this->projectsRepositories->_getZatpolByIdProject($id_project)->values();

        // 1) Индексирај затезни полиња за брзо барање
        //    (ова ќе ти даде поле за секој tower)
        $fieldForTower = function(float $stac) use ($fields) {
            foreach ($fields as $f) {
                $po = (float)($f->stac_po ?? 0);
                $kr = (float)($f->stac_kr ?? $f->stac_kr ?? 0); // кај тебе е stac_kr или stac_kr? провери име
                // ако во табелата е stac_kr (како на скрин), користи stac_kr:
                $kr = (float)($f->stac_kr ?? $f->stac_kr ?? $f->stac_kr ?? 0);

                if ($stac >= $po && $stac <= $kr) {
                    return $f;
                }
            }
            return null;
        };

        // 2) Креирај редови за табелата
        $rows = [];
        $n = $towers->count();

        for ($i = 0; $i < $n; $i++) {
            $towerRow = $towers[$i];

            $stac = (float)($towerRow->stac_t ?? 0);
            $agol = (float)($towerRow->agol_tr ?? 0);

            // spans: за N towers, очекуваме N-1 spans
            // next span = spans[i]  (од tower i до i+1)
            // prev span = spans[i-1] (од tower i-1 до i)
            $nextSpanRow = ($i < $n-1) ? ($spans[$i]   ?? null) : null;
            $prevSpanRow = ($i > 0)   ? ($spans[$i-1] ?? null) : null;

            $hNext = $nextSpanRow ? (float)($nextSpanRow->raspon ?? 0) : 0.0;
            $hPrev = $prevSpanRow ? (float)($prevSpanRow->raspon ?? 0) : 0.0;

            // Хориз. распон (кај првиот ред има, кај последниот е празно)
            $horiz = ($i < $n-1) ? $hNext : null;

            // Среден распон
            if ($i === 0) {
                $avg = $hNext / 2;
            } elseif ($i === $n-1) {
                $avg = $hPrev / 2;
            } else {
                $avg = ($hPrev + $hNext) / 2;
            }

            // Гравитационен (ако ти се веќе пресметани во raspres како dol_pro / dol_zaj)
            // ЛЕВ = од претходниот распон, ДЕСЕН = од следниот распон
            $gravLeft  = $prevSpanRow ? (float)($prevSpanRow->dol_pro ?? 0) : 0.0;
            $gravRight = $nextSpanRow ? (float)($nextSpanRow->dol_pro ?? 0) : 0.0;
            $gravTotal = $gravLeft + $gravRight;

            // Тип на столб
            $towerType = optional($towerRow->tower)->type
                ?? optional($towerRow->tower)->tip
                ?? '';

            // Тип на изолатор (берерија) како EZ/EZ
            $iz1 = optional($towerRow->insulator1)->type ?? '';
            $iz2 = optional($towerRow->insulator2)->type ?? '';
            $iz  = (trim($iz1) || trim($iz2)) ? (trim($iz1).'/'.trim($iz2)) : '';

            // Затезно поле за овој столб
            $field = $fieldForTower($stac);

            $rows[] = [
                'i'          => $i,
                'stolb_no'   => $i + 1,
                'stac_t'     => $stac,
                'tower_type' => $towerType,
                'izolator'   => $iz,
                'agol'       => $agol ?: null,

                'horiz'      => $horiz,     // (m)
                'avg'        => $avg,       // (m)

                'grav_left'  => $gravLeft,
                'grav_right' => $gravRight,
                'grav_total' => $gravTotal,

                // од zatpol (климатски/напрегања по поле)
                'field'      => $field, // цел објект (за rowspans во blade)
            ];
        }

        // 3) Групирај редови по затезно поле (по ID или по stac_po)
        // Ако немаш ID, користи stac_po како key
        $grouped = collect($rows)->groupBy(function($r) {
            $f = $r['field'];
            return $f ? ('F_'.$f->id) : 'F_NONE';
        })->values();

        return ['data' => [
            'project'  => $project,
            'towers'   => $towers,
            'rows'     => $rows,
            'grouped'  => $grouped,
            'fields'   => $fields,
        ]];
    }

    public function tableStringing( int $id_project): array
    {

        $raspres = $this->projectsRepositories->getRaspresByIdProject($id_project);
        $zatpol = $this->projectsRepositories->getZatpolByIdProject($id_project);
        $gapres = $this->projectsRepositories->getGapresByIdProject($id_project);

        $project = $this->projectsRepositories->getProjectById($id_project);
        return ['data' => [
            'raspres' => $raspres,
            'zatpol' => $zatpol,
            'gapres' => $gapres,
            'project' => $project,
        ]];
    }

    public function showRaspres( int $id_project): array
    {
        $raspres = $this->projectsRepositories->getRaspresByIdProject($id_project);
        return ['data' => [
            'raspres' => $raspres,
        ]];
    }

    public function showZatpol( int $id_project): array
    {
        $zatpol = $this->projectsRepositories->getZatpolByIdProject($id_project);
        return ['data' => [
            'zatpol' => $zatpol,
        ]];
    }

    public function showGapres( int $id_project): array
    {
        $gapres = $this->projectsRepositories->getGapresByIdProject($id_project);
        return ['data' => [
            'gapres' => $gapres,


        ]];
    }
    public function importPoints(int $projectId, Request $request): ResponseError|ResponseSuccess
    {
        $methodName = 'importPoints(int $projectId, Request $request)';

        if (!$request->hasFile('exel')) {
            return new ResponseError($methodName, $this->classPath, ['id_error'=>'1']);
        }

        $file = $request->file('exel');
        if (!$file->isValid()) {
            return new ResponseError($methodName, $this->classPath, ['id_error'=>'2']);
        }


        $spreadsheet = IOFactory::load($file->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();

        $rowsToInsert = [];

        $rows = $sheet->toArray(
            null,   // nullValue
            false,  // calculateFormulas
            false,  // formatData
            true    // returnCellRef (чуваме A,B,C... како keys)
        );

        foreach ($rows as $rowIndex => $row) {
            // прескокни header
            if ($rowIndex === 1) {
                continue;
            }
            // A = stacionaza, B = kota
            $stacionaza = trim((string) ($row['A'] ?? ''));
            $kota       = trim((string) ($row['B'] ?? ''));
            $agol      = trim((string) ($row['C'] ?? ''));
            // ако целиот ред е празен – прескокни
            if ($stacionaza === '' && $kota === ''&& $agol === '') {
                continue;
            }
            // замени запирка со точка
            $stacionaza = str_replace(',', '.', $stacionaza);
            $kota       = str_replace(',', '.', $kota);
            $agol       = str_replace(',', '.', $agol);

            $rowsToInsert[] = [
                'id_project' => $projectId,
                'stac_t'     => is_numeric($stacionaza) ? (float) $stacionaza : null,
                'kota_t'     => is_numeric($kota)       ? (float) $kota       : null,
                'agol_tr'    => is_numeric($agol)       ? (float) $agol       : null,
                'imported'   => 1,
                'id_tower'   => null,
                'id_trafo'   => null,
                'id_insulator1' => null,
                'id_insulator2' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        if (empty($rowsToInsert)) {
            return new ResponseError($methodName, $this->classPath, ['id_error'=>'4']);
        }
        $importPoints = $this->projectsRepositories->importPoints($rowsToInsert);
        if (!$importPoints) {
            return new ResponseError($methodName, $this->classPath, ['id_error'=>'5']);
        }
        return new ResponseSuccess($methodName, $this->classPath,[]);
    }

    public function importSituation(int $projectId, Request $request): ResponseError|ResponseSuccess
    {

        $methodName = 'importSituation(int $projectId, Request $request)';

        if (!$request->hasFile('exel')) {
            return new ResponseError($methodName, $this->classPath, ['id_error'=>'1']);
        }

        $file = $request->file('exel');
        if (!$file->isValid()) {
            return new ResponseError($methodName, $this->classPath, ['id_error'=>'2']);
        }


        $spreadsheet = IOFactory::load($file->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();

        $rowsToInsert = [];

        $rows = $sheet->toArray(
            null,   // nullValue
            false,  // calculateFormulas
            false,  // formatData
            true    // returnCellRef (чуваме A,B,C... како keys)
        );

        foreach ($rows as $rowIndex => $row) {
            // прескокни header
            if ($rowIndex === 1) {
                continue;
            }
            // A = stacionaza, B = kota
            $x= trim((string) ($row['A'] ?? ''));
            $y      = trim((string) ($row['B'] ?? ''));
            $z      = trim((string) ($row['C'] ?? ''));
            // ако целиот ред е празен – прескокни
            if ($x === '' && $y === ''&& $z === '') {
                continue;
            }
            // замени запирка со точка
            $x = str_replace(',', '.', $x);
            $y       = str_replace(',', '.', $y);
            $z      = str_replace(',', '.', $z);

            $rowsToInsert[] = [
                'id_project' => $projectId,
                'x'     => is_numeric($x) ? (float) $x : null,
                'y'     => is_numeric($y)       ? (float) $y       : null,
                'z'    => is_numeric($z)       ? (float) $z       : null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        if (empty($rowsToInsert)) {
            return new ResponseError($methodName, $this->classPath, ['id_error'=>'4']);
        }
        $importPoints = $this->projectsRepositories->importSituations($rowsToInsert);
        if (!$importPoints) {
            return new ResponseError($methodName, $this->classPath, ['id_error'=>'5']);
        }
        return new ResponseSuccess($methodName, $this->classPath,[]);
    }





    public function deleteImportedPoints($id): ResponseSuccess|ResponseError
    {
        $return= $this->projectsRepositories->deleteImportedPoints($id);
        if (!$return) {
            return new ResponseError('method: deleteImportPoints($id)',  $this->classPath,[]);
        }
        return new ResponseSuccess('','',[]);
    }



    public function towers($id, $params, $id_tower): array
    {

        $id_voltage = $this->projectsRepositories->getProjectById($id)->id_voltage;
        $voltage = $this->projectsRepositories->getVoltageById($id_voltage)->title;
        $towers = $this->projectsRepositories->getAllTowersVoltage($voltage,$params,$id_tower);
        $voltages = $this->projectsRepositories->getAllVoltages();
        return ['data' => [
            'towers' => $towers,
            'voltages' => $voltages,
        ]];
    }
    public function insulators($id, $params,$idInsulators): array
    {

        $id_voltage = $this->projectsRepositories->getProjectById($id)->id_voltage;
        $voltage = $this->projectsRepositories->getVoltageById($id_voltage)->title;
        $insulator_chain = $this->projectsRepositories->getAllInsulatorChains();
        $insulators = $this->projectsRepositories->getAllInsulatorsVoltage($voltage,$params,$idInsulators);
        $voltages = $this->projectsRepositories->getAllVoltages();
        return ['data' => [
            'insulators' => $insulators,
            'insulator_chain' => $insulator_chain,
            'voltages' => $voltages,
        ]];
    }


}
