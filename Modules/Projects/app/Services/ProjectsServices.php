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
        $profileLines = $this->profileData($id_project);
        return ['data' => [
            'firstTwoIds' => $firstTwoIds,
            'project' => $project,
            'trasa' => $trasa,
            'pointsGR' => $pointsGR,
            'checkImportPoints' => $checkImportPoints,
            'profileLines' => $profileLines,

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

    public function tableForces(int $id_project): array
    {
        $project = $this->projectsRepositories->getProjectById($id_project);

        $gapres = $this->projectsRepositories
            ->getGapresByIdProject($id_project)
            ->values();

        $zatpol = $this->projectsRepositories
            ->getZatpolByIdProject($id_project)
            ->values();

        $data = [];

        foreach ($gapres as $index => $g) {

            $trasa = $g->trasa;
            if (!$trasa) {
                continue;
            }

            $tower = optional($trasa)->tower;
            $trafo = optional($trasa)->trafo;

            $stolbId = $trasa->id_tower ?: $trasa->id_trafo;

            if (!$stolbId) {
                continue;
            }

            $stBr = (int)$g->br_stolb - 1;


            $idTrasa = (int)$g->id_trasa;
            $zA = $zatpol->first(function ($item) use ($idTrasa) {

                return
                    (int)$item->id_trasa_po <= $idTrasa
                    &&
                    (int)$item->id_trasa_kr >= $idTrasa;
            });

            if (!$zA) {
                continue;
            }

            $zB = $zatpol->first(function ($item) use ($idTrasa) {

                return (int)$item->id_trasa_po === $idTrasa;
            });

            $grrVpro = (($g->grr_lpro ?? 0) + ($g->grr_dpro ?? 0));

            $grrVzaj = (($g->grr_lzaj ?? 0) + ($g->grr_dzaj ?? 0));

            $data[] = [
                'number' => $index + 1,
                'summary' => [
                    'br_stolb' => $stBr,
                    'stac_t'   => (float)($g->stac_t ?? 0),
                    'id_trasa' => (int)($g->id_trasa ?? 0),
                    'tower_type' => $tower->type
                        ?? $tower->tip
                            ?? $tower->name
                            ?? $trafo->ime
                            ?? '',
                    'insulator' => trim(
                        (optional($trasa->insulator1)->type ?? '') .
                        (optional($trasa->insulator2)->type ? '/' . optional($trasa->insulator2)->type : '')
                    ),
                    'agol_t'   => (float)($trasa->agol_tr ?? $g->agol_t ?? 0),
                    'sre_ras'  => (float)($g->sre_ras ?? 0),
                    'grr_vpro' => (float)$grrVpro,
                    'grr_vzaj' => (float)$grrVzaj,
                ],

                'forces' => $this->calculateForcesForTower(
                    $g,
                    $zA,
                    $zB,
                    $project,
                    $trasa,
                    $tower,
                    $trafo,
                    $stBr,
                    $gapres
                ),
            ];
        }

        return [
            'data' => [
                'data'    => $data,
                'project' => $project,
            ],
        ];
    }

    private function calculateForcesForTower($g, $zA, $zB, $project, $trasa, $tower, $trafo, int $stBr, $gapres): array
    {
        $preseP = (float)(optional($project->conductors)->cross_section ?? 0);
        $preseZ = (float)(optional($project->groundWires)->cross_section ?? 0);

        $dijamP = (float)(optional($project->conductors)->diameter ?? 0);
        $dijamZ = (float)(optional($project->groundWires)->diameter ?? 0);

        $nomNap = $this->getNominalVoltageFromProject($project);
        $brojPs = (float)($project->num_cond_systems ?? 1);

        $agoTra = (float)($trasa->agol_tr ?? $g->agol_t ?? 0);

        $stoAg = (float)($tower->angle ?? $tower->ag ?? 0);
        $stoNap = $tower ? (float)($tower->voltage ?? $tower->nap ?? 0) : 0;
        $stoMa = (float)($tower->mass ?? $tower->masa ?? 0);

        $grLp = (float)($g->grr_lpro ?? 0);
        $grDp = (float)($g->grr_dpro ?? 0);
        $grVp = (float)($g->grr_vpro ?? 0);

        $grLz = (float)($g->grr_lzaj ?? 0);
        $grDz = (float)($g->grr_dzaj ?? 0);
        $grVz = (float)($g->grr_vzaj ?? 0);

        $sreR = (float)($g->sre_ras ?? 0);

        $knDta = (float)($zA->kndt ?? 0);
        $kiDta = (float)($zA->kidt ?? 0);
        $pritVe = (float)($zA->priv ?? 0);

        $tovp = (float)($zA->tovpro ?? 0);
        $tovp1 = (float)($zA->tovpro_1 ?? 0);
        $tovz = (float)($zA->tovzaj ?? 0);
        $tovz1 = (float)($zA->tovzaj_1 ?? 0);

        $naprmPa = max((float)($zA->napreg1_p ?? 0), (float)($zA->napreg8_p ?? 0));
        $naprmZa = max((float)($zA->napreg1_z ?? 0), (float)($zA->napreg8_z ?? 0));

        if ($zB) {
            $tovp1b = (float)($zB->tovpro_1 ?? 0);
            $tovz1b = (float)($zB->tovzaj_1 ?? 0);
            $knDtb = (float)($zB->kndt ?? 0);
            $kiDtb = (float)($zB->kidt ?? 0);

            $naprmPb = max((float)($zB->napreg1_p ?? 0), (float)($zB->napreg8_p ?? 0));
            $naprmZb = max((float)($zB->napreg1_z ?? 0), (float)($zB->napreg8_z ?? 0));
        } else {
            $tovp1b = 0;
            $tovz1b = 0;
            $knDtb = 0;
            $kiDtb = 0;
            $naprmPb = 0;
            $naprmZb = 0;
        }

        $knDtm = max($knDta, $knDtb);
        $kiDtm = max($kiDta, $kiDtb);

        $naprmP = max($naprmPa, $naprmPb) * $knDtm;
        $naprmZ = max($naprmZa, $naprmZb) * $kiDtm;

        $izoM1 = (float)(optional($trasa->insulator1)->mass ?? 0);
        $izoMd1 = (float)(optional($trasa->insulator1)->masad ?? $izoM1);

        $izoM2 = (float)(optional($trasa->insulator2)->mass ?? 0);
        $izoMd2 = (float)(optional($trasa->insulator2)->masad ?? $izoM2);

        $izoMd1 = $izoM1 + $knDtm * ($izoMd1 - $izoM1);
        $izoMd2 = $izoM2 + $knDtm * ($izoMd2 - $izoM2);

        $sinHalf = $this->sinDeg($agoTra / 2);
        $cosHalf = $this->cosDeg($agoTra / 2);

        $firstBr = (int)$gapres->first()->br_stolb - 1;
        $lastBr = (int)$gapres->last()->br_stolb - 1;
        $isFirstOrLast = ($stBr === $firstBr || $stBr === $lastBr);

        if ($stoAg == 0 && $stoNap > 0) {

            $vzA = $brojPs * $preseP * $tovp1 * $grVp + $izoMd1;
            $zzA = $preseZ * $tovz1 * $grVz;

            $vxB = $brojPs * 0.001 * $dijamP * $pritVe * $sreR;
            $vzB = $brojPs * $preseP * $tovp * $grVp + $izoM1;
            $zxB = 0.001 * $dijamZ * $pritVe * $sreR;
            $zzB = $preseZ * $tovz * $grVz;
            $sxB = 2.6 * $pritVe;

            $vyC = $brojPs * 0.25 * 0.001 * $dijamP * $pritVe * $sreR;
            $vzC = $vzB;
            $zyC = 0.25 * 0.001 * $dijamZ * $pritVe * $sreR;
            $zzC = $zzB;
            $syC = 2.6 * $pritVe;

            if ($nomNap > 20) {
                $vyE = ($brojPs == 1)
                    ? $brojPs * 0.5 * $naprmP * $preseP
                    : $brojPs * 0.25 * $naprmP * $preseP;

                $vzE = $brojPs * $preseP * $tovp1 * $grVp + $izoMd1;
                $zzE = $preseZ * $tovz1 * $grVz;
                $zyE = 0.5 * $naprmZ * $preseZ;
            } else {
                $vyE = 0;
                $vzE = 0;
                $zzE = 0;
                $zyE = 0;
            }

            return [
                ['group' => 'Член 69', 'code' => 'A', 'data' => $this->forceRow(0, null, $vzA, 0, null, $zzA)],
                ['group' => 'Член 69', 'code' => 'B', 'data' => $this->forceRow($vxB, null, $vzB, $zxB, null, $zzB, $sxB)],
                ['group' => 'Член 69', 'code' => 'C', 'data' => $this->forceRow(0, $vyC, $vzC, 0, $zyC, $zzC, null, $syC)],
                ['group' => 'Чл.69 т.2', 'code' => 'D', 'data' => $this->forceRow()],
                ['group' => 'Член 70 т. 2b', 'code' => 'PP', 'data' => $this->forceRow(0, $vyE, $vzE)],
                ['group' => 'Член 70 т. 2b', 'code' => 'NP', 'data' => $this->forceRow(0, null, $vzE, 0, null, $zzE)],
                ['group' => 'Член 70 т. 2b', 'code' => 'PZ', 'data' => $this->forceRow(null, null, null, 0, $zyE, $zzE)],
                ['group' => 'Член 70 т. 2b', 'code' => 'NZ', 'data' => $this->forceRow(0, null, $vzE, 0, null, $zzE)],
            ];
        }

        $vxA = $brojPs * 2 * $preseP * $naprmP * $sinHalf;
        $vzA = ($brojPs * $preseP * $tovp1 * $grLp)
            + ($brojPs * $preseP * $tovp1b * $grDp)
            + $izoMd1 + $izoMd2;

        $zxA = 2 * $preseZ * $naprmZ * $sinHalf;
        $zzA = ($preseZ * $tovz1 * $grLz)
            + ($preseZ * $tovz1b * $grDz);

        $vxB = $brojPs * 0.001 * $dijamP * $pritVe * $sreR
            + 4 * ($brojPs * $preseP * $naprmP * $sinHalf) / 3;

        if ($stoMa == 0) {
            $vxB = $brojPs * 0.001 * $dijamP * $pritVe * $sreR;
        }

        $vzB = $brojPs * $preseP * $tovp * $grVp + $izoM1 + $izoM2;

        $zxB = 0.001 * $dijamZ * $pritVe * $sreR
            + 4 * ($preseZ * $naprmZ * $sinHalf) / 3;

        if ($stoMa == 0) {
            $zxB = 0.001 * $dijamZ * $pritVe * $sreR;
        }

        $zzB = $preseZ * $tovz * $grVz;
        $sxB = 2.6 * $pritVe;

        $vxC = $brojPs * 4 * ($preseP * $naprmP * $sinHalf) / 3;

        $vyC = $brojPs * 0.001 * $dijamP * $pritVe * $sreR * $sinHalf;
        if ($agoTra < 28.955) {
            $vyC = $brojPs * 0.001 * $dijamP * $pritVe * $sreR * 0.25;
        }

        $vzC = $brojPs * $preseP * $tovp * $grVp + $izoM1 + $izoM2;

        $zxC = 4 * ($preseZ * $naprmZ * $sinHalf) / 3;

        $zyC = 0.001 * $dijamZ * $pritVe * $sreR * $sinHalf;
        if ($agoTra < 28.955) {
            $zyC = 0.001 * $dijamZ * $pritVe * $sreR * 0.25;
        }

        $zzC = $preseZ * $tovz * $grVz;
        $syC = 2.6 * $pritVe;

        $vxD = 2 * ($brojPs * $preseP * $naprmP * $sinHalf) / 3;
        $vzD = $brojPs * $preseP * $tovp * $grVp + $izoM1 + $izoM2;
        $zxD = 2 * ($preseZ * $naprmZ * $sinHalf) / 3;
        $zzD = $preseZ * $tovz * $grVz;

        if ($agoTra == 0 && $izoM2 == 0) {
            $vyD = $brojPs * $naprmP * $preseP;
            $zyD = $naprmZ * $preseZ;
        } else {
            $vyD = 2 * ($brojPs * $preseP * $naprmP * $cosHalf) / 3;
            $zyD = 2 * ($preseZ * $naprmZ * $cosHalf) / 3;
        }

        if ($nomNap > 20) {

            if ($isFirstOrLast) {
                $vxPP = $brojPs * $naprmP * $preseP * $this->sinDeg($agoTra);
                $vyPP = $brojPs * $naprmP * $preseP * $this->cosDeg($agoTra);
            } else {
                $vxPP = $brojPs * $preseP * $naprmP * $sinHalf;
                $vyPP = $brojPs * $preseP * $naprmP * $cosHalf;
            }

            $vzPP = ($brojPs * $preseP * $tovp1 * $grLp)
                + ($brojPs * $preseP * $tovp1b * $grDp)
                + $izoMd1 + $izoMd2;

            $vxNP = $brojPs * 2 * $preseP * $naprmP * $sinHalf;
            $vzNP = $vzPP;

            $zxNP = 2 * $preseZ * $naprmZ * $sinHalf;
            $zzNP = ($preseZ * $tovz1 * $grLz)
                + ($preseZ * $tovz1b * $grDz);

            if ($isFirstOrLast) {
                $zxPZ = $preseZ * $naprmZ * $this->sinDeg($agoTra);
                $zyPZ = $preseZ * $naprmZ * $this->cosDeg($agoTra);
            } else {
                $zxPZ = $preseZ * $naprmZ * $sinHalf;
                $zyPZ = $preseZ * $naprmZ * $cosHalf;
            }

            $zzPZ = ($preseZ * $tovz1 * $grLz)
                + ($preseZ * $tovz1b * $grDz);

            $vxNZ = $brojPs * 2 * $preseP * $naprmP * $sinHalf;
            $vzNZ = $vzPP;
            $zxNZ = $zxA;
            $zzNZ = $zzA;

        } else {
            $vxPP = $vyPP = $vzPP = 0;
            $vxNP = $vzNP = $zxNP = $zzNP = 0;
            $zxPZ = $zyPZ = $zzPZ = 0;
            $vxNZ = $vzNZ = $zxNZ = $zzNZ = 0;
        }

        return [
            ['group' => 'Член 69', 'code' => 'A', 'data' => $this->forceRow($vxA, null, $vzA, $zxA, null, $zzA)],
            ['group' => 'Член 69', 'code' => 'B', 'data' => $this->forceRow($vxB, null, $vzB, $zxB, null, $zzB, $sxB)],
            ['group' => 'Член 69', 'code' => 'C', 'data' => $this->forceRow($vxC, $vyC, $vzC, $zxC, $zyC, $zzC, null, $syC)],
            ['group' => 'Чл.69 т.2', 'code' => 'D', 'data' => $this->forceRow($vxD, $vyD, $vzD, $zxD, $zyD, $zzD)],
            ['group' => 'Член 70 т. 2b', 'code' => 'PP', 'data' => $this->forceRow($vxPP, $vyPP, $vzPP)],
            ['group' => 'Член 70 т. 2b', 'code' => 'NP', 'data' => $this->forceRow($vxNP, null, $vzNP, $zxNP, null, $zzNP)],
            ['group' => 'Член 70 т. 2b', 'code' => 'PZ', 'data' => $this->forceRow(null, null, null, $zxPZ, $zyPZ, $zzPZ)],
            ['group' => 'Член 70 т. 2b', 'code' => 'NZ', 'data' => $this->forceRow($vxNZ, null, $vzNZ, $zxNZ, null, $zzNZ)],
        ];
    }

    private function forceRow(
        $vx = null,
        $vy = null,
        $vz = null,
        $zx = null,
        $zy = null,
        $zz = null,
        $sx = null,
        $sy = null
    ): array {
        return compact('vx', 'vy', 'vz', 'zx', 'zy', 'zz', 'sx', 'sy');
    }

    private function sinDeg(float $deg): float
    {
        return sin(deg2rad($deg));
    }

    private function cosDeg(float $deg): float
    {
        return cos(deg2rad($deg));
    }

    private function getNominalVoltageFromProject($project): float
    {
        $value =
            optional($project->voltages)->voltage
            ?? optional($project->voltage)->voltage
            ?? optional($project->voltages)->name
            ?? optional($project->voltage)->name
            ?? $project->voltage
            ?? 0;

        if (is_numeric($value)) {
            return (float)$value;
        }

        if (preg_match('/\d+(\.\d+)?/', (string)$value, $matches)) {
            return (float)$matches[0];
        }

        return 0.0;
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


    //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    public function profileData(int $id_project): array
    {
        $raspres = $this->projectsRepositories
            ->getRaspresByIdProject($id_project)
            ->sortBy('stac_t')
            ->values();

        $trasa = $this->projectsRepositories
            ->_getTrasaByIdProject($id_project)
            ->sortBy('stac_t')
            ->values();

        $zatpol = $this->projectsRepositories
            ->getZatpolByIdProject($id_project)
            ->values();

        $trasaById = [];
        foreach ($trasa as $t) {
            $trasaById[(int)$t->id] = $t;
        }

        $data = [];

        foreach ($raspres as $r) {

            $startPoint = $trasaById[(int)($r->id_trasa ?? 0)] ?? null;

            if (!$startPoint) {
                continue;
            }

            $startIndex = $trasa->search(function ($item) use ($startPoint) {
                return (int)$item->id === (int)$startPoint->id;
            });

            $endPoint = $trasa[$startIndex + 1] ?? null;

            if (!$endPoint) {
                continue;
            }

            $stac1 = (float)$startPoint->stac_t;
            $stac2 = (float)$endPoint->stac_t;
            $rasp  = $stac2 - $stac1;

            if ($rasp <= 0) {
                continue;
            }

            $kotaOp1 = $this->profileConductorPointHeight($startPoint);
            $kotaOp2 = $this->profileConductorPointHeight($endPoint);

            $kotaOz1 = $this->profileGroundWirePointHeight($startPoint);
            $kotaOz2 = $this->profileGroundWirePointHeight($endPoint);

            $virp = $kotaOp2 - $kotaOp1;
            $virz = $kotaOz2 - $kotaOz1;

            $idTrasa = (int)$r->id_trasa;

            $z = $zatpol->first(function ($item) use ($idTrasa) {
                return (int)$item->id_trasa_po <= $idTrasa
                    && (int)$item->id_trasa_kr >= $idTrasa;
            });

            if (!$z) {
                continue;
            }

            $tovp = (float)($z->tovpro ?? 0);
            $napP = (float)($z->napreg7_p ?? 0);

            $tovz = (float)($z->tovzaj ?? 0);
            $napZ = (float)($z->napreg1_z ?? 0);

            for ($stac = $stac1; $stac <= $stac2; $stac += 2) {

                $conductor = null;
                $groundwire = null;

                if ($tovp > 0 && $napP > 0) {
                    $conductor = $this->profileCableHeight(
                        $kotaOp1,
                        $kotaOp2,
                        $stac1,
                        $stac2,
                        $stac,
                        $rasp,
                        $virp,
                        $tovp,
                        $napP
                    );
                }

                if ($kotaOz1 > 0 && $kotaOz2 > 0 && $tovz > 0 && $napZ > 0) {
                    $groundwire = $this->profileCableHeight(
                        $kotaOz1,
                        $kotaOz2,
                        $stac1,
                        $stac2,
                        $stac,
                        $rasp,
                        $virz,
                        $tovz,
                        $napZ
                    );
                }

                $data[] = [
                    'x' => round($stac, 2),
                    'conductor' => $conductor !== null ? round($conductor, 2) : null,
                    'groundwire' => $groundwire !== null ? round($groundwire, 2) : null,
                ];
            }

            if (round($stac2, 2) !== round($stac - 2, 2)) {

                $conductor = null;
                $groundwire = null;

                if ($tovp > 0 && $napP > 0) {
                    $conductor = $this->profileCableHeight(
                        $kotaOp1,
                        $kotaOp2,
                        $stac1,
                        $stac2,
                        $stac2,
                        $rasp,
                        $virp,
                        $tovp,
                        $napP
                    );
                }

                if ($kotaOz1 > 0 && $kotaOz2 > 0 && $tovz > 0 && $napZ > 0) {
                    $groundwire = $this->profileCableHeight(
                        $kotaOz1,
                        $kotaOz2,
                        $stac1,
                        $stac2,
                        $stac2,
                        $rasp,
                        $virz,
                        $tovz,
                        $napZ
                    );
                }

                $data[] = [
                    'x' => round($stac2, 2),
                    'conductor' => $conductor !== null ? round($conductor, 2) : null,
                    'groundwire' => $groundwire !== null ? round($groundwire, 2) : null,
                ];
            }
        }

        return $data;
    }

    private function profileConductorPointHeight($point): float
    {
        if (!empty($point->id_trafo)) {
            return (float)$point->kota_t + (float)(optional($point->trafo)->visina_p ?? 0);
        }

        return (float)$point->kota_t + (float)(optional($point->tower)->vis ?? 0);
    }

    private function profileGroundWirePointHeight($point): float
    {
        if (!empty($point->id_trafo)) {
            return (float)$point->kota_t
                + (float)(optional($point->trafo)->visina_zj ?? 0);
        }

        return (float)$point->kota_t
            + (float)(optional($point->tower)->vis ?? 0)
            + (float)(optional($point->tower)->vig ?? 0);
    }
    private function profileCableHeight(
        float $kota1,
        float $kota2,
        float $stac1,
        float $stac2,
        float $stac,
        float $rasp,
        float $vir,
        float $tov,
        float $napreg
    ): float {
        if ($rasp == 0 || $napreg == 0 || $stac2 == $stac1) {
            return $kota1;
        }

        $dx = $stac - $stac1;

        return $kota1
            + (($kota2 - $kota1) * $dx / ($stac2 - $stac1))
            - (
                ($dx * ($rasp - $dx) * $tov)
                /
                (2 * $napreg * ($rasp / sqrt(($rasp ** 2) + ($vir ** 2))))
            );
    }



    //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


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

    public function exportExcelForces($id_project): array
    {
        $result = $this->tableForces((int)$id_project);
        //dd($result);

        return [
            'project' => $result['data']['project'] ?? null,
            'data'    => $result['data']['data'] ?? [],
        ];
    }}
