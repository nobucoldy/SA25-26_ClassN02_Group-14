<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // 1. Validate đầu vào
        $request->validate([
            'login_field' => ['required'],
            'password' => ['required'],
        ], [
            'login_field.required' => 'Vui lòng nhập Email hoặc Số điện thoại.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
        ]);

        $loginValue = $request->input('login_field');
        
        // 2. Tự động nhận diện Email hay Phone
        $fieldType = filter_var($loginValue, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        $credentials = [
            $fieldType => $loginValue,
            'password' => $request->password,
        ];

        // 3. Thực hiện đăng nhập
        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();
            
            // Lấy tên người dùng vừa đăng nhập để chào mừng
            $userName = Auth::user()->name;
            
            // Redirect về trang chủ với thông báo cá nhân hóa
            return redirect('/')->with('success', "Chào mừng $userName quay trở lại! Đăng nhập thành công.");
        }

        // Nếu thất bại
        return back()->withErrors([
            'login_field' => 'Thông tin đăng nhập hoặc mật khẩu không chính xác.',
        ])->withInput($request->only('login_field', 'remember'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Bạn đã đăng xuất tài khoản.');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => ['required', 'numeric', 'digits_between:10,11', 'unique:users,phone'],
            'password' => ['required', 'confirmed', 'min:8'],
        ], [
            'name.required' => 'Họ và tên không được để trống.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Định dạng Email không hợp lệ.',
            'email.unique' => 'Email này đã tồn tại trong hệ thống.',
            'phone.required' => 'Số điện thoại không được để trống.',
            'phone.unique' => 'Số điện thoại này đã được sử dụng bởi tài khoản khác.',
            'phone.numeric' => 'Số điện thoại phải là định dạng số.',
            'phone.digits_between' => 'Số điện thoại phải từ 10 đến 11 chữ số.',
            'password.required' => 'Mật khẩu không được để trống.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'customer', 
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập tài khoản mới.');
    }
}