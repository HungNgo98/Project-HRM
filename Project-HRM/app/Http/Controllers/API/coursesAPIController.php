<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatecoursesAPIRequest;
use App\Http\Requests\API\UpdatecoursesAPIRequest;
use App\Http\Utils\AppUtils;
use App\Http\Utils\CommonUtils;
use App\Http\Utils\UsersUtils;
use App\Models\courses;
use App\Repositories\coursesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\coursesResource;
use Illuminate\Http\Response;

/**
 * Class coursesController
 * @package App\Http\Controllers\API
 */

class coursesAPIController extends AppBaseController
{
    /** @var  coursesRepository */
    private $coursesRepository;

    public function __construct(coursesRepository $coursesRepo)
    {
        $this->coursesRepository = $coursesRepo;
    }

    /**
     * Display a listing of the courses.
     * GET|HEAD /courses
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $order_by = $request->get('order_by','updated_at');
        $order_dir = $request->get('order_dir','desc');

        $courses = $this->coursesRepository->paginate(
            $request->except(['skip', 'limit']),
            $request->get('limit'),
            null,[$order_by => $order_dir]
        );

        return $this->sendResponse($courses->toArray(), 'Courses retrieved successfully');
    }

    /**
     * Store a newly created courses in storage.
     * POST /courses
     *
     * @param CreatecoursesAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatecoursesAPIRequest $request)
    {
//        $request->user()->authorizeRoles([UsersUtils::ROLE_ADMIN]);
        try {
            $input = $request->all();
            $courses = $this->coursesRepository->create($input);
            return $this->sendResponse($courses->toArray(), 'Courses saved successfully');
        }
        catch (\Exception $ex)
        {
            return $this->sendError($ex->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

//        if(isset($courses['description']))
//            unset($courses['description']);


    }

    /**
     * Display the specified courses.
     * GET|HEAD /courses/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var courses $courses */
        $courses = $this->coursesRepository->find($id);

        if (empty($courses)) {
            return $this->sendError('Courses not found');
        }

        return $this->sendResponse($courses->toArray(), 'Courses retrieved successfully');
    }

    /**
     * Update the specified courses in storage.
     * PUT/PATCH /courses/{id}
     *
     * @param int $id
     * @param UpdatecoursesAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecoursesAPIRequest $request)
    {
        $input = $request->all();

        /** @var courses $courses */
        $courses = $this->coursesRepository->find($id);

        if (empty($courses)) {
            return $this->sendError('Courses not found');
        }

        $courses = $this->coursesRepository->update($input, $id);
        if(isset($courses['html_content']))
            unset($courses['html_content']);
        return $this->sendResponse($courses->toArray(), 'courses updated successfully');
    }

    /**
     * Remove the specified courses from storage.
     * DELETE /courses/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var courses $courses */
        $courses = $this->coursesRepository->find($id);

        if (empty($courses)) {
            return $this->sendError('Courses not found');
        }

        $courses->delete();

        return $this->sendSuccess($id,'Courses deleted successfully');
    }
    public function getSelectList(Request $request){
        $scope = $request->get('scope',AppUtils::DEFAULT_SCOPE);
        $limit = $request->get('limit', AppUtils::DEFAULT_LIMIT);
        $start = $request->get('start',0);
        $items = $this->coursesRepository->all(['scope'=> $scope],$start,null,['id as value','course_category_id','description as text','current_order as text'],['ordering'=>'asc']);

        $items_tree = CommonUtils::arrToTree($items->keyBy('value'),'value');
        $items_tree = CommonUtils::treeToArr($items_tree);

        return $this->sendResponse($items_tree,'Courses select list');
    }
}
