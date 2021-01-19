<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePositionsAPIRequest;
use App\Http\Requests\API\UpdatePositionsAPIRequest;
use App\Models\Positions;
use App\Repositories\PositionsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\PositionsResource;
use Response;


/**
 * Class PositionsController
 * @package App\Http\Controllers\API
 */

class PositionsAPIController extends AppBaseController
{
    /** @var  PositionsRepository */
    private $positionsRepository;

    public function __construct(PositionsRepository $positionsRepo)
    {
        $this->positionsRepository = $positionsRepo;
    }

    /**
     * Display a listing of the Positions.
     * GET|HEAD /positions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        try{
            $order_by = $request->get('order_by', 'updated_at');
            $order_dir = $request->get('order_dir', 'desc');

            $itemsPosition = $this->positionsRepository->paginate(
                $request->except(['limit', 'page']),
                $request->get('limit'),
                null, [$order_by => $order_dir]
            );
            return $this->sendResponse($itemsPosition->toArray(), 'Positions retrieved successfully');
        }catch (\Exception $ex) {
            \Log::error($ex->getMessage() . $ex->getTraceAsString());
            return $this->sendError($ex->getMessage(), \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created Positions in storage.
     * POST /positions
     *
     * @param CreatePositionsAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePositionsAPIRequest $request)
    {
        try {
            $input = $request->all();
            $positions = $this->positionsRepository->create($input);
            return $this->sendResponse($positions->toArray(), 'create successfully');
        }catch (\Exception $ex) {
            return $this->sendError($ex->getMessage(), \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified Positions.
     * GET|HEAD /positions/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            /** @var Positions $positions */
            $positions = $this->positionsRepository->find($id);
            if (empty($positions)) {
                return $this->sendError( 'not Found', \Illuminate\Http\Response::HTTP_NO_CONTENT);
            }

            return $this->sendResponse($positions->toArray(), 'successfully');
            }catch (\Exception $ex){
                return $this->sendError($ex->getMessage(), \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

    /**
     * Update the specified Positions in storage.
     * PUT/PATCH /positions/{id}
     *
     * @param int $id
     * @param UpdatePositionsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePositionsAPIRequest $request)
    {
        try {
            $input = $request->all();

            /** @var Positions $positions */
            $positions = $this->positionsRepository->find($id);
            if (empty($positions)){
                return $this->sendError('not found', \Illuminate\Http\Response::HTTP_NO_CONTENT);
            }
            $positions = $this->positionsRepository->update($input, $id);

            return $this->sendResponse($positions->toArray(), 'update successfully');
        }catch (\Exception $ex) {
            return $this->sendError($ex->getMessage(), \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified Positions from storage.
     * DELETE /positions/{id}
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
            /** @var Positions $positions */
            $positions = $this->positionsRepository->find($id);
            if (empty($positions)) {
                return $this->sendError('not Found', \Illuminate\Http\Response::HTTP_NO_CONTENT);
            }
            $positions->delete();

            return $this->sendResponse($id, 'delete successfully');
        }catch (\Exception $ex) {
            return $this->sendError($ex->getMessage(), \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
