<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createcourses_score_excel_filesAPIRequest;
use App\Http\Requests\API\Updatecourses_score_excel_filesAPIRequest;
use App\Models\courses_score_excel_files;
use App\Repositories\courses_score_excel_filesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\courses_score_excel_filesResource;
use Response;

/**
 * Class courses_score_excel_filesController
 * @package App\Http\Controllers\API
 */

class courses_score_excel_filesAPIController extends AppBaseController
{
    /** @var  courses_score_excel_filesRepository */
    private $coursesScoreExcelFilesRepository;

    public function __construct(courses_score_excel_filesRepository $coursesScoreExcelFilesRepo)
    {
        $this->coursesScoreExcelFilesRepository = $coursesScoreExcelFilesRepo;
    }

    /**
     * Display a listing of the courses_score_excel_files.
     * GET|HEAD /coursesScoreExcelFiles
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $coursesScoreExcelFiles = $this->coursesScoreExcelFilesRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(courses_score_excel_filesResource::collection($coursesScoreExcelFiles), 'Courses Score Excel Files retrieved successfully');
    }

    /**
     * Store a newly created courses_score_excel_files in storage.
     * POST /coursesScoreExcelFiles
     *
     * @param Createcourses_score_excel_filesAPIRequest $request
     *
     * @return Response
     */
    public function store(Createcourses_score_excel_filesAPIRequest $request)
    {
        $input = $request->all();

        $coursesScoreExcelFiles = $this->coursesScoreExcelFilesRepository->create($input);

        return $this->sendResponse(new courses_score_excel_filesResource($coursesScoreExcelFiles), 'Courses Score Excel Files saved successfully');
    }

    /**
     * Display the specified courses_score_excel_files.
     * GET|HEAD /coursesScoreExcelFiles/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var courses_score_excel_files $coursesScoreExcelFiles */
        $coursesScoreExcelFiles = $this->coursesScoreExcelFilesRepository->find($id);

        if (empty($coursesScoreExcelFiles)) {
            return $this->sendError('Courses Score Excel Files not found');
        }

        return $this->sendResponse(new courses_score_excel_filesResource($coursesScoreExcelFiles), 'Courses Score Excel Files retrieved successfully');
    }

    /**
     * Update the specified courses_score_excel_files in storage.
     * PUT/PATCH /coursesScoreExcelFiles/{id}
     *
     * @param int $id
     * @param Updatecourses_score_excel_filesAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatecourses_score_excel_filesAPIRequest $request)
    {
        $input = $request->all();

        /** @var courses_score_excel_files $coursesScoreExcelFiles */
        $coursesScoreExcelFiles = $this->coursesScoreExcelFilesRepository->find($id);

        if (empty($coursesScoreExcelFiles)) {
            return $this->sendError('Courses Score Excel Files not found');
        }

        $coursesScoreExcelFiles = $this->coursesScoreExcelFilesRepository->update($input, $id);

        return $this->sendResponse(new courses_score_excel_filesResource($coursesScoreExcelFiles), 'courses_score_excel_files updated successfully');
    }

    /**
     * Remove the specified courses_score_excel_files from storage.
     * DELETE /coursesScoreExcelFiles/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var courses_score_excel_files $coursesScoreExcelFiles */
        $coursesScoreExcelFiles = $this->coursesScoreExcelFilesRepository->find($id);

        if (empty($coursesScoreExcelFiles)) {
            return $this->sendError('Courses Score Excel Files not found');
        }

        $coursesScoreExcelFiles->delete();

        return $this->sendSuccess('Courses Score Excel Files deleted successfully');
    }
}
