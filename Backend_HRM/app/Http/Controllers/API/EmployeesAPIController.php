<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEmployeesAPIRequest;
use App\Http\Requests\API\UpdateEmployeesAPIRequest;
use App\Http\Utils\AppUtils;
use App\Models\Employees;
use App\Repositories\EmployeesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\EmployeesResource;
use Response;

/**
 * Class EmployeesController
 * @package App\Http\Controllers\API
 */

class EmployeesAPIController extends AppBaseController
{
    /** @var  EmployeesRepository */
    private $employeesRepository;

    public function __construct(EmployeesRepository $employeesRepo)
    {
        $this->employeesRepository = $employeesRepo;
    }

    /**
     * Display a listing of the Employees.
     * GET|HEAD /employees
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

            $itemsEmployees = $this->employeesRepository->paginate(
                ['filter'=>$request->input('name')],
                $limit,
                null,
                [$order_by => $order_dir]
            );

            return $this->sendResponse($itemsEmployees, 'Employees retrieved successfully');
        } catch (\Exception $ex) {
            \Log::error($ex->getMessage() . $ex->getTraceAsString());
            return $this->sendError($ex->getMessage(), \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created Employees in storage.
     * POST /employees
     *
     * @param CreateEmployeesAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateEmployeesAPIRequest $request)
    {
        try {
            $input = $request->all();
            $employees = $this->employeesRepository->create($input);
            return $this->sendResponse($employees->toArray(), 'Employees saved successfully');
        } catch (\Exception $ex) {
            return $this->sendError($ex->getMessage(), \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified Employees.
     * GET|HEAD /employees/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Employees $employees */
        $employees = $this->employeesRepository->find($id);

        if (empty($employees)) {
            return $this->sendError('Employees not found');
        }

        return $this->sendResponse(new EmployeesResource($employees), 'Employees retrieved successfully');
    }

    /**
     * Update the specified Employees in storage.
     * PUT/PATCH /employees/{id}
     *
     * @param int $id
     * @param UpdateEmployeesAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmployeesAPIRequest $request)
    {
        try {
            $input = $request->all();

            /** @var Employees $employees */
            $employees = $this->employeesRepository->find($id);

            if (empty($employees)) {
                return $this->sendError('Employees not found', \Illuminate\Http\Response::HTTP_NO_CONTENT);
            }

            $employees = $this->employeesRepository->update($input, $id);

            return $this->sendResponse($employees->toArray(), 'Departments updated successfully');
        } catch (\Exception $ex) {
            return $this->sendError($ex->getMessage(), \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified Employees from storage.
     * DELETE /employees/{id}
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
            /** @var Employees $employees */
            $employees = $this->employeesRepository->find($id);

            if (empty($employees)) {
                return $this->sendError('Employees not found', \Illuminate\Http\Response::HTTP_NO_CONTENT);
            }

            $employees->delete();

            return $this->sendResponse($id, 'Employees deleted successfully');
        } catch (\Exception $ex) {
            return $this->sendError($ex->getMessage(), \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
