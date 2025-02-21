<?php

use Auth\SimpleUserUpdateException;

class Controller_Api_Auth extends Controller_Rest
{

    /** @var string Định dạng response mặc định */
    protected $format = 'json';

    /** @var repository_user Repository xử lý dữ liệu User */
    private $repository_user;

    /**
     * Thiết lập trước khi thực hiện các phương thức API.
     *
     * @access public
     * @return void
     */
    public function before()
    {
        parent::before();
        $this->repository_user = new repository_user();
    }


    public function post_login()
    {
        try{
            $input = \Input::json();
            $emailOrUsername = $input['email_or_username'];
            $password = $input['password'];
            if (!$emailOrUsername || !$password) {
                return $this->response(['error' => 'Thiếu thông tin đăng nhập'], 400);
            }

            if (Auth::login($emailOrUsername, $password)) {
                $userId = Auth::get_user_id()[1];
                return $this->response([
                    'message' => 'Đăng nhập thành công',
                    'user_id' => $userId,
                    'token' => Session::key(), // Trả về token session
                ], 200);
            } else {
                return $this->response(['error' => 'Thông tin đăng nhập không chính xác'], 401);
            }
        } catch (Exception $e) {
            $this->response(['error' => $e->getMessage()], 500);
        }
    }

    public function post_register()
    {
        try {
            $input = Input::json();

            $username = $input['username'];
            $name = $input['name'];
            $password = $input['password'];
            $email = $input['email'];

            if (!$name || !$password || !$email || !$username) {
                return $this->response(['error' => 'Thiếu thông tin đăng ký'], 400);
            }
            // Tạo người dùng mới
            $userId = Auth::create_user($username, $password, $email);
            $this->repository_user->update($userId, ['name' => $name, 'is_admin' => 0]);

            return $this->response(['message' => 'Đăng ký thành công', 'user_id' => $userId], 200);
        } catch (SimpleUserUpdateException $e) {
            return $this->response(['error' => 'Đăng ký thất bại, tài khoản có thể đã tồn tại'], 400);
        } catch (Exception $e) {
            return $this->response(['error' => $e->getMessage()], 500);
        }
    }

    public function post_logout()
    {
        try {
            Auth::logout();
            return $this->response(['message' => 'Đăng xuất thành công'], 200);
        } catch (Exception $e) {
            return $this->response(['error' => $e->getMessage()], 500);
        }
    }

}
