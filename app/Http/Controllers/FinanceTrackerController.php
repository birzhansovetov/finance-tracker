<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class FinanceTrackerController extends Controller
{
    public function landing()
    {
        return view('finance.landing');
    }

    public function register()
    {
        return view('finance.register');
    }

    public function registerSubmit(Request $request)
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'unique:users,email'],
        'password' => ['required', 'confirmed', 'min:6'],
        'terms' => ['required'],
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    $user->assignRole('viewer'); 

    Auth::login($user);

    return redirect()->route('dashboard');
}

    public function login()
    {
        return view('finance.login');
    }

    public function loginSubmit(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard')
                ->with('success', __('app.login_success'));
        }

        return back()->with('error', __('app.login_error'));
    }

    public function forgotPassword()
    {
        return view('finance.simple-page', [
            'title' => 'app.forgot_password',
            'description' => 'app.forgot_password_desc'
        ]);
    }

    public function dashboard()
    {
        return view('finance.dashboard');
    }

    public function addTransaction()
    {
        return view('finance.simple-page', [
            'title' => 'app.add_transaction',
            'description' => 'app.add_transaction_desc'
        ]);
    }

    public function transactionsHistory()
    {
        return view('finance.simple-page', [
            'title' => 'app.transactions',
            'description' => 'app.transactions_desc'
        ]);
    }

    public function categories()
    {
        return view('finance.simple-page', [
            'title' => 'app.categories',
            'description' => 'app.categories_desc'
        ]);
    }

    public function budgets()
    {
        return view('finance.simple-page', [
            'title' => 'app.budgets',
            'description' => 'app.budgets_desc'
        ]);
    }

    public function analytics()
    {
        return view('finance.analytics');
    }

    public function goalsSavings()
    {
        return view('finance.simple-page', [
            'title' => 'app.goals',
            'description' => 'app.goals_desc'
        ]);
    }

    public function subscriptions()
    {
        return view('finance.simple-page', [
            'title' => 'app.subscriptions',
            'description' => 'app.subscriptions_desc'
        ]);
    }

    public function incomeSources()
    {
        return view('finance.simple-page', [
            'title' => 'app.income_sources',
            'description' => 'app.income_sources_desc'
        ]);
    }

    public function reports()
    {
        return view('finance.simple-page', [
            'title' => 'app.reports',
            'description' => 'app.reports_desc'
        ]);
    }

    public function notifications()
    {
        return view('finance.simple-page', [
            'title' => 'app.notifications',
            'description' => 'app.notifications_desc'
        ]);
    }

    public function profile()
    {
        return view('finance.simple-page', [
            'title' => 'app.profile',
            'description' => 'app.profile_desc'
        ]);
    }

    public function settingsSecurity()
    {
        return view('finance.simple-page', [
            'title' => 'app.settings',
            'description' => 'app.settings_desc'
        ]);
    }

    public function supportFaq()
    {
        return view('finance.simple-page', [
            'title' => 'app.support',
            'description' => 'app.support_desc'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}