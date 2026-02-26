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

        return ['data' => [
            'raspres' => $raspres,
            'zatpol' => $zatpol,
            'gapres' => $gapres,


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
            $x      = trim((string) ($row['C'] ?? ''));
            $agol      = trim((string) ($row['D'] ?? ''));

            // ако целиот ред е празен – прескокни
            if ($stacionaza === '' && $kota === ''&& $x === ''&& $agol === '') {
                continue;
            }

            // замени запирка со точка
            $stacionaza = str_replace(',', '.', $stacionaza);
            $kota       = str_replace(',', '.', $kota);
            $x       = str_replace(',', '.', $x);
            $agol       = str_replace(',', '.', $agol);

            $rowsToInsert[] = [
                'id_project' => $projectId,
                'stac_t'     => is_numeric($stacionaza) ? (float) $stacionaza : null,
                'kota_t'     => is_numeric($kota)       ? (float) $kota       : null,
                'x_t'     => is_numeric($x)       ? (float) $x       : null,
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
