<?php

namespace App\Http\Controllers;

use App\QualityCheck;
use App\QualityCheckResult;
use App\Url;
use App\User;
use App\Http\Controllers\Controller;
use App\Monitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class MonitorsController extends Controller
{

    public function index()
    {
        return view('monitors.index', ['monitors' => Monitor::all()]);
    }

    public function store(Request $request)
    {
        $monitor = new Monitor();
        $monitor->url = $request->get('url_to_monitor');
        $monitor->save();

        Artisan::call('monitor:crawl', [
            'monitor' => $monitor->id, //'--queue' => 'default'
        ]);

        return redirect('/');
    }

    /**
     * Show the profile for the given user.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        return view('monitors.show', ['monitor' => Monitor::findOrFail($id), 'quality_checks' => QualityCheck::all()]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        foreach (Url::where('monitors_id', $id)->cursor() as $url) {

            // Delete Quality Check Results
            QualityCheckResult::where('url_id', $id)->delete();

        }

        // Delete URL's
        Url::where('monitors_id', $id)->delete();

        Monitor::destroy($id);

        return redirect('/');
    }
}