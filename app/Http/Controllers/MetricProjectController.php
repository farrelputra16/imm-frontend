<?php

namespace App\Http\Controllers;

use App\Models\Metric;
use App\Models\Project;
use App\Models\MatrixReport;
use Illuminate\Http\Request;
use App\Models\MetricProject;
use App\Charts\MonthlyReportChart;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;


class MetricProjectController extends Controller
{
    public function selectProject()
    {
        $projects = Project::all();
        return view('metric_projects.select_project', compact('projects'));
    }

    public function index($id)
    {
        $project = Project::findOrFail($id);

        // Fetch initial metrics (where report_month and report_year are null)
        $initialMetricProjects = $project->metricProjects()->whereNull('report_month')->whereNull('report_year')->get();

        $IndicatorProjects = $project->indicatorProjects()->get();
        $ProjectSdg = $project->projectSdg()->get();
        $Survey = $project->survey()->get();
        $ProjectDokumen = $project->projectDokumen()->get();

        // Fetch report metrics (where report_month and report_year are not null)
        $reportMetricProjects = $project->metricProjects()->whereNotNull('report_month')->whereNotNull('report_year')->get();

        // Fetch monthly report data
        $monthlyReports = MetricProject::selectRaw('report_month, report_year, SUM(value) as total_value')
            ->where('project_id', $id)
            ->whereNotNull('report_month')
            ->whereNotNull('report_year')
            ->groupBy('report_year', 'report_month')
            ->orderBy('report_year')
            ->orderBy('report_month')
            ->get();

        // Transform the data for the chart
        $labels = $monthlyReports->map(function ($report) {
            $months = [
                1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
                5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
                9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
            ];
            $monthName = $months[$report->report_month];
            return $monthName . '/' . $report->report_year;
        });

        $values = $monthlyReports->pluck('total_value');

        // Create chart
        $chart = new MonthlyReportChart;
        $chart->labels($labels);
        $chart->dataset('Total Values', 'line', $values)
            ->color('rgba(75, 192, 192, 1)')
            ->backgroundcolor('rgba(75, 192, 192, 0.2)');

        return view('myproject.detail', compact('project', 'initialMetricProjects', 'reportMetricProjects', 'chart', 'IndicatorProjects', 'ProjectSdg', 'Survey', 'ProjectDokumen'));
    }

    public function create($id)
    {
        $project = Project::findOrFail($id);
        $metrics = $project->metrics;
        return view('metric_projects.create', compact('project', 'metrics'));
    }

    public function store(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $request->validate([
            'metric_id' => 'required|exists:metrics,id',
            'value' => 'nullable|string',
            'report_month' => 'nullable|integer|min:1|max:12',
            'report_year' => 'nullable|integer',
        ]);

        $metricProject = MetricProject::create([
            'project_id' => $project->id,
            'metric_id' => $request->metric_id,
            'value' => $request->value,
            'report_month' => $request->report_month,
            'report_year' => $request->report_year,
            'metric_project_id' => null,
        ]);

        return redirect()->route('myproject.impact', $project->id)->with('success', 'Metric project created successfully.');
    }

    public function addReport($projectId, $metricProjectId)
    {
        $project = Project::findOrFail($projectId);
        $metricProject = MetricProject::findOrFail($metricProjectId);

        // Fetch latest report for the metric project
        $latestReport = MetricProject::where('metric_project_id', $metricProjectId)
                                    ->orderBy('report_year', 'desc')
                                    ->orderBy('report_month', 'desc')
                                    ->first();

        if ($latestReport) {
            $nextMonth = $latestReport->report_month;
            $nextYear = $latestReport->report_year;

            // Increment month and adjust year if necessary
            if ($nextMonth == 12) {
                $nextMonth = 1;
                $nextYear++;
            } else {
                $nextMonth++;
            }
        } else {
            $nextMonth = $metricProject->created_at->month;
            $nextYear = $metricProject->created_at->year;
        }

        return view('myproject.impact', compact('project', 'metricProject', 'nextMonth', 'nextYear'));
    }

