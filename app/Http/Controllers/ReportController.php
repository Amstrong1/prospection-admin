<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('app.reports.index', [
            'reports' => Report::all(),
            'my_actions' => $this->report_actions(),
            'my_attributes' => $this->report_columns(),
        ]);
    }

    public function show(Report $report)
    {
        return view('app.reports.show', [
            'report' => $report,
            'my_fields' => $this->solution_fields(),
        ]);
    }

    private function report_columns()
    {
        $columns = (object) [
            'user_name' => 'Agent',
            'prospect_name' => 'Prospect',
            'report' => 'Rapport',
            'formatted_created_at' => 'Date',
        ];
        return $columns;
    }

    private function report_actions()
    {
        $actions = (object) array(
            'show' => 'Voir',
        );
        return $actions;
    }

    private function solution_fields()
    {

        $fields = [
            'user_name' => [
                'title' => 'Agent',
                'field' => 'text',
            ],
            'prospect_name' => [
                'title' => 'Prospect',
                'field' => 'text',
            ],
            'report' => [
                'title' => 'Rapport',
                'field' => 'textarea',
            ]
        ];
        return $fields;
    }
}
