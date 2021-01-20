<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateJob_statusAPIRequest;
use App\Http\Requests\API\UpdateJob_statusAPIRequest;
use App\Models\Job_status;
use App\Repositories\Job_statusRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Job_statusResource;
use Response;

/**
 * Class Job_statusController
 * @package App\Http\Controllers\API
 */

class Job_statusAPIController extends AppBaseController
{
    /** @var  Job_statusRepository */
    private $jobStatusRepository;

    public function __construct(Job_statusRepository $jobStatusRepo)
    {
        $this->jobStatusRepository = $jobStatusRepo;
    }

    /**
     * Display a listing of the Job_status.
     * GET|HEAD /jobStatuses
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        try{
            $order_by = $request->get('order_by', 'updated_at');
            $order_dir = $request->get('order_dir', 'desc');

            $itemJob_status = $this->jobStatusRepository->paginate(
                $request->except(['limit', 'page']),
                $request->get('limit'),
                null, [$order_by => $order_dir]
            );
            return $this->sendResponse($itemJob_status->toArray(), 'itemJob_status retrieved successfully');
        }catch (\Exception $ex) {
            \Log::error($ex->getMessage() . $ex->getTraceAsString());
            return $this->sendError($ex->getMessage(), \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created Job_status in storage.
     * POST /jobStatuses
     *
     * @param CreateJob_statusAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateJob_statusAPIRequest $request)
    {
        try {
            $input = $request->all();
            $itemJob_status = $this->jobStatusRepository->create($input);
            return $this->sendResponse($itemJob_status->toArray(), 'create successfully');
        } catch (\Exception $ex) {
            return $this->sendError($ex->getMessage(), \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified Job_status.
     * GET|HEAD /jobStatuses/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            /** @var Job_status $itemJob_status */
            $itemJob_status = $this->jobStatusRepository->find($id);
            if (empty($itemJob_status)) {
                return $this->sendError('not Found', \Illuminate\Http\Response::HTTP_NO_CONTENT);
            }

            return $this->sendResponse($itemJob_status->toArray(), 'successfully');
        } catch (\Exception $ex) {
            return $this->sendError($ex->getMessage(), \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    /**
     * Update the specified Job_status in storage.
     * PUT/PATCH /jobStatuses/{id}
     *
     * @param int $id
     * @param UpdateJob_statusAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateJob_statusAPIRequest $request)
    {
        try {
            $input = $request->all();

            /** @var Job_status $itemJob_status */
            $itemJob_status = $this->jobStatusRepository->find($id);
            if (empty($itemJob_status)) {
                return $this->sendError('not found', \Illuminate\Http\Response::HTTP_NO_CONTENT);
            }
            $positions = $this->jobStatusRepository->update($input, $id);

            return $this->sendResponse($itemJob_status->toArray(), 'update successfully');
        } catch (\Exception $ex) {
            return $this->sendError($ex->getMessage(), \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified Job_status from storage.
     * DELETE /jobStatuses/{id}
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
            /** @var Job_status $itemJob_status */
            $itemJob_status = $this->jobStatusRepository->find($id);
            if (empty($itemJob_status)) {
                return $this->sendError('not Found', \Illuminate\Http\Response::HTTP_NO_CONTENT);
            }
            $itemJob_status->delete();

            return $this->sendResponse($id, 'delete successfully');
        }catch (\Exception $ex) {
            return $this->sendError($ex->getMessage(), \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
