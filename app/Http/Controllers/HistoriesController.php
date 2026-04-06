<?php

namespace App\Http\Controllers;

use Excel;
use App\Display;
use App\History;
use App\Workstation;
use Barryvdh\DomPDF\Facade as PDF;
use Amenadiel\JpGraph\Plot;
use Amenadiel\JpGraph\Graph;
use Illuminate\Http\Request;
use App\Exports\HistoryExport;
use Yajra\Datatables\Datatables;
// use mikehaertl\wkhtmlto\Pdf;

class HistoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('histories.index');
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
        $item = History::find($id);
        if ($item->display->app == 'S1 manager') {
            return view('histories.show_s1')->with('item', $item);
        }
        return view('histories.show')->with('item', $item);
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

    /**
     * List all items
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $id = request()->input('id');
        $s = explode('-', $id);
        $type = $id = '';
        if (count($s) >= 2) {
            $type = $s[0];
            $id = $s[1];
        }

        $items = History::with('display.workstation.workgroup.facility')->has('display');
        $items->when($id, function ($q) use ($id) {
            return $q->where('display_id', $id);
        });

        $facility_id = auth()->user()->facility_id;

        $items->when($facility_id, function ($q) use ($facility_id) {
            return $q->join('displays', 'displays.id', '=', 'histories.display_id')
                ->join('workstations', 'workstations.id', '=', 'displays.workstation_id')
                ->join('workgroups', 'workgroups.id', '=', 'workstations.workgroup_id')

                ->where('workgroups.facility_id', '=', $facility_id);
        })->select('histories.*');

        return Datatables::of($items)
            ->rawColumns(['time', 'resultIcon', 'link', 'display.link', 'display.workstation.link', 'display.workstation.workgroup.link', 'display.workstation.workgroup.facility.link'])
            ->editColumn('time', function ($history) {
                // trick to order time column
                return '<span style="display:none;">' . $history->time . '</span>' . date('d/m/Y H:i', $history->time);
            })
            ->make(true);
    }


    public function graphSpect($history_id, $step_id, $graph_id)
    {
        // Get the graph object
        $history = History::find($history_id);
        if ($history) {
            $g = $history->steps[$step_id]['graphs'][$graph_id];
        }


        foreach ($g['lines'] as $lk => $line) {
            $i = 0;
            $pt = array();
            $data = [];
            foreach ($line['points'] as $k => $p) {
                $pt[] = $p['y'];
                if (($k + 1) % 3 == 0 && $k > 0) {
                    $data[$i] = $pt;
                    $pt = array();
                    $i++;
                }
            }
            // Basic contour graph
            $graph = new Graph\Graph(800, 600);
            $graph->SetScale('intint');

            // Adjust the margins to fit the margin
            $graph->SetMargin(30, 120, 40, 30);

            // Setup
            $graph->title->Set($g['name']);
            $graph->xaxis->HideLabels(true);
            //$graph->xaxis->HideTicks(false,false);
            //$graph->title->SetFont(FF_ARIAL,FS_BOLD,12);

            // A simple contour plot with default arguments (e.g. 10 isobar lines)
            $cp = new Plot\FilledContourPlot($data, 150);
            //$cp->UseHighContrastColor(true);
            $cp->SetInvert();
            $cp->SetFilled(true);
            $cp->ShowLines(false);
            $cp->ShowLabels(false);
            //$cp->ShowLabels(true,true);
            //$cp->SetFont(FF_ARIAL,FS_BOLD,9);
            //$cp->SetFontColor('white');

            // Display the legend
            //$cp->ShowLegend();

            $graph->Add($cp);
        }

        // ... and send the graph back to the browser
        $graph->Stroke();
    }

    public static function hex2rgb($hex)
    {
        $hex = str_replace("#", "", $hex);

        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = "RGB ($r, $g, $b)";
        //return implode(",", $rgb); // returns the rgb values separated by commas
        return $rgb; // returns an array with the rgb values
    }
    public function graphToImage($history_id, $step_id, $graph_id)
    {
        // Get the graph object
        $history = History::find($history_id);
        if ($history) {
            $g = $history->steps[$step_id]['graphs'][$graph_id];
        }


        $graph = new Graph\PieGraph(350, 250);
        $graph->title->Set("A Simple Pie Plot");
        $graph->SetBox(true);

        $data = array(40, 21, 17, 14, 23);
        $p1   = new Plot\PiePlot($data);
        $p1->ShowBorder();
        $p1->SetColor('black');
        $p1->SetSliceColors(array('#1E90FF', '#2E8B57', '#ADFF2F', '#DC143C', '#BA55D3'));

        $graph->Add($p1);
        $graph->Stroke();
    }
    public function exportPDF(Request $request)
    {
        $id = $request->input('id');
        $graph = $request->input('graph');
        $graph = $graph? json_decode($graph, true): [];
        $item = History::find($id);
        $pdf = PDF::loadView('histories.pdf',  compact('item', 'graph'));
        return $pdf->download($item->name . '.pdf');
    }
}
