<?php
    namespace App\Http\Controllers;

    use App\Models\User;
    use App\Http\Controllers\Controller;

    class UserController extends Controller {
        public function index() {
            $response = null;
            $users = User::all();

            if($users->isEmpty()) {
                $response = $this->getJSON(HTTP_NOT_FOUND, 'error', 'No users found.');
            } else {
                $response = $this->getJSON(HTTP_OK, 'success', $users->count().' users found.', $users, $users->count());
            }

            return response()->json($response);
        }

        public function create() {
            return $this->getJSON(HTTP_SERVER_ERROR);
        }

        public function read() {
            return $this->getJSON(HTTP_SERVER_ERROR);
        }

        public function update() {
            return $this->getJSON(HTTP_SERVER_ERROR);
        }

        public function delete() {
            return $this->getJSON(HTTP_SERVER_ERROR);
        }

    }
