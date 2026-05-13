<?php

namespace Modules\Projects\Services;

use App\Services\Responses\ResponseError;
use App\Services\Responses\ResponseSuccess;
use Illuminate\Http\Request;
use Modules\Projects\Dto\ProjectsDto;
use Modules\Projects\Repositories\Controls;
use Modules\Projects\Repositories\Elpres;
use Modules\Projects\Repositories\Graviras;
use Modules\Projects\Repositories\Grvrast;
use Modules\Projects\Repositories\Napreg;
use Modules\Projects\Repositories\ProjectsRepositories;
use Modules\Projects\Repositories\Raspres;
use Modules\Projects\Repositories\Rastotal;
use Modules\Projects\Repositories\Srerast;
use Modules\Projects\Repositories\Zatpol;
use PhpOffice\PhpSpreadsheet\IOFactory;


class ProjectsServices
{
    protected ?string $classPath;
    public function __construct(public ProjectsRepositories $projectsRepositories, public Raspres $raspres , public Zatpol $zatpol, public Napreg $napreg, public Rastotal $rastotal, public Grvrast $grvrast, public Srerast $srerast, public Graviras $graviras, public Elpres $elpres, public Controls $controls)
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

        // CHECK IF PROJECT EXIST ///////////////////////////////////////////////

        $project_old = $this->projectsRepositories->getProjectById($id);

        if (!$project_old) {
            return new ResponseError('method: getProjectById($id)',  $this->classPath, ['message_error'=>__('projects.ProjectServices.error_no_existing_projects')]);
        }

        // UPDATE PROJECT
        $project = $this->projectsRepositories->updateProject($id, $projectsDto);
        if (!$project) {
            return new ResponseError('$id, $projectsDto',  $this->classPath,['message_error'=>__('error_update_project')]);
        }


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

        $this->projectsRepositories->setCalculation($id, 0);
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

