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

        if (!$project) {
            return new ResponseError('method: storeProject($projectsDto)',  $this->classPath,[]);
        }


        return new ResponseSuccess('','',['id'=>$project->id]);
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

        $voltages = $this->projectsRepositories->getAllVoltages();
        $conductors = $this->projectsRepositories->getAllConductors();
        $groundWires= $this->projectsRepositories->getAllGroundWires();

        $endpoints = $this->projectsRepositories->getAllEndpoints();
        $windPressure= $this->projectsRepositories->getAllWindPressure();
        $insulatorChain= $this->projectsRepositories->getAllInsulatorChain();



        return ['data' => [
            'project' => $project,
            'voltages' => $voltages,
            'conductors' => $conductors,
            'groundWires' => $groundWires,
            'endpoints' => $endpoints,
            'windPressure' => $windPressure,
            'insulatorChain' => $insulatorChain,

            ]];
    }

    public function update(ProjectsDto $projectsDto): ResponseSuccess|ResponseError
    {
        $id = $projectsDto->id;

        // CHECK IF PROJECT EXIST ///////////////////////////////////////////////
        $project = $this->projectsRepositories->getProjectById($id);
        if (!$project) {
            return new ResponseError('method: getProjectById($id)',  $this->classPath, ['message_error'=>__('projects.ProjectServices.error_no_existing_projects')]);
        }

        // UPDATE PROJECT
        $project = $this->projectsRepositories->updateProject($id, $projectsDto);
        if (!$project) {
            return new ResponseError('$id, $projectsDto',  $this->classPath,['message_error'=>__('error_update_project')]);
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
