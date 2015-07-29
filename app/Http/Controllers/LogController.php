<?php
    namespace App\Http\Controllers;

    use Validator;
    use App\Models\Log;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;

    class LogController extends Controller {

        public function index() {
            $logs = Log::all();
            return $this->getIndex($logs,'users');
        }

        public function create(Request $request) {
            $validator = Validator::make($request->all(), [
                           'user_id'  => 'required|alpha_num',
                           'type' => 'required|alpha',
                           'description' => 'min:0|max:300'
                        ]);

            if($validator->fails()) {
                $result = $this->getJSON(HTTP_BAD_REQUEST, 'error', 'Fail to validate', $validator->messages());
            } else {
                $log = new Log;

                $log->user_id = $request->input('user_id');
                $log->type = $request->input('type');
                $log->description = $request->input('description');

                if($log->save()) {
                    $result = $this->getJSON(HTTP_OK, 'success', 'Log saved: '.$log->user_id, $log, 1);
                } else {
                    $result = $this->getJSON(HTTP_SERVER_ERROR, 'error', 'Log can not be created');
                }
            }

            return $result;
        }

        public function read($id) {
            $logs = Log::all();
            $find = Log::find($id);
            return $this->getRead($logs, 'users', $id, $find,$logs->user_id);
        }
    }
