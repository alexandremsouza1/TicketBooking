<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CompanyService;
use App\Services\StationService;
use Exception;

class CompanyController extends Controller
{
    protected $companyService;
    protected $stationService;

    /**
     * CompanyController constructor.
     * @param CompanyService $companyService
     * @param RatingService $ratingService
     */
    public function __construct(
        CompanyService $companyService,
        StationService $stationService
    ) {
        $this->companyService = $companyService;
        $this->stationService = $stationService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $params = $request->only([
                'size',
                'sort_field',
                'sort_type',
                'keyword',
                'station_id',
            ]);

            $companies = $this->companyService->search($params);

            return view('admin.company.index', compact('companies'));
        } catch (Exception $e) {
            report($e);
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $company = $this->companyService->getCompany($id);
            $statuses = $this->companyService->getListStatuses();
            $stations = $this->stationService->getAll();

            return view('admin.company.show', compact('company',
                'statuses',
                'stations'
            ));
        } catch (Exception $e) {
            report($e);
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
