<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\PromoCode;
use App\Helper\WalletHelper;
use App\Models\MonthlyChart;
use Illuminate\Http\Request;
use App\Models\WalletHistory;
use App\Models\PurchaseCourse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        return redirect()->route('clients.index');
    }
}
