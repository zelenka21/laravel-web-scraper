<?php

namespace app\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJobRequest;
use App\Managers\ScrapeJobManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as HTTPResponse;

class JobController extends Controller
{
    /**
     * @param ScrapeJobManager $manager
     */
    public function __construct(private readonly ScrapeJobManager $manager)
    {
    }

    /**
     * @param StoreJobRequest $request
     * @return JsonResponse
     */
    public function store(StoreJobRequest $request): JsonResponse
    {
        return response()->json(['id' => $this->manager->createJob($request->toDTO())], HTTPResponse::HTTP_CREATED);
    }

    /**
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        return response()->json(['id' => $this->manager->get($id)]); //todo resource
    }

    /**
     * @param string $id
     * @return Response
     */
    public function destroy(string $id): Response
    {
        $this->manager->delete($id);
        return response(HTTPResponse::HTTP_NO_CONTENT);
    }
}
