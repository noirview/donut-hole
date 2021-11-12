<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use Illuminate\Http\Response;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return DepartmentResource::collection(
            Department::select(['id', 'name'])
                ->withCount('employees')
                ->withMax('employees', 'salary')
                ->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse|Response|object
     */
    public function store(StoreDepartmentRequest $request)
    {
        $department = new Department($request->validated());
        $department->save();

        return (new DepartmentResource($department))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Department $department
     * @return DepartmentResource
     */
    public function show(Department $department)
    {
        return new DepartmentResource($department);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Department $department
     * @return \Illuminate\Http\JsonResponse|Response|object
     */
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $department->update($request->validated());

        return (new DepartmentResource($department))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Department $department
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Department $department)
    {
        if ($department->employees()->count() != 0) {
            return response()->json(['message' => 'Can\'t deleted. Department has employees'], Response::HTTP_CONFLICT);
        }

        $department->delete();
        return response()->json(['message' => 'Department deleted'], Response::HTTP_ACCEPTED);
    }
}
