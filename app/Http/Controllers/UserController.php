<?php
    namespace App\Http\Controllers;

    use Validator;
    use App\Models\User;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;

    class UserController extends Controller {
        public function index() {
            $response = null;
            $users = User::all();

            if($users->isEmpty()) {
                $response = $this->getJSON(HTTP_NOT_FOUND, 'error', 'No users found.');
            } else {
                $response = $this->getJSON(HTTP_OK, 'success', $users->count().' users found.', $users, $users->count());
            }

            return $response;
        }

        public function create(Request $request) {
            $validator = Validator::make($request->all(), [
                           'username'  => 'required|unique:users|min:4|max:20|alpha_dash',
                           'password_hash' => 'required|min:32|max:32|alpha_num',
                           'email' => 'required|unique:users|min:8|max:80|email'
                        ]);

            if($validator->fails()) {
                $result = $this->getJSON(HTTP_BAD_REQUEST, 'error', 'Fail to validate', $validator->messages());
            } else {
                $user = new User;

                $user->username = $request->input('username');
                $user->email = $request->input('email');
                $user->password_hash = $request->input('password_hash');
                if($user->save()) {
                    $result = $this->getJSON(HTTP_OK, 'success', 'User saved: '.$user->username, $user, 1);
                } else {
                    $result = $this->getJSON(HTTP_SERVER_ERROR, 'error', 'User can not be created');
                }
            }

            return $result;
        }

        public function read($id) {
            $response = null;

            if($user = User::find($id)) {
                $response = $this->getJSON(HTTP_OK, 'success', 'User found: '.$user->username, $user);
            } else {
                $response = $this->getJSON(HTTP_NOT_FOUND, 'error', 'User #'.$id.' - Not found.');
            }

            return $response;
        }

        public function update(Request $request, $id) {
            // TODO: remove unique username and email validation if the user already exists.

            if($user = User::find($id)) {
                $validator = Validator::make($request->all(), [
                               'username'  => 'required|unique:users|min:4|max:20|alpha_dash',
                               'password_hash' => 'required|min:32|max:32|alpha_num',
                               'email' => 'required|unique:users|min:8|max:80|email'
                            ]);

                if($validator->fails()) {
                    $result = $this->getJSON(HTTP_BAD_REQUEST, 'error', 'Fail to validate', $validator->messages());
                } else {

                    $user->username = $request->input('username');
                    $user->email = $request->input('email');
                    $user->password_hash = $request->input('password_hash');

                    if($user->save()) {
                        $result = $this->getJSON(HTTP_OK, 'success', 'User updated: '.$user->username, $user, 1);
                    } else {
                        $result = $this->getJSON(HTTP_SERVER_ERROR, 'error', 'User can not be updated');
                    }
                }
            } else {
                $result = $this->getJSON(HTTP_NOT_FOUND, 'error', 'User #'.$id.' - Not found.');
            }

            return $result;
        }

        public function delete($id) {
            $response = null;

            if($user = User::find($id)) {
                if($user->delete()) {
                    $response = $this->getJSON(HTTP_OK, 'success', null, 'User deleted: '.$user->username);
                } else {
                    $response = $this->getJSON(HTTP_SERVER_ERROR, 'error', null, 'User #'.$id.' - can not be erased.');
                }
            } else {
                $response = $this->getJSON(HTTP_NOT_FOUND, 'error', null, 'User #'.$id.' - Not found.');
            }

            return $response;
        }

    }