    public function storeReport(Request $request, $projectId, $metricProjectId)
    {
        try {
            $project = Project::findOrFail($projectId);
            $metricProject = MetricProject::findOrFail($metricProjectId);

            // Validasi input
            $validatedData = $request->validate([
                'value' => 'required|string',
                'report_month' => 'required|string', // Ubah menjadi string untuk menerima nama bulan
                'report_year' => 'required|integer',
            ]);

            // Konversi nama bulan menjadi angka
            $reportMonth = $this->monthNameToNumber($validatedData['report_month']);
            if ($reportMonth === null) {
                return redirect()->back()->withErrors(['report_month' => 'Invalid month name.']);
            }

            // Simpan data ke dalam MetricProject
            $newMetricProject = MetricProject::create([
                'project_id' => $project->id,
                'metric_id' => $metricProject->metric_id,
                'value' => $validatedData['value'],
                'report_month' => $reportMonth, // Gunakan bulan yang telah dikonversi
                'report_year' => $validatedData['report_year'],
                'metric_project_id' => $metricProject->id,
            ]);

            return redirect()->route('myproject.detail', ['id' => $project->id])->with('success', 'Metric report added successfully.');
        } catch (\Exception $e) {
            // Return JSON response for debugging purposes
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($projectId, $metricProjectId)
    {
        $project = Project::findOrFail($projectId);
        $metricProject = MetricProject::findOrFail($metricProjectId);
        $metrics = $project->metrics;
        return view('metric_projects.edit', compact('project', 'metricProject', 'metrics'));
    }

    public function update(Request $request, $projectId, $metricProjectId)
    {
        $project = Project::findOrFail($projectId);
        $metricProject = MetricProject::findOrFail($metricProjectId);

        $request->validate([
            'metric_id' => 'required|exists:metrics,id',
            'value' => 'nullable|string',
            'report_month' => 'nullable|integer|min:1|max:12',
            'report_year' => 'nullable|integer',
        ]);

        $metricProject->update($request->all());

        return redirect()->route('metric-projects.index', $project->id)->with('success', 'Metric project updated successfully.');
    }

    public function destroy($projectId, $metricProjectId)
    {
        // Find the report metric project
        $project = Project::findOrFail($projectId);
        $metricProject = MetricProject::findOrFail($metricProjectId);

        // Delete the report metric project
        $metricProject->delete();

        // Redirect back with success message
        return redirect()->route('metric-projects.index', $project->id)->with('success', 'Metric project deleted successfully.');
    }

    public function matrixReport($id)
    {
        $project = Project::findOrFail($id);

        // Fetch metricProject, assuming the first metricProject is used for the view
        $metricProject = $project->metricProjects()->first();

        // Fetch monthly report data
        $monthlyReports = MetricProject::selectRaw('report_month, report_year, SUM(value) as total_value')
            ->where('project_id', $id)
            ->whereNotNull('report_month')
            ->whereNotNull('report_year')
            ->groupBy('report_year', 'report_month')
            ->orderBy('report_year')
            ->orderBy('report_month')
            ->get();

        // Transform the data for the chart
        $labels = $monthlyReports->map(function ($report) {
            $months = [
                1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
                5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
                9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
            ];
            $monthName = $months[$report->report_month];
            return $monthName . '/' . $report->report_year;
        });

        $values = $monthlyReports->pluck('total_value');

        // Create chart
        $chart = new MonthlyReportChart;
        $chart->labels($labels);
        $chart->dataset('Total Values', 'bar', $values)
            ->color('#5940CB')
            ->backgroundcolor('#5940CB');

        $matrixReports = MatrixReport::where('project_id', $id)->get();

        return view('myproject.creatproject.matrixreport', compact('project', 'metricProject', 'chart', 'matrixReports'));
    }

    public function getMetricReport($projectId, $metricId)
    {
        $project = Project::findOrFail($projectId);
        $metricProject = MetricProject::where('project_id', $projectId)->where('metric_id', $metricId)->firstOrFail();

        // Fetch monthly report data
        $monthlyReports = MetricProject::selectRaw('report_month, report_year, SUM(value) as total_value')
            ->where('project_id', $projectId)
            ->whereNotNull('report_month')
            ->whereNotNull('report_year')
            ->groupBy('report_year', 'report_month')
            ->orderBy('report_year')
            ->orderBy('report_month')
            ->get();

        // Transform the data for the chart
        $labels = $monthlyReports->map(function ($report) {
            $months = [
                1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
                5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
                9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
            ];
            $monthName = $months[$report->report_month];
            return $monthName . '/' . $report->report_year;
        });

        $values = $monthlyReports->pluck('total_value');

        // Create chart
        $chart = new MonthlyReportChart;
        $chart->labels($labels);
        $chart->dataset('Total Values', 'bar', $values)
            ->color('#5940CB')
            ->backgroundcolor('#5940CB');

        $matrixReports = MatrixReport::where('project_id', $projectId)->get();

        return view('myproject.creatproject.matrixreport', compact('project', 'metricProject', 'chart', 'matrixReports'));
    }


    public function createMatrixReport($projectId, $metricId, $metricProjectId)
    {
        $project = Project::findOrFail($projectId);

        $metricProject = MetricProject::where('project_id', $projectId)
                                      ->where('metric_id', $metricId)
                                      ->where('id', $metricProjectId)
                                      ->firstOrFail();

        $dataPoints = MetricProject::where('project_id', $projectId)
                                    ->where('metric_id', $metricId)
                                    ->where('metric_project_id', $metricProjectId)
                                    ->orderBy('report_year', 'asc')
                                    ->orderBy('report_month', 'asc')
                                    ->get();

        $chart = new MonthlyReportChart();
        if ($dataPoints->isNotEmpty()) {
            $labels = $dataPoints->map(function ($data) {
                return $this->formatMonth($data->report_month) . ' ' . $data->report_year;
            });
            $values = $dataPoints->pluck('value');

            $chart->labels($labels);
            $chart->dataset('Metric Values', 'line', $values)
                  ->color('#007bff')
                  ->backgroundcolor('rgba(0, 123, 255, 0.5)');
        } else {
            $chart->labels([]);
            $chart->dataset('Metric Values', 'line', [])
                  ->color('#007bff')
                  ->backgroundcolor('rgba(0, 123, 255, 0.5)');
        }

        return view('myproject.creatproject.add_matrixreport', compact('project', 'metricProject', 'chart'));
    }

    public function storeMatrixReport(Request $request, $projectId)
    {
        $validatedData = $request->validate([
            'metric_id' => 'required|exists:metrics,id',
            'evaluation' => 'required|string',
            'analysis' => 'required|string',
        ]);

        MatrixReport::create([
            'project_id' => $projectId,
            'metric_id' => $validatedData['metric_id'],
            'evaluation' => $validatedData['evaluation'],
            'analysis' => $validatedData['analysis'],
        ]);

        return redirect()->route('myproject.detail', $projectId)->with('success', 'Matrix report created successfully.');
    }

    public function showReport($projectId, $metricId, $reportId, $metricProjectId)
    {
        $project = Project::findOrFail($projectId);

        $metricProject = MetricProject::where('project_id', $projectId)
                                      ->where('metric_id', $metricId)
                                      ->where('id', $metricProjectId)
                                      ->firstOrFail();

        $dataPoints = MetricProject::where('project_id', $projectId)
                                    ->where('metric_id', $metricId)
                                    ->where('metric_project_id', $metricProjectId)
                                    ->orderBy('report_year', 'asc')
                                    ->orderBy('report_month', 'asc')
                                    ->get();

        $chart = new MonthlyReportChart();
        if ($dataPoints->isNotEmpty()) {
            $labels = $dataPoints->map(function ($data) {
                return $this->formatMonth($data->report_month) . ' ' . $data->report_year;
            });
            $values = $dataPoints->pluck('value');

            $chart->labels($labels);
            $chart->dataset('Metric Values', 'line', $values)
                  ->color('#007bff')
                  ->backgroundcolor('rgba(0, 123, 255, 0.5)');
        } else {
            $chart->labels([]);
            $chart->dataset('Metric Values', 'line', [])
                  ->color('#007bff')
                  ->backgroundcolor('rgba(0, 123, 255, 0.5)');
        }

        $matrixReport = MatrixReport::where('project_id', $projectId)
                                    ->where('metric_id', $metricId)
                                    ->where('id', $reportId)
                                    ->firstOrFail();

        return view('myproject.creatproject.show_matrixreport', compact('project', 'metricProject', 'chart', 'matrixReport'));
    }



    public function updateMatrixReport(Request $request, $projectId, $reportId)
    {
        $validatedData = $request->validate([
            'metric_id' => 'required|exists:metrics,id',
            'evaluation' => 'required|string',
            'analysis' => 'required|string',
        ]);

        $matrixReport = MatrixReport::findOrFail($reportId);
        $matrixReport->update([
            'evaluation' => $validatedData['evaluation'],
            'analysis' => $validatedData['analysis'],
        ]);

        return back()->with('success', 'Matrix report updated successfully.');
    }

    public function impact($projectId)
    {
        $project = Project::findOrFail($projectId);
        $matrixReports = MatrixReport::where('project_id', $projectId)->get();

        return view('myproject.impact', compact('project', 'matrixReports'));
    }

    public function showMetricImpact($projectId, $metricId, $metricProjectId, Request $request)
    {
        try {
            $status = null;
            $companyId = null;
            if ($request->has('status')) {
                $status = $request->input('status');
            }
            if ($request->has('companyId')) {
                $companyId = $request->input('companyId');
            }
            $user = Auth::user();
            $userRole = $user->role;

            // Find the project and metricProject based on the parameters
            $project = Project::findOrFail($projectId);
            $metricProject = MetricProject::where('project_id', $projectId)
                                            ->where('metric_id', $metricId)
                                            ->where('id', $metricProjectId)
                                            ->firstOrFail();

            // Get the year filter from the request
            $year = $request->input('year');  // Jika kosong, akan menjadi null

            // Fetch data points filtered by the selected year (if available)
            $dataPointsQuery = MetricProject::where('project_id', $projectId)
                                            ->where('metric_id', $metricId)
                                            ->where('metric_project_id', $metricProjectId)
                                            ->orderBy('report_year', 'asc')
                                            ->orderBy('report_month', 'asc');

            // Jika tahun dipilih, filter berdasarkan tahun
            if ($year) {
                $dataPointsQuery->where('report_year', $year); // filter by year // Filter berdasarkan tahun
            }

            // Ambil data setelah filter
            $dataPoints = $dataPointsQuery->get();

            // Determine next month and year
            $latestEntry = $dataPoints->last();
            $nextMonth = $latestEntry ? $latestEntry->report_month + 1 : now()->month;
            $nextYear = $latestEntry ? $latestEntry->report_year : now()->year;

            if ($nextMonth > 12) {
                $nextMonth = 1;
                $nextYear += 1;
            }

            $nextMonthName = $this->formatMonth($nextMonth);
            $calculation = $metricProject->metric->calculation;

            // Get matrix reports (could be related to some financial metrics)
            $matrixReports = MatrixReport::where('project_id', $projectId)
                                          ->where('metric_id', $metricId)
                                          ->get();

            // Create the chart (adjust according to your charting library)
            $chart = new Chart;
            // Create label with both month and year in 'month/year' format
            $chart->labels($dataPoints->map(function($dp) {
                return substr($this->formatMonth($dp->report_month ), 0, 3) . ' ' . $dp->report_year;  // Format bulan/tahun dengan bulan dibatasi 3 karakter
            }));
            $chart->dataset('Metric Progress', 'line', $dataPoints->pluck('value'))
                  ->backgroundColor('rgba(0,123,255,0.5)')
                  ->color('rgba(0,123,255,1)');

            // Pass the year, next month, and other necessary data to the view
            return view('myproject.impact', compact(
                'project', 'metricProject', 'dataPoints', 'nextMonthName',
                'nextYear', 'calculation', 'matrixReports', 'userRole', 'status', 'year', 'chart', 'projectId', 'metricId', 'metricProjectId', 'companyId'
            ));
        } catch (\Exception $e) {
            // Handle errors
            throw $e;
        }
    }

    private function formatMonth($month)
    {
        $months = [1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
                   5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
                   9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'];
        return $months[$month] ?? 'Unknown';
    }

    private function monthNameToNumber($monthName)
    {
        $months = [
            'January' => 1,
            'February' => 2,
            'March' => 3,
            'April' => 4,
            'May' => 5,
            'June' => 6,
            'July' => 7,
            'August' => 8,
            'September' => 9,
            'October' => 10,
            'November' => 11,
            'December' => 12,
        ];

        return $months[$monthName] ?? null; // Mengembalikan null jika bulan tidak ditemukan
    }

    /**
     * Membuat penampilan khusus untuk menampilkan data impact dari suatu metric project yang dimana tanpa bisa diedit
     */
    public function showImpact($projectId, $metricId, $metricProjectId) {
        $project = Project::findOrFail($projectId);
        $metricProject = MetricProject::where('project_id', $projectId)
                                    ->where('metric_id', $metricId)
                                    ->where('id', $metricProjectId)
                                    ->firstOrFail();

        // Fetching data to plot the chart
        $dataPoints = MetricProject::where('project_id', $projectId)
                                    ->where('metric_id', $metricId)
                                    ->where('metric_project_id', $metricProjectId)
                                    ->orderBy('report_year', 'asc')
                                    ->orderBy('report_month', 'asc')
                                    ->get(['report_month', 'report_year', 'value']); // Fetching only necessary fields

        $chart = new MonthlyReportChart();
        if ($dataPoints->isNotEmpty()) {
            $labels = $dataPoints->map(function ($data) {
                return $this->formatMonth($data->report_month) . ' ' . $data->report_year;
            });

            $values = $dataPoints->pluck('value');

            $chart->labels($labels);
            $chart->dataset('Metric Values', 'line', $values)
                ->color('#007bff')
                ->backgroundcolor('rgba(0, 123, 255, 0.5)');
        } else {
            // Ensure chart container is initialized even without data
            $chart->labels([]);
            $chart->dataset('Metric Values', 'line', [])
                ->color('#007bff')
                ->backgroundcolor('rgba(0, 123, 255, 0.5)');
        }

        // Pass the calculation method to the view
        $calculation = $metricProject->metric->calculation;

        // Fetch matrix reports (keeping this as it might be displayed in the view)
        $matrixReports = MatrixReport::where('project_id', $projectId)
                                    ->where('metric_id', $metricId)
                                    ->get(['id', 'created_at']); // Only fetch necessary fields for display

        return view('companies.project-matrix-detail', compact('project', 'metricProject', 'chart', 'calculation', 'matrixReports'));
    }

}
