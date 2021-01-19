<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDepartmentsAPIRequest;
use App\Http\Requests\API\UpdateDepartmentsAPIRequest;
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
        $departments = $this->departmentsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(DepartmentsResource::collection($departments), 'Departments retrieved successfully');
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
        $input = $request->all();

        $departments = $this->departmentsRepository->create($input);

        return $this->sendResponse(new DepartmentsResource($departments), 'Departments saved successfully');
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
        $input = $request->all();

        /** @var Departments $departments */
        $departments = $this->departmentsRepository->find($id);

        if (empty($departments)) {
            return $this->sendError('Departments not found');
        }

        $departments = $this->departmentsRepository->update($input, $id);

        return $this->sendResponse(new DepartmentsResource($departments), 'Departments updated successfully');
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
        /** @var Departments $departments */
        $departments = $this->departmentsRepository->find($id);

        if (empty($departments)) {
            return $this->sendError('Departments not found');
        }

        $departments->delete();

        return $this->sendSuccess('Departments deleted successfully');
    }
}
