<?php
namespace App\Actions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

abstract class AbstractAction {
    protected ?Model $model;
    protected ?array $data;
    protected ?Request $request;

    public function __construct(Model $model = null, array $data = null, Request $request = null)
    {
        $this->model = $model;
        $this->data = $data;
        $this->request = $request;
    }

    abstract protected function do();

    final public function run()
    {
        DB::beginTransaction();
        try {
            $result = $this->do();
            DB::commit();
        } catch (\Exception $e) {
			Log::info($e);
            DB::rollBack();
            throw $e;
        }
        return $result;
    }
}