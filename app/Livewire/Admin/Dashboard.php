<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Food;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]

class Dashboard extends Component
{
    public $totalOrders;
    public $totalProducts;
    public $totalRevenue;
    public $totalUsers;
    public $pendingReviews;
    public $recentOrders = [];
    public $categoryChartData = [];
    public $lineGraphData;

    public function mount()
    {
        $this->authorizeAccess();
        $this->loadDashboardData();
        $this->loadLineGraphData();
    }

    protected function authorizeAccess()
    {
        if (!auth()->user() || auth()->user()->role !== 1) {
            abort(403, 'Unauthorized');
        }
    }

    protected function loadLineGraphData()
    {
        $driver = DB::getDriverName();

        if ($driver === 'sqlite') {
            $this->lineGraphData = DB::table('orders')
                ->selectRaw("strftime('%m', created_at) as month_number")
                ->selectRaw("strftime('%Y-%m', created_at) as month_label")
                ->selectRaw("SUM(total_price) as revenue")
                ->where('payment_status', 'paid')
                ->where('created_at', '>=', now()->subYear())
                ->groupBy('month_label')
                ->orderBy('month_label')
                ->get()
                ->map(function ($row) {
                    $monthName = Carbon::createFromFormat('Y-m', $row->month_label)->format('M');
                    return [
                        'month' => $monthName,
                        'revenue' => (float) $row->revenue,
                    ];
                })
                ->toArray();
        } else {
            $this->lineGraphData = DB::table('orders')
                ->selectRaw('DATE_FORMAT(created_at, "%b") as month, MONTH(created_at) as month_num, SUM(total_price) as revenue')
                ->where('payment_status', 'paid')
                ->where('created_at', '>=', now()->startOfYear()) // adjust range if needed
                ->groupByRaw('DATE_FORMAT(created_at, "%b"), MONTH(created_at)')
                ->orderBy('month_num')
                ->get()
                ->map(function ($row) {
                    return [
                        'month' => $row->month,
                        'revenue' => (float) $row->revenue,
                    ];
                })
                ->toArray();
        }
    }

    protected function loadDashboardData()
    {
        $this->totalOrders = Order::all()->count();
        $this->totalProducts = Food::all()->count();
        $this->totalUsers = User::where('role', 2)->count();
        $this->pendingReviews = 0;
        // $this->pendingReviews = FoodReview::where('status', 'pending')->count();
        $this->recentOrders = Order::with('user')->latest()->take(7)->get();
        $this->totalRevenue = Order::where('status', 'delivered')->sum('total_price');
        $this->categoryChartData = $this->getCategorySalesChartData();
    }

    protected function getCategorySalesChartData()
    {
        $fromDate = Carbon::now()->subDays(30);
        $toDate = Carbon::now();

        $categories = Category::with(['food' => function ($query) use ($fromDate, $toDate) {
            $query->whereHas('orderItems.order', function ($q) use ($fromDate, $toDate) {
                $q->whereBetween('created_at', [$fromDate, $toDate])
                    ->where('status', 'delivered');
            });
        }])->get();

        $data = [];

        foreach ($categories as $category) {
            $sold = 0;
            $revenue = 0;

            foreach ($category->food as $fd) {
                foreach ($fd->orderItems as $item) {
                    $sold += $item->quantity;
                    $revenue += $item->quantity * $item->price;
                }
            }

            if ($sold > 0) {
                $data[] = [
                    'label' => $category->name,
                    'quantity' => $sold,
                    'revenue' => $revenue
                ];
            }
        }
        return $data;
    }
    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
