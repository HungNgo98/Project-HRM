<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatecoursesAPIRequest;
use App\Http\Requests\API\UpdatecoursesAPIRequest;
use App\Models\courses;
use App\Repositories\coursesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\coursesResource;
use Response;

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
        $courses = $this->coursesRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(coursesResource::collection($courses), 'Courses retrieved successfully');
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
        $input = $request->all();

        $courses = $this->coursesRepository->create($input);

        return $this->sendResponse(new coursesResource($courses), 'Courses saved successfully');
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

        return $this->sendResponse(new coursesResource($courses), 'Courses retrieved successfully');
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

        return $this->sendResponse(new coursesResource($courses), 'courses updated successfully');
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

        return $this->sendSuccess('Courses deleted successfully');
    }
}
