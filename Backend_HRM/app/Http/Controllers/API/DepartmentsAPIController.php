<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDepartmentsAPIRequest;
use App\Http\Requests\API\UpdateDepartmentsAPIRequest;
use App\Http\Utils\AppUtils;
use App\Models\Departments;
use App\Repositories\DepartmentsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\DepartmentsResource;
use Response;

/**
 * Class DepartmentsController
 * @package App\Http\Controllers\API
 */

class DepartmentsAPIController extends AppBaseController
{
    /** @var  DepartmentsRepository */
    private $departmentsRepository;

    public function __construct(DepartmentsRepository $departmentsRepo)
    {
        $this->departmentsRepository = $departmentsRepo;
    }

    /**
     * Display a listing of the Departments.
     * GET|HEAD /departments
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $limit = $request->get('limit', AppUtils::DEFAULT_LIMIT);
        try {
            $order_by = $request->get('order_by', 'updated_at');
            $order_dir = $request->get('order_dir', 'desc');

            $itemsDepartment = $this->departmentsRepository->paginate(
                ['filter'=>$request->input('name')],
                $limit,
                null,
                [$order_by => $order_dir]
            );

            return $this->sendResponse($itemsDepartment, 'Department retrieved successfully');
        } catch (\Exception $ex) {
            \Log::error($ex->getMessage() . $ex->getTraceAsString());
            return $this->sendError($ex->getMessage(), \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created Departments in storage.
     * POST /departments
     *
     * @param CreateDepartmentsAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDepartmentsAPIRequest $request)
    {
        try {
            $input = $request->all();
            $departments = $this->departmentsRepository->create($input);
            return $this->sendResponse($departments->toArray(), 'Departments saved successfully');
        } catch (\Exception $ex) {
            return $this->sendError($ex->getMessage(), \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified Departments.
     * GET|HEAD /departments/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Departments $departments */
        $departments = $this->departmentsRepository->find($id);

        if (empty($departments)) {
            return $this->sendError('Departments not found');
        }

        return $this->sendResponse(new DepartmentsResource($departments), 'Departments retrieved successfully');
    }

    /**
     * Update the specified Departments in storage.
     * PUT/PATCH /departments/{id}
     *
     * @param int $id
     * @param UpdateDepartmentsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDepartmentsAPIRequest $request)
    {
        try {
            $input = $request->all();

            /** @var Department $departments */
            $departments = $this->departmentsRepository->find($id);

            if (empty($departments)) {
                return $this->sendError('Departments not found', \Illuminate\Http\Response::HTTP_NO_CONTENT);
            }

            $departments = $this->departmentsRepository->update($input, $id);

            return $this->sendResponse($departments->toArray(), 'Departments updated successfully');
        } catch (\Exception $ex) {
            return $this->sendError($ex->getMessage(), \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified Departments from storage.
     * DELETE /departments/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        try {
            /** @var Departments $departments */
            $departments = $this->departmentsRepository->find($id);

            if (empty($departments)) {
                return $this->sendError('Department not found', \Illuminate\Http\Response::HTTP_NO_CONTENT);
            }

            $departments->delete();

            return $this->sendResponse($id, 'Department deleted successfully');
        } catch (\Exception $ex) {
            return $this->sendError($ex->getMessage(), \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
