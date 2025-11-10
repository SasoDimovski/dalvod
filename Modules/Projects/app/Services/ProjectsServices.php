<?php

namespace Modules\Projects\Services;

use App\Services\Responses\ResponseError;
use App\Services\Responses\ResponseSuccess;
use Modules\Projects\Dto\ProjectsDto;
use Modules\Projects\Repositories\ProjectsRepositories;


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
//dd($voltages);
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
        $insulatorChain= $this->projectsRepositories->getAllInsulatorChain();


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
        $startingPoint = $this->projectsRepositories->createEndpoints($project->id,$project->id_starting_point,$id_trafo1);
        // CREATE ENDPOINT
        $endingPoint = $this->projectsRepositories->createEndpoints($project->id,$project->id_ending_point,$id_trafo2);

        if (!$project) {
            return new ResponseError('method: storeProject($projectsDto)',  $this->classPath,[]);
        }


        return new ResponseSuccess('','',['id'=>$project->id]);
    }
//    public function storePoint($request): array:
//    {
//        // STORE POINT
//        $point = $this->projectsRepositories->storePoint($request);
//
//
//        return ['data' => [
//
//
//        ]];
//    }
    public function storePoint($request): array
    {
        $point = $this->projectsRepositories->storePoint($request);
        $project = $this->projectsRepositories->getProjectById($request->id);
        $trasa = $this->projectsRepositories->getTrasaByIdProject($request->id);
        $firstTwoIds =$this->projectsRepositories->firstTwoIds($request->id);
        //dd($trasa);
        $voltages = $this->projectsRepositories->getAllVoltages();
        $conductors = $this->projectsRepositories->getAllConductors();
        $groundWires= $this->projectsRepositories->getAllGroundWires();

        $endpoints = $this->projectsRepositories->getAllEndpoints();
        $windPressure= $this->projectsRepositories->getAllWindPressure();
        $insulatorChain= $this->projectsRepositories->getAllInsulatorChain();
        $izolam= $this->projectsRepositories->getAllIzolam();
        $stolb= $this->projectsRepositories->getAllStolb($request->id);



        return ['data' => [
            'project' => $project,
            'firstTwoIds' => $firstTwoIds,
            'trasa' => $trasa,
            'voltages' => $voltages,
            'conductors' => $conductors,
            'groundWires' => $groundWires,
            'endpoints' => $endpoints,
            'windPressure' => $windPressure,
            'insulatorChain' => $insulatorChain,
            'izolam' => $izolam,
            'stolb' => $stolb,

        ]];
    }
    public function show($id): array
    {
        $project = $this->projectsRepositories->getProjectById($id);
        $activitiesAss = $this->projectsRepositories->getActivitiesAssignment($id);
        $assignments = $this->projectsRepositories->getAssignmentByIdProject($id);

        $insertedby = $project->insertedby ;
        $updatedby = $project->updatedby;

        $updatedby = $this->projectsRepositories->getUserById($updatedby);
        $insertedby = $this->projectsRepositories->getUserById($insertedby);

        $insertedby = $insertedby->username ?? __('projects.ProjectServices.no_existing_user');
        $updatedby = $updatedby->username  ?? __('projects.ProjectServices.no_existing_user');

        return ['data' => [
            'project' => $project,
            'activitiesAss' => $activitiesAss,
            'updatedby_' => $updatedby,
            'insertedby_' => $insertedby,
            'assignments' => $assignments,
        ]];

    }

    public function edit( int $id): array
    {
        $project = $this->projectsRepositories->getProjectById($id);
        $trasa = $this->projectsRepositories->getTrasaByIdProject($id);
        $trafo = $this->projectsRepositories->getTrafoByIdProject($id);

        $voltages = $this->projectsRepositories->getAllVoltages();
        $conductors = $this->projectsRepositories->getAllConductors();
        $groundWires= $this->projectsRepositories->getAllGroundWires();

        $endpoints = $this->projectsRepositories->getAllEndpoints();
        $windPressure= $this->projectsRepositories->getAllWindPressure();
        $insulatorChain= $this->projectsRepositories->getAllInsulatorChain();



        return ['data' => [
            'project' => $project,
            'trasa' => $trasa,
            'trafo' => $trafo,
            'voltages' => $voltages,
            'conductors' => $conductors,
            'groundWires' => $groundWires,
            'endpoints' => $endpoints,
            'windPressure' => $windPressure,
            'insulatorChain' => $insulatorChain,

            ]];
    }


    public function editEndPoints( int $id_project): array
    {

        $project = $this->projectsRepositories->getProjectById($id_project);
        $trasa = $this->projectsRepositories->getTrasaByIdProjectTopTwo($id_project);
        //dd($trasa);
        $voltages = $this->projectsRepositories->getAllVoltages();
        $conductors = $this->projectsRepositories->getAllConductors();
        $groundWires= $this->projectsRepositories->getAllGroundWires();

        $endpoints = $this->projectsRepositories->getAllEndpoints();
        $windPressure= $this->projectsRepositories->getAllWindPressure();
        $insulatorChain= $this->projectsRepositories->getAllInsulatorChain();
        $izolam= $this->projectsRepositories->getAllIzolam();
        $stolb= $this->projectsRepositories->getAllStolb($id_project);



        return ['data' => [
            'project' => $project,
            'trasa' => $trasa,
            'voltages' => $voltages,
            'conductors' => $conductors,
            'groundWires' => $groundWires,
            'endpoints' => $endpoints,
            'windPressure' => $windPressure,
            'insulatorChain' => $insulatorChain,
            'izolam' => $izolam,
            'stolb' => $stolb,

        ]];
    }
    public function editPoints( int $id_project): array
    {

        $project = $this->projectsRepositories->getProjectById($id_project);
        $trasa = $this->projectsRepositories->getTrasaByIdProject($id_project);
        $firstTwoIds =$this->projectsRepositories->firstTwoIds($id_project);


        //dd($trasa);
        $voltages = $this->projectsRepositories->getAllVoltages();
        $conductors = $this->projectsRepositories->getAllConductors();
        $groundWires= $this->projectsRepositories->getAllGroundWires();

        $endpoints = $this->projectsRepositories->getAllEndpoints();
        $windPressure= $this->projectsRepositories->getAllWindPressure();
        $insulatorChain= $this->projectsRepositories->getAllInsulatorChain();
        $izolam= $this->projectsRepositories->getAllIzolam();
        $stolb= $this->projectsRepositories->getAllStolb($id_project);





        return ['data' => [
            'firstTwoIds' => $firstTwoIds,
            'project' => $project,
            'trasa' => $trasa,
            'voltages' => $voltages,
            'conductors' => $conductors,
            'groundWires' => $groundWires,
            'endpoints' => $endpoints,
            'windPressure' => $windPressure,
            'insulatorChain' => $insulatorChain,
            'izolam' => $izolam,
            'stolb' => $stolb,

        ]];
    }

    public function editRaspres( int $id_project): array
    {
        $this->projectsRepositories->raspres($id_project);
        $project = $this->projectsRepositories->getProjectById($id_project);
        $trasa = $this->projectsRepositories->getTrasaByIdProject($id_project);
        $raspres = $this->projectsRepositories->getRaspresByIdProject($id_project);
        $firstTwoIds =$this->projectsRepositories->firstTwoIds($id_project);


        //dd($trasa);
        $voltages = $this->projectsRepositories->getAllVoltages();
        $conductors = $this->projectsRepositories->getAllConductors();
        $groundWires= $this->projectsRepositories->getAllGroundWires();

        $endpoints = $this->projectsRepositories->getAllEndpoints();
        $windPressure= $this->projectsRepositories->getAllWindPressure();
        $insulatorChain= $this->projectsRepositories->getAllInsulatorChain();
        $izolam= $this->projectsRepositories->getAllIzolam();
        $stolb= $this->projectsRepositories->getAllStolb($id_project);





        return ['data' => [
            'firstTwoIds' => $firstTwoIds,
            'project' => $project,
            'trasa' => $trasa,
            'raspres' => $raspres,
            'voltages' => $voltages,
            'conductors' => $conductors,
            'groundWires' => $groundWires,
            'endpoints' => $endpoints,
            'windPressure' => $windPressure,
            'insulatorChain' => $insulatorChain,
            'izolam' => $izolam,
            'stolb' => $stolb,

        ]];
    }

    public function editZatpol( int $id_project): array
    {
        $this->projectsRepositories->raspres($id_project);
        $this->projectsRepositories->zatpol($id_project);
        $project = $this->projectsRepositories->getProjectById($id_project);
        $trasa = $this->projectsRepositories->getTrasaByIdProject($id_project);
        $zatpol = $this->projectsRepositories->getZatpolByIdProject($id_project);
        $firstTwoIds =$this->projectsRepositories->firstTwoIds($id_project);


        //dd($trasa);
        $voltages = $this->projectsRepositories->getAllVoltages();
        $conductors = $this->projectsRepositories->getAllConductors();
        $groundWires= $this->projectsRepositories->getAllGroundWires();

        $endpoints = $this->projectsRepositories->getAllEndpoints();
        $windPressure= $this->projectsRepositories->getAllWindPressure();
        $insulatorChain= $this->projectsRepositories->getAllInsulatorChain();
        $izolam= $this->projectsRepositories->getAllIzolam();
        $stolb= $this->projectsRepositories->getAllStolb($id_project);





        return ['data' => [
            'firstTwoIds' => $firstTwoIds,
            'project' => $project,
            'trasa' => $trasa,
            'zatpol' => $zatpol,
            'voltages' => $voltages,
            'conductors' => $conductors,
            'groundWires' => $groundWires,
            'endpoints' => $endpoints,
            'windPressure' => $windPressure,
            'insulatorChain' => $insulatorChain,
            'izolam' => $izolam,
            'stolb' => $stolb,

        ]];
    }
    public function updateEndPoints(int $projectId, array $request): ResponseSuccess|ResponseError
    {


        // UPDATE PROJECT
        $project = $this->projectsRepositories->updateEndPoints($projectId, $request);
        if (!$project) {
            return new ResponseError('$id, $projectsDto',  $this->classPath,['message_error'=>__('error_update_project')]);
        }

        return new ResponseSuccess('update($activities, ProjectsDto $projectsDto)',$this->classPath,[]);
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


    public function deletePoint($id): ResponseSuccess|ResponseError
    {
        $return= $this->projectsRepositories->deletePoint($id);
        if (!$return) {
            return new ResponseError('method: deletePoint($id)',  $this->classPath,[]);
        }
        return new ResponseSuccess('','',[]);
    }

    public function deleteProject($id): ResponseSuccess|ResponseError
    {
        $return= $this->projectsRepositories->deleteProject($id);
        if (!$return) {
            return new ResponseError('method: deleteProject($id)',  $this->classPath,[]);
        }
        return new ResponseSuccess('','',[]);
    }

    public function showAssignment($id): array
    {

        $assignments= $this->projectsRepositories->getAssignmentById($id);

        $insertedby = $assignments->insertedby ;
        $updatedby = $assignments->updatedby;

        $updatedby = $this->projectsRepositories->getUserById($updatedby);
        $insertedby = $this->projectsRepositories->getUserById($insertedby);

        $insertedby = $insertedby->username ?? __('projects.ProjectServices.no_existing_user');
        $updatedby = $updatedby->username  ?? __('projects.ProjectServices.no_existing_user');

        $assignment = $this->projectsRepositories->getAssignmentById($id);
        return ['data' => [
            'assignment' => $assignment,
            'updatedby_' => $updatedby,
            'insertedby_' => $insertedby,
        ]];

    }
    public function editAssignment( int $id): array
{
    $assignments= $this->projectsRepositories->getAssignmentById($id);

    $insertedby = $assignments->insertedby ;
    $updatedby = $assignments->updatedby;

    $updatedby = $this->projectsRepositories->getUserById($updatedby);
    $insertedby = $this->projectsRepositories->getUserById($insertedby);

    $insertedby = $insertedby->username ?? __('projects.ProjectServices.no_existing_user');
    $updatedby = $updatedby->username  ?? __('projects.ProjectServices.no_existing_user');

    $assignment = $this->projectsRepositories->getAssignmentById($id);
    return ['data' => [
        'assignment' => $assignment,
        'updatedby_' => $updatedby,
        'insertedby_' => $insertedby,
    ]];
}
public function updateAssignment(ProjectAssignmentsDto $assignmentsDto): ResponseSuccess|ResponseError
{
    $id = $assignmentsDto->id;

    // CHECK IF ASSIGNMENTS EXIST ///////////////////////////////////////////////
    $assignment = $this->projectsRepositories->getAssignmentById($id);

    if (!$assignment) {
        return new ResponseError('method: getAssignmentById($id)',  $this->classPath,[]);
    }

    // UPDATE ASSIGNMENTS
    $assignment = $this->projectsRepositories->updateAssignment($id, $assignmentsDto);
    if (!$assignment) {
        return new ResponseError('method: updateAssignment($id, $assignmentsDto)',  $this->classPath,[]);
    }
    return new ResponseSuccess('','',[]);
}
public function storeAssignment(ProjectAssignmentsDto $assignmentsDto,$id): ResponseError|ResponseSuccess
{
    // STORE ASSIGNMENT
    $assignment = $this->projectsRepositories->storeAssignment($assignmentsDto,$id);

    if (!$assignment) {
        return new ResponseError('method: storeProject($assignmentsDto)',  $this->classPath,[]);
    }
    return new ResponseSuccess('','',['id'=>$assignment->id]);
}
    public function deleteAssignment($id): ResponseSuccess|ResponseError

    {
        $return= $this->projectsRepositories->checkIfAssignmentExistInRecords($id);
        //dd($return);
        if ($return) {
            return new ResponseError('checkIfAssignmentExistInRecords($id)', $this->classPath, ['error_message' => __('projects.ProjectServices.error_delete_assignments')]);
        }

        $return= $this->projectsRepositories->deleteAssignment($id);
        if (!$return) {
            return new ResponseError('method: deleteAssignment($id)',  $this->classPath,[]);
        }
        return new ResponseSuccess('','',[]);
    }
}
