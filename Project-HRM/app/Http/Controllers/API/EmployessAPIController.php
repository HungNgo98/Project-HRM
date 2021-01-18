<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEmployessAPIRequest;
use App\Http\Requests\API\UpdateEmployessAPIRequest;
use App\Models\Employess;
use App\Repositories\EmployessRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\EmployessResource;
use Response;

/**
 * Class EmployessController
 * @package App\Http\Controllers\API
 */

class EmployessAPIController extends AppBaseController
{
    /** @var  EmployessRepository */
    private $employessRepository;

    public function __construct(EmployessRepository $employessRepo)
    {
        $this->employessRepository = $employessRepo;
    }

    /**
     * Display a listing of the Employess.
     * GET|HEAD /employesses
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $employesses = $this->employessRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(EmployessResource::collection($employesses), 'Employesses retrieved successfully');
    }

    /**
     * Store a newly created Employess in storage.
     * POST /employesses
     *
     * @param CreateEmployessAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateEmployessAPIRequest $request)
    {
        $input = $request->all();

        $employess = $this->employessRepository->create($input);

        return $this->sendResponse(new EmployessResource($employess), 'Employess saved successfully');
    }

    /**
     * Display the specified Employess.
     * GET|HEAD /employesses/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Employess $employess */
        $employess = $this->employessRepository->find($id);

        if (empty($employess)) {
            return $this->sendError('Employess not found');
        }

        return $this->sendResponse(new EmployessResource($employess), 'Employess retrieved successfully');
    }

    /**
     * Update the specified Employess in storage.
     * PUT/PATCH /employesses/{id}
     *
     * @param int $id
     * @param UpdateEmployessAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmployessAPIRequest $request)
    {
        $input = $request->all();

        /** @var Employess $employess */
        $employess = $this->employessRepository->find($id);

        if (empty($employess)) {
            return $this->sendError('Employess not found');
        }

        $employess = $this->employessRepository->update($input, $id);

        return $this->sendResponse(new EmployessResource($employess), 'Employess updated successfully');
    }

    /**
     * Remove the specified Employess from storage.
     * DELETE /employesses/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Employess $employess */
        $employess = $this->employessRepository->find($id);

        if (empty($employess)) {
            return $this->sendError('Employess not found');
        }

        $employess->delete();

        return $this->sendSuccess('Employess deleted successfully');
    }
}
