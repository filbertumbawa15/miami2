<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreResultRequest;
use App\Http\Requests\UpdateResultRequest;
use App\Models\Result;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    public function index()
    {
        $limit = request('limit') ?? 10;
        $page = request('page') ?? 1;

        $query = DB::table((new Result())->getTable());
        $totalRecords = $query->count();

        if (request('filters')) {
            foreach (request('filters') as $index => $filter) {
                $query = $query->orWhere($index, 'LIKE', "%$filter%");
            }

            $totalRecords = $query->count();
        }

        if (isset(request('sorts')['column']) && isset(request('sorts')['direction'])) {
            $query = $query->orderBy(request('sorts')['column'], request('sorts')['direction']);
        }

        $totalPages = ceil($totalRecords / $limit);

        $categories = $query->skip(($page - 1) * $limit)->take($limit)->get();

        return response([
            'totalRecords' => $totalRecords,
            'totalPages' => $totalPages,
            'data' => $categories,
        ]);
    }

    public function show(Result $result)
    {
        if ($result) {
            return response([
                'data' => $result
            ]);
        }

        return response([
            'message' => 'No data found'
        ], 404);
    }

    public function store(StoreResultRequest $request)
    {
        try {
            $storedResult = Result::create([
                'number' => $request->number,
                'out_at' => strtotime($request->out_at),
                'user_id' => $request->user()->id
            ]);

            if ($storedResult) {
                return response([
                    'data' => $storedResult,
                    'message' => 'Created successfully'
                ], 201);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(UpdateResultRequest $request, Result $result)
    {
        $updatedResult = $result->update([
            'number' => $request->number,
            'out_at' => strtotime($request->out_at),
            'user_id' => $request->user()->id
        ]);

        if ($updatedResult) {
            return response([
                'data' => $updatedResult,
                'message' => 'Updated successfully'
            ]);
        }
    }

    public function destroy(Result $result)
    {
        try {
            if ($result->delete()) {
                return response([
                    'message' => 'Deleted successfully'
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function current()
    {
        $result = Result::where('out_at', '<=', time())
            ->orderBy('out_at', 'desc')
            ->first();

        return response([
            'data' => $result
        ]);
    }

    public function getCountdown()
    {
        $result = Result::where('out_at', '>=', time())
            ->orderBy('out_at', 'desc')
            ->first();

        return response([
            'data' => $result
        ]);
    }

    public function listhistory()
    {
        // where('out_at', '<', time())->
        $limit = $_GET['limit'] ?? 0;
        $count = Result::where('out_at', '<=', time())->count();
        if ($limit > 0) {
            $query = Result::where('out_at', '<=', time())->limit($limit)->orderby('out_at', 'desc')->get();
        } else {
            $query = Result::where('out_at', '<=', time())->orderby('out_at', 'desc')->get();
        }

        return response([
            'data' => $query,
            'count' => $count
        ]);
    }

    public function count()
    {
        $query = Result::get()->count();

        return response([
            'data' => $query,
        ]);
    }
}
