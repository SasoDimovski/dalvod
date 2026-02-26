<?php

namespace Modules\Projects\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\Projects\Dto\ProjectsDto;
use Modules\Projects\Http\Requests\ProjectsStorePointsRequest;
use Modules\Projects\Http\Requests\ProjectsStoreRequest;
use Modules\Projects\Http\Requests\ProjectsUpdateRequest;
use Modules\Projects\Services\ProjectsServices;

class ProjectsController extends Controller
{
    public function __construct(public ProjectsServices $projectsServices, private readonly ProjectsDto $projectsDto)
    {
    }

    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $return = $this->projectsServices->index($request->all());
        return view('Projects::projects/index', $return['data']);
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $return = $this->projectsServices->create();
        return view('Projects::projects/edit', $return['data']);
    }

    public function store(ProjectsStoreRequest $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $url_return= $request->get('url_return') ;
        $query= $request->get('query') ;


        $projectsDto = $this->projectsDto->fromRequest($request);
        $return = $this->projectsServices->store($projectsDto);

        $message_error= $return->data['message_error'] ?? $request->get('message_error') ;
        $message_success=$return->data['message_success'] ?? $request->get('message_success') ;

        if($return->status=='error'){
            return redirect(url($url_return).'?'.$query)->with('error', [$message_error, $return->method, $return->class]);
        }
        return redirect(url($url_return.'/'.$return->data['id']).'?'.$query)->with('success', $message_success);
    }

    public function edit($lang, $id_module, $id): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $return = $this->projectsServices->edit($id);
        return view('Projects::projects/edit', $return['data']);
    }

    public function update($lang, $id_module, $id, ProjectsUpdateRequest $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $url_return= $request->get('url_return') ;
        $query= $request->get('query') ;


        $projectsDto = $this->projectsDto->fromRequest($request);
        $return = $this->projectsServices->update($projectsDto);

        $message_error= $return->data['message_error'] ?? $request->get('message_error') ;
        $message_success=$return->data['message_success'] ?? $request->get('message_success') ;

        if($return->status=='error'){
            return redirect(url($url_return).'?'.$query)->with('error', [$message_error, $return->method, $return->class]);
        }
        return redirect(url($url_return.'/'.$id).'?'.$query)->with('success', $message_success);
    }

    public function destroy($lang, $id_module, $id, Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        //dd($id);
        $url_return= $request->get('url_return_war') ;
        $query= $request->get('query_war') ;
        $message_error= $request->get('error_war') ;
        $message_success= $request->get('success_war') ;

        $return = $this->projectsServices->deleteProject($id);

        if($return->status=='error'){
            return redirect(url($url_return).'?'.$query)->with('error', [$message_error, $return->method, $return->class]);
        }
        return redirect(url($url_return).'?'.$query)->with('success', $message_success);
    }


    public function editEndPoints($lang, $id_module, $id_project): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $return = $this->projectsServices->editEndPoints($id_project);
        return view('Projects::projects/edit-endpoints', $return['data']);
    }

    public function updateEndPoints($lang, $id_module, $id, Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {

        $url_return= $request->get('url_return') ;
        $query= $request->get('query') ;


        $return = $this->projectsServices->updateEndPoints($id, $request->all());

        $message_error= $return->data['message_error'] ?? $request->get('message_error') ;
        $message_success=$return->data['message_success'] ?? $request->get('message_success') ;

        if($return->status=='error'){
            return redirect(url($url_return).'?'.$query)->with('error', [$message_error, $return->method, $return->class]);
        }
        return redirect(url($url_return).'?'.$query)->with('success', $message_success);
    }

    public function editPoints($lang, $id_module, $id_project, Request $request): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $return = $this->projectsServices->editPoints($id_project, $request->all());
        return view('Projects::projects/edit-points', $return['data']);
    }


    public function editPoint($lang, $id_module, $id_project,$id_point, Request $request): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $return = $this->projectsServices->editPoint($id_project, $request->all(),$id_point);
        return view('Projects::projects/edit-points', $return['data']);
    }
    public function storePoint($lang, $id_module, $id, ProjectsStorePointsRequest $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $url_return= $request->get('url_return') ;
        $query= $request->get('query') ;

        $return = $this->projectsServices->storePoint($request);

        $message_error= $return->data['message_error'] ?? $request->get('message_error') ;
        $message_success=$return->data['message_success'] ?? $request->get('message_success') ;

        if($return->status=='error'){
            return redirect(url($url_return).'?'.$query)->with('error', [$message_error, $return->method, $return->class]);
        }
        return redirect(url($url_return).'?'.$query)->with('success', $message_success);
    }
    public function updatePoint($lang, $id_module, $id, $id_point, Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {

        $url_return= $request->get('url_return') ;
        $query= $request->get('query') ;

        $return = $this->projectsServices->updatePoint($id, $id_point,$request->all());

        $message_error= $return->data['message_error'] ?? $request->get('message_error') ;
        $message_success=$return->data['message_success'] ?? $request->get('message_success') ;

        if($return->status=='error'){
            return redirect(url($url_return).'?'.$query)->with('error', [$message_error, $return->method, $return->class]);
        }
        return redirect(url($url_return).'?'.$query)->with('success', $message_success);
    }
    public function destroyPoint($lang, $id_module, $id, Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        //dd($id);
        $url_return= $request->get('url_return_war') ;
        $query= $request->get('query_war') ;
        $message_error= $request->get('error_war') ;
        $message_success= $request->get('success_war') ;

        $return = $this->projectsServices->deletePoint($id);

        if($return->status=='error'){
            return redirect(url($url_return).'?'.$query)->with('error', [$message_error, $return->method, $return->class]);
        }
        return redirect(url($url_return).'?'.$query)->with('success', $message_success);
    }


    public function importPoints($lang, $id_module, $id, Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        //dd($id);
        $url_return = $request->get('url_return');
        $query      = $request->get('query');

        $return = $this->projectsServices->importPoints($id, $request);

        $message_error   = $return->data['message_error']   ?? $request->get('message_error');
        $message_success = $return->data['message_success'] ?? $request->get('message_success');

        if ($return->status == 'error') {
            $errors = [
                "1" => __('projects.ProjectController.no_exel'),
                "2" => __('projects.ProjectController.no_valid_exel'),
                "3" => __('projects.ProjectController.error_on_delete'),
                "4" => __('projects.ProjectController.error_on_transform_excel'),
                "5" => __('projects.ProjectController.error_on_insert_in_db'),
                "6" => __('users.UsersController.error_update_paas_in_users'),
            ];
            $errorMessage = $errors[$return->data['id_error']] ?? $message_error;
            return redirect(url($url_return).'?'.$query)
                ->with('error', [$errorMessage, $return->method, $return->class]);
        }

        return redirect(url($url_return).'?'.$query)
            ->with('success', $message_success);
    }
    public function deleteImportedPoints($lang, $id_module, $id, Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        //dd($id);
        $url_return= $request->get('url_return_war') ;
        $query= $request->get('query_war') ;
        $message_error= $request->get('error_war') ;
        $message_success= $request->get('success_war') ;

        $return = $this->projectsServices->deleteImportedPoints($id);

        if($return->status=='error'){
            return redirect(url($url_return).'?'.$query)->with('error', [$message_error, $return->method, $return->class]);
        }
        return redirect(url($url_return).'?'.$query)->with('success', $message_success);
    }



    public function towers($lang, $id_module, $id, Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $id_tower   = $request->query('id_tower');
        $return = $this->projectsServices->towers($id, $request->all(),$id_tower);
        return view('Projects::projects/edit-towers', $return['data']);

    }

    public function showTower($lang, $id_module, $id): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $return = $this->projectsServices->showTower( $id);
        return view('Projects::projects/show-tower', $return['data']);
    }

    public function insulators($lang, $id_module, $id, Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $idInsulators   = $request->query('id_insulators');
        $return = $this->projectsServices->insulators($id, $request->all(),$idInsulators);
        return view('Projects::projects/edit-insulators', $return['data']);

    }




    public function showRaspres($lang, $id_module, $id_project): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $return = $this->projectsServices->showRaspres($id_project);
        return view('Projects::projects/show-raspres', $return['data']);
    }

    public function showZatpol($lang, $id_module, $id_project): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $return = $this->projectsServices->showZatpol($id_project);
        return view('Projects::projects/show-zatpol', $return['data']);
    }
    public function showGapres($lang, $id_module, $id_project): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $return = $this->projectsServices->showGapres($id_project);
        return view('Projects::projects/show-gapres', $return['data']);
    }

    public function calculations($lang, $id_module, $id_project): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $return = $this->projectsServices->calculations($id_project);
        return view('Projects::projects/show-all-tables', $return['data']);
    }
}
