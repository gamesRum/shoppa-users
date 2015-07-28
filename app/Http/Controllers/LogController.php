<?php
    namespace App\Http\Controllers;

    use Validator;
    use App\Models\Log;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;

    class LogController extends Controller {
        public function index() {
            $response = null;
            $logs = Log::all();

            if($logs->isEmpty()) {
                $response = $this->getJSON(HTTP_NOT_FOUND, 'error', 'No logs found.');
            } else {
                $response = $this->getJSON(HTTP_OK, 'success', $logs->count().' logs found.', $logs, $logs->count());
            }

            return $response;
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
            $response = null;

            if($log = Log::find($id)) {
                $response = $this->getJSON(HTTP_OK, 'success', 'Log found: '.$log->user_id, $log);
            } else {
                $response = $this->getJSON(HTTP_NOT_FOUND, 'error', 'Log #'.$id.' - Not found.');
            }

            return $response;
        }
    }