    public function copyProject($id): ResponseSuccess|ResponseError
    {
        $return= $this->projectsRepositories->copyProject($id);


        if (!$return) {
            return new ResponseError('method: copyProject($id)',  $this->classPath,[]);
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

        $this->projectsRepositories->setCalculation($projectId, 0);
        return new ResponseSuccess('update($activities, ProjectsDto $projectsDto)',$this->classPath,[]);
    }


    public function editPoints( int $id_project, $request): array
    {
        $project = $this->projectsRepositories->getProjectById($id_project);
        $trasa = $this->projectsRepositories->getTrasaByIdProject($id_project, $request);
        $firstTwoIds =$this->projectsRepositories->firstTwoIds($id_project);
        $pointsGR = $this->projectsRepositories->showProfile($id_project);
        $checkImportPoints = $this->projectsRepositories->checkImportPoints($id_project);
        return ['data' => [
            'firstTwoIds' => $firstTwoIds,
            'project' => $project,
            'trasa' => $trasa,
            'pointsGR' => $pointsGR,
            'checkImportPoints' => $checkImportPoints,

        ]];
    }



    public function editPoint( int $id_project, $request,$id_point): array
    {

        $project = $this->projectsRepositories->getProjectById($id_project);
        $trasa = $this->projectsRepositories->getTrasaByIdProject($id_project, $request);
        $firstTwoIds =$this->projectsRepositories->firstTwoIds($id_project);
        $point = $this->projectsRepositories->getPointById($id_point);
        $pointsGR = $this->projectsRepositories->showProfile($id_project);
        $checkImportPoints = $this->projectsRepositories->checkImportPoints($id_project);

        return ['data' => [
            'firstTwoIds' => $firstTwoIds,
            'project' => $project,
            'trasa' => $trasa,
            'point' => $point,
            'pointsGR' => $pointsGR,
            'checkImportPoints' => $checkImportPoints,


        ]];
    }

    public function storePoint($request): ResponseError|ResponseSuccess
    {
        // STORE POINT
        $point = $this->projectsRepositories->storePoint($request);
        if (!$point) {
            return new ResponseError('method: storeProject($projectsDto)',  $this->classPath,[]);
        }
        $this->projectsRepositories->setCalculation($request->id, 0);
        return new ResponseSuccess('','',[]);
    }

    public function updatePoint(int $projectId, $id_point, array $request): ResponseSuccess|ResponseError
    {
        // UPDATE POINT
        $project = $this->projectsRepositories->updatePoint($projectId, $id_point, $request);
        if (!$project) {
            return new ResponseError('$id, $projectsDto',  $this->classPath,['message_error'=>__('error_update_project')]);
        }
        $this->projectsRepositories->setCalculation($projectId, 0);
        return new ResponseSuccess('update($activities, ProjectsDto $projectsDto)',$this->classPath,[]);
    }

    public function deletePoint($id): ResponseSuccess|ResponseError
    {
        // DELETE POINT
        $return= $this->projectsRepositories->deletePoint($id);
        if (!$return) {
            return new ResponseError('method: deletePoint($id)',  $this->classPath,[]);
        }

        $this->projectsRepositories->setCalculation($return, 0);
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
    public function calculate($id_project): ResponseSuccess|ResponseError
    {
        $this->projectsRepositories->deleteRaspres($id_project);
        $this->projectsRepositories->deleteZatpol($id_project);
        $this->projectsRepositories->deleteGraviras($id_project);


        //RASPRES tabela
        $this->raspres->raspres($id_project);

        //ZATPOL tabela
        $this->zatpol->zatpol($id_project);
        $this->napreg->napreg($id_project);

        //RASPRES tabela
        $this->rastotal->rastotal($id_project);


        //GAPRES tabela
        $this->graviras->graviras($id_project);
        $this->srerast->srerast($id_project);
        $this->grvrast->grvrast($id_project);
        $this->elpres->elpres($id_project);


        $this->projectsRepositories->setCalculation($id_project, 1);
        return new ResponseSuccess('','',[]);
    }



    public function calculations( int $id_project): array
    {

        $project = $this->projectsRepositories->getProjectById($id_project);

        $isCalculate = $project->calculation;
        //dd($isCalculate);

//        if($project->calculation === 0){
//
//        $this->projectsRepositories->deleteRaspres($id_project);
//        $this->projectsRepositories->deleteZatpol($id_project);
//        $this->projectsRepositories->deleteGraviras($id_project);
//
//
//        //RASPRES tabela
//        $this->raspres->raspres($id_project);
//
//        //ZATPOL tabela
//        $this->zatpol->zatpol($id_project);
//        $this->napreg->napreg($id_project);
//
//        //RASPRES tabela
//        $this->rastotal->rastotal($id_project);
//
//
//        //GAPRES tabela
//        $this->graviras->graviras($id_project);
//        $this->srerast->srerast($id_project);
//        $this->grvrast->grvrast($id_project);
//        $this->elpres->elpres($id_project);
//
//        }

        $raspres = $this->projectsRepositories->getRaspresByIdProject($id_project);
        $zatpol = $this->projectsRepositories->getZatpolByIdProject($id_project);
        $gapres = $this->projectsRepositories->getGapresByIdProject($id_project);



        //$this->projectsRepositories->setCalculation($id_project, 1);

        return ['data' => [
            'raspres' => $raspres,
            'zatpol' => $zatpol,
            'gapres' => $gapres,
            'project' => $project,
            'isCalculate' => $isCalculate,


        ]];
    }

    public function controls( int $id_project): array
    {

        $project = $this->projectsRepositories->getProjectById($id_project);
        $kongras = $this->controls->kongras($id_project);
        $konelras = $this->controls->konelras($id_project);
        $isCalculate = $project->calculation;


        return ['data' => [

            'project' => $project,
            'kongras' => $kongras,
            'konelras' => $konelras,
            'isCalculate' => $isCalculate,
        ]];
    }

    public function situation( int $id_project): array
    {

        $situation = $this->projectsRepositories->getSituationByIdProject($id_project);
        $situationP = $this->projectsRepositories->getSituationByIdProjectP($id_project);
        $project = $this->projectsRepositories->getProjectById($id_project);
        $checkImportSituation = $this->projectsRepositories->checkImportSituation($id_project);
        $checkImportSituationP = $this->projectsRepositories->checkImportSituationP($id_project);
        return ['data' => [
            'situation' => $situation,
            'situationP' => $situationP,
            'project' => $project,
            'checkImportSituation' => $checkImportSituation,
            'checkImportSituationP' => $checkImportSituationP,
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

        $trasa   = $this->projectsRepositories->_getTrasaByIdProject($id_project)->values();
        $raspres = $this->projectsRepositories->_getRaspresByIdProject($id_project)->values();
        $zatpol  = $this->projectsRepositories->_getZatpolByIdProject($id_project)->values();
        $gapres  = $this->projectsRepositories->_getGapresByIdProject($id_project)->values();

        // ============================================================
        // MAP: id_trasa -> raspres
        // ============================================================
        $raspresMap = [];
        foreach ($raspres as $r) {
            $idTrasa = (int) ($r->id_trasa ?? 0);
            if ($idTrasa > 0) {
                $raspresMap[$idTrasa] = $r;
            }
        }

        // ============================================================
        // MAP: id_trasa -> gapres
        // ============================================================
        $gapresMap = [];
        foreach ($gapres as $g) {
            $idTrasa = (int) ($g->id_trasa ?? 0);
            if ($idTrasa > 0) {
                $gapresMap[$idTrasa] = $g;
            }
        }

        // ============================================================
        // MAP: zatpol start / end
        // ============================================================
        $zatpolByStart = [];
        $zatpolByEnd   = [];

        foreach ($zatpol as $z) {
            $po = (int) ($z->id_trasa_po ?? 0);
            $kr = (int) ($z->id_trasa_kr ?? 0);

            if ($po > 0) {
                $zatpolByStart[$po] = $z;
            }

            if ($kr > 0) {
                $zatpolByEnd[$kr] = $z;
            }
        }

        // ============================================================
        // ZATPOL numbering
        // ============================================================
        $zatpolSorted = $zatpol->sortBy('stac_po')->values();

        $zatpolIndex = [];
        foreach ($zatpolSorted as $i => $z) {
            $zatpolIndex[(int)$z->id] = $i + 1;
        }

        $result = [];
        $n = $trasa->count();

        for ($i = 0; $i < $n; $i++) {

            $current = $trasa[$i];

            $isTower = (int)($current->id_tower ?? 0) > 0;
            $isTrafo = (int)($current->id_trafo ?? 0) > 0;

            if (!$isTower && !$isTrafo) {
                continue;
            }

            $next = $trasa[$i + 1] ?? null;
            $prev = $trasa[$i - 1] ?? null;

            $currentStac = (float) ($current->stac_t ?? 0);

            // ============================================================
            // ХОРИЗ. РАСПОН
            // ============================================================
            $hNext = $next ? ((float)$next->stac_t - (float)$current->stac_t) : null;
            $hPrev = $prev ? ((float)$current->stac_t - (float)$prev->stac_t) : null;

            $horiz = $hNext !== null ? (float)$hNext : null;

            // ============================================================
            // СРЕДЕН РАСПОН
            // ============================================================
            if ($i === 0) {
                $avg = $hNext !== null ? $hNext / 2 : null;
            } elseif ($i === $n - 1) {
                $avg = $hPrev !== null ? $hPrev / 2 : null;
            } else {
                $avg = (($hPrev ?? 0) + ($hNext ?? 0)) / 2;
            }

            // ============================================================
            // ГРАВИТАЦИОНИ РАСПОНИ -> GAPRES
            // ============================================================
            $gap = $gapresMap[(int)$current->id] ?? null;

            $left  = $gap ? (float)($gap->grr_lpro ?? 0) : 0.0;
            $right = $gap ? (float)($gap->grr_dpro ?? 0) : 0.0;
            $total = $gap ? (float)($gap->grr_vpro ?? 0) : 0.0;

            // ============================================================
            // ZATPOL за табеларни податоци
            // ============================================================
            $fieldStart = $zatpolByStart[(int)$current->id] ?? null;
            $fieldEnd   = $zatpolByEnd[(int)$current->id] ?? null;

            $isBoundary = ($fieldStart || $fieldEnd);

            if ($isBoundary) {
                $field = $fieldEnd ?? $fieldStart;
            } else {
                $field = $zatpolSorted->first(function ($z) use ($currentStac) {
                    $po = (float) ($z->stac_po ?? 0);
                    $kr = (float) ($z->stac_kr ?? 0);

                    return $currentStac >= $po && $currentStac < $kr;
                });
            }

            // ============================================================
            // DOS Z.p. logic
            // ============================================================
            $startNo = $fieldStart ? ($zatpolIndex[(int)$fieldStart->id] ?? null) : null;
            $endNo   = $fieldEnd ? ($zatpolIndex[(int)$fieldEnd->id] ?? null) : null;

            // fallback поле: полето што го содржи столбот
            $containField = $zatpolSorted->first(function ($z) use ($currentStac) {
                $po = (float) ($z->stac_po ?? 0);
                $kr = (float) ($z->stac_kr ?? 0);

                return $currentStac >= $po && $currentStac < $kr;
            });

            // за последниот столб, ако не фати со < stac_kr
            if (!$containField && $zatpolSorted->isNotEmpty()) {
                $lastField = $zatpolSorted->last();
                if ((float)$currentStac === (float)($lastField->stac_kr ?? 0)) {
                    $containField = $lastField;
                }
            }

            $containNo = $containField ? ($zatpolIndex[(int)$containField->id] ?? null) : null;

            if ($startNo && $endNo) {
                $zp = $endNo . '/' . $startNo;
            } elseif ($endNo) {
                $zp = (string) $endNo;
            } elseif ($startNo) {
                $zp = (string) $startNo;
            } elseif ($containNo) {
                $zp = (string) $containNo;
            } else {
                $zp = '';
            }

            // ============================================================
            // ИМЕ НА СТОЛБ / ТРАФО
            // ============================================================
            $towerName = $isTower
                ? (optional($current->tower)->name ?? optional($current->tower)->type ?? '')
                : (optional($current->trafo)->ime ?? '');

            // ============================================================
            // ИЗОЛАТОР
            // ============================================================
            $iz1 = optional($current->insulator1)->type ?? '';
            $iz2 = optional($current->insulator2)->type ?? '';
            $iz  = trim($iz1 . '/' . $iz2, '/');

            $result[] = [
                'zp'             => $zp,
                'id'             => (int) $current->id,
                'stolb_no'       => count($result) + 1,
                'stac_t'         => (float) ($current->stac_t ?? 0),

                'tower_name'     => $towerName,
                'izolator'       => $iz,
                'agol'           => (float) ($current->agol_tr ?? 0),

                'horiz'          => $horiz,
                'avg'            => $avg,

                'left'           => $left,
                'right'          => $right,
                'total'          => $total,

                'pole_dol'       => $field ? (float)($field->pole_dol ?? 0) : null,
                'nap_pro'        => $field ? (float)($field->nap_pro ?? 0) : null,
                'nap_zaj'        => $field ? (float)($field->nap_zaj ?? 0) : null,
                'kndt'           => $field ? (float)($field->kndt ?? 0) : null,
                'kidt'           => $field ? (float)($field->kidt ?? 0) : null,
                'priv'           => $field ? (float)($field->priv ?? 0) : null,

                // debug
                'field_id_start' => $fieldStart->id ?? null,
                'field_id_end'   => $fieldEnd->id ?? null,
                'field_id_used'  => $field->id ?? null,
            ];
        }

        return ['data' => [
            'project' => $project,
            'trasa'   => $result,
        ]];
    }

    public function tableStringing(int $id_project): array
    {
        $project = $this->projectsRepositories->getProjectById($id_project);

        $raspres = $this->projectsRepositories->getRaspresByIdProject($id_project)->values();
        $zatpol  = $this->projectsRepositories->getZatpolByIdProject($id_project)->values();
        $gapres  = $this->projectsRepositories->getGapresByIdProject($id_project)->values();

        $trasa = $this->projectsRepositories->_getTrasaByIdProject($id_project)->values();

        // map na raspres po id_trasa
        $raspresMap = [];
        foreach ($raspres as $r) {
            $raspresMap[(int)($r->id_trasa ?? 0)] = $r;
        }

        // map na gapres po id_trasa
        $gapresMap = [];
        foreach ($gapres as $g) {
            $gapresMap[(int)($g->id_trasa ?? 0)] = $g;
        }

        // map na trasa po id_trasa
        $trasaMap = [];
        foreach ($trasa as $i => $t) {
            $trasaMap[(int)$t->id] = $i;
        }

        $temps = [-20, -10, 0, 10, 20, 30, 40, '-5+dt'];

        $data = [];

        foreach ($zatpol as $index => $z) {
            $idxPo = $trasaMap[(int)($z->id_trasa_po ?? 0)] ?? null;
            $idxKr = $trasaMap[(int)($z->id_trasa_kr ?? 0)] ?? null;

            // gi zema site raspres zapisi koi pripagjaat na zateznoto pole
            $fieldRaspres = collect();

            if ($idxPo !== null && $idxKr !== null) {
                for ($i = $idxPo; $i < $idxKr; $i++) {
                    $trasaId = (int)($trasa[$i]->id ?? 0);

                    if (isset($raspresMap[$trasaId])) {
                        $fieldRaspres->push($raspresMap[$trasaId]);
                    }
                }
            }

            $idRas = (float)($z->id_raspon ?? 0);

            // ============================================================
            // ПРОВОДНИК
            // ============================================================
            $tovp   = (float)($z->tovpro ?? 0);
            $tovp_1 = (float)($z->tovpro_1 ?? 0);

            $napregP = [
                (float)($z->napreg1_p ?? 0),
                (float)($z->napreg2_p ?? 0),
                (float)($z->napreg3_p ?? 0),
                (float)($z->napreg4_p ?? 0),
                (float)($z->napreg5_p ?? 0),
                (float)($z->napreg6_p ?? 0),
                (float)($z->napreg7_p ?? 0),
                (float)($z->napreg8_p ?? 0),
            ];

            $provesIdr = [];

            for ($k = 0; $k < 7; $k++) {
                $provesIdr[] = $this->calcIdealSagCm(
                    $napregP[$k],
                    $tovp,
                    $idRas
                );
            }

            $provesIdr[] = $this->calcIdealSagCm(
                $napregP[7],
                $tovp_1,
                $idRas
            );

            // spans za provodnik
            $spans = [];

            foreach ($fieldRaspres as $rIndex => $r) {
                $idTrasa = (int)($r->id_trasa ?? 0);
                $g = $gapresMap[$idTrasa] ?? null;

                $rasp = (float)($r->raspon ?? 0);
                $vr   = (float)($r->vr_pro ?? 0);

                $provesi = [];
                foreach ($provesIdr as $idealSagCm) {
                    $provesi[] = $this->calcRealSagCm($rasp, $vr, $idRas, $idealSagCm);
                }

                $spans[] = [
                    'raspon_br' => $r->raspon_br . '-' . ($r->raspon_br + 1),
                    'raspon'    => $rasp,
                    'vr'        => $vr,
                    'raspres'   => $r,
                    'gapres'    => $g,
                    'provesi'   => $provesi,
                ];
            }

            $crossSectionP = (float)(optional($project->conductors)->cross_section ?? 0);

            // ============================================================
            // ЗАШТИТНО ЈАЖЕ
            // ============================================================
            $tovz   = (float)($z->tovzaj ?? 0);
            $tovz_1 = (float)($z->tovzaj_1 ?? 0);

            $napregZ = [
                (float)($z->napreg1_z ?? 0),
                (float)($z->napreg2_z ?? 0),
                (float)($z->napreg3_z ?? 0),
                (float)($z->napreg4_z ?? 0),
                (float)($z->napreg5_z ?? 0),
                (float)($z->napreg6_z ?? 0),
                (float)($z->napreg7_z ?? 0),
                (float)($z->napreg8_z ?? 0),
            ];

            $provesIdrZ = [];

            for ($k = 0; $k < 7; $k++) {
                $provesIdrZ[] = $this->calcIdealSagCm(
                    $napregZ[$k],
                    $tovz,
                    $idRas
                );
            }

            $provesIdrZ[] = $this->calcIdealSagCm(
                $napregZ[7],
                $tovz_1,
                $idRas
            );

            // spans za zastitno jaze
            $spansZj = [];

            foreach ($fieldRaspres as $rIndex => $r) {
                $idTrasa = (int)($r->id_trasa ?? 0);
                $g = $gapresMap[$idTrasa] ?? null;

                $rasp = (float)($r->raspon ?? 0);
                $vrZ  = (float)($r->vr_zaj ?? 0);

                $provesiZ = [];
                foreach ($provesIdrZ as $idealSagCm) {
                    $provesiZ[] = $this->calcRealSagCm($rasp, $vrZ, $idRas, $idealSagCm);
                }

                $spansZj[] = [
                    'raspon_br' => $r->raspon_br . '-' . ($r->raspon_br + 1),
                    'raspon'    => $rasp,
                    'vr'        => $vrZ,
                    'raspres'   => $r,
                    'gapres'    => $g,
                    'provesi'   => $provesiZ,
                ];
            }

            $crossSectionZ = (float)(optional($project->groundWires)->cross_section ?? 0);

            // ============================================================
            // КРАЕН ЗАПИС
            // ============================================================
            $data[] = [
                'number' => $index + 1,

                'summary' => [
                    'conductor' => optional($project->conductors)->type,
                    'nap_pro'   => (float)($z->nap_pro ?? 0),
                    'kndt'      => (float)($z->kndt ?? 0),
                    'pole_dol'  => (float)($z->pole_dol ?? 0),
                    'id_raspon' => $idRas,
                    'nap_zaj'   => (float)($z->nap_zaj ?? 0),
                    'kidt'      => (float)($z->kidt ?? 0),
                    'priv'      => (float)($z->priv ?? 0),
                ],

                'matrix' => [
                    'temps' => $temps,
                    'napreg_p' => $napregP,
                    'sila_zateg' => [
                        (float)($z->napreg1_p ?? 0) * $crossSectionP,
                        (float)($z->napreg2_p ?? 0) * $crossSectionP,
                        (float)($z->napreg3_p ?? 0) * $crossSectionP,
                        (float)($z->napreg4_p ?? 0) * $crossSectionP,
                        (float)($z->napreg5_p ?? 0) * $crossSectionP,
                        (float)($z->napreg6_p ?? 0) * $crossSectionP,
                        (float)($z->napreg7_p ?? 0) * $crossSectionP,
                        (float)($z->napreg8_p ?? 0) * $crossSectionP,
                    ],
                    'proves_idr' => $provesIdr,
                ],

                'spans' => $spans,

                // ========================================================
                // ZJ podатоци za poseben loop vo Blade
                // ========================================================
                'summary_zj' => [
                    'conductor' => optional($project->groundWires)->type ?? 'ZJ',
                    'nap_zaj'   => (float)($z->nap_zaj ?? 0),
                    'kndt'      => (float)($z->kndt ?? 0),
                    'pole_dol'  => (float)($z->pole_dol ?? 0),
                    'id_raspon' => $idRas,
                    'priv'      => (float)($z->priv ?? 0),
                ],

                'matrix_zj' => [
                    'temps' => $temps,
                    'napreg_z' => $napregZ,
                    'sila_zateg' => [
                        (float)($z->napreg1_z ?? 0) * $crossSectionZ,
                        (float)($z->napreg2_z ?? 0) * $crossSectionZ,
                        (float)($z->napreg3_z ?? 0) * $crossSectionZ,
                        (float)($z->napreg4_z ?? 0) * $crossSectionZ,
                        (float)($z->napreg5_z ?? 0) * $crossSectionZ,
                        (float)($z->napreg6_z ?? 0) * $crossSectionZ,
                        (float)($z->napreg7_z ?? 0) * $crossSectionZ,
                        (float)($z->napreg8_z ?? 0) * $crossSectionZ,
                    ],
                    'proves_idr' => $provesIdrZ,
                ],

                'spans_zj' => $spansZj,
            ];
        }

        return ['data' => [
            'data'    => $data,
            'project' => $project,
        ]];
    }

    private function calcIdealSagCm(float $nap, float $tov, float $idRas): float
    {
        if ($nap <= 0.0 || $tov <= 0.0 || $idRas <= 0.0) {
            return 0.0;
        }

        $value = 100.0 * ($nap / $tov) * (cosh(($idRas * $tov) / (2.0 * $nap)) - 1.0);

        return round($value, 0);
    }

    private function calcRealSagCm(float $rasp, float $vr, float $idRas, float $idealSagCm): float
    {
        if ($rasp <= 0.0 || $idRas <= 0.0 || $idealSagCm <= 0.0) {
            return 0.0;
        }

        $value = sqrt(($rasp * $rasp) + ($vr * $vr)) * ($rasp / ($idRas * $idRas)) * $idealSagCm;

        return round($value, 0);
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

        $checkImportPoints = $this->projectsRepositories->checkImportPoints($projectId);

        //dd($checkImportPoints);
        if ($checkImportPoints) {
            return new ResponseError($methodName, $this->classPath, ['id_error'=>'6']);
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

        $this->projectsRepositories->setCalculation($projectId, 0);
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

        $checkImportSituation = $this->projectsRepositories->checkImportSituation($projectId);

        //dd($checkImportPoints);
        if ($checkImportSituation) {
            return new ResponseError($methodName, $this->classPath, ['id_error'=>'6']);
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

            // ако целиот ред е празен – прескокни
            if ($x === '' && $y === '') {
                continue;
            }
            // замени запирка со точка
            $x = str_replace(',', '.', $x);
            $y       = str_replace(',', '.', $y);


            $rowsToInsert[] = [
                'id_project' => $projectId,
                'x'     => is_numeric($x) ? (float) $x : null,
                'y'     => is_numeric($y)       ? (float) $y       : null,

                'imported'   => 1,
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

    public function importSituationP(int $projectId, Request $request): ResponseError|ResponseSuccess
    {

        $methodName = 'importSituationP(int $projectId, Request $request)';

        if (!$request->hasFile('parcels')) {
            dd($request);
            return new ResponseError($methodName, $this->classPath, ['id_error'=>'1']);
        }

        $file = $request->file('parcels');
        if (!$file->isValid()) {
            return new ResponseError($methodName, $this->classPath, ['id_error'=>'2']);
        }

        $checkImportSituationP = $this->projectsRepositories->checkImportSituationP($projectId);

        //dd($checkImportPoints);
        if ($checkImportSituationP) {
            return new ResponseError($methodName, $this->classPath, ['id_error'=>'6']);
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

            // ако целиот ред е празен – прескокни
            if ($x === '' && $y === '') {
                continue;
            }
            // замени запирка со точка
            $x = str_replace(',', '.', $x);
            $y       = str_replace(',', '.', $y);


            $rowsToInsert[] = [
                'id_project' => $projectId,
                'x'     => is_numeric($x) ? (float) $x : null,
                'y'     => is_numeric($y)       ? (float) $y       : null,

                'imported'   => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        if (empty($rowsToInsert)) {
            return new ResponseError($methodName, $this->classPath, ['id_error'=>'4']);
        }
        $importPoints = $this->projectsRepositories->importSituationsP($rowsToInsert);
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
        $this->projectsRepositories->setCalculation($id, 0);
        return new ResponseSuccess('','',[]);
    }

    public function deleteImportedSituation($id): ResponseSuccess|ResponseError
    {
        //dd($id);
        $return= $this->projectsRepositories->deleteImportedSituation($id);
        if (!$return) {
            return new ResponseError('method: deleteImportPoints($id)',  $this->classPath,[]);
        }
        $this->projectsRepositories->setCalculation($id, 0);
        return new ResponseSuccess('','',[]);
    }

    public function deleteImportedSituationP($id): ResponseSuccess|ResponseError
    {
        //dd($id);
        $return= $this->projectsRepositories->deleteImportedSituationP($id);
        if (!$return) {
            return new ResponseError('method: deleteImportedSituationP($id)',  $this->classPath,[]);
        }
        $this->projectsRepositories->setCalculation($id, 0);
        return new ResponseSuccess('','',[]);
    }

    public function towers($id, $params, $id_tower): array
    {

        $id_voltage = $this->projectsRepositories->getProjectById($id)->id_voltage;
        $voltage = $this->projectsRepositories->getVoltageById($id_voltage)->title;
        $towers = $this->projectsRepositories->getAllTowersVoltage($voltage,$params,$id_tower);
        $voltages = $this->projectsRepositories->getAllVoltagesByVoltage($voltage);
        $towersTypes= $this->projectsRepositories->getAllTowersTypes();
        $towerA = $this->projectsRepositories->getAllTowersA();

        //dd($params);
        return ['data' => [
            'towers' => $towers,
            'voltages' => $voltages,
            'towersTypes' => $towersTypes,
            'towerA' => $towerA,
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


    public function exportExcelTowers($id_project): \Illuminate\Support\Collection
    {
        //dd($id_project);
        $data = $this->tableTowers((int)$id_project);


        $rows = $data['data']['trasa'] ?? [];

        return collect($rows);
    }

    public function exportExcelStringing($id_project): array
    {
        $result = $this->tableStringing((int)$id_project);
        //dd($result);

        return [
            'project' => $result['data']['project'] ?? null,
            'data'    => $result['data']['data'] ?? [],
        ];
    }

}
