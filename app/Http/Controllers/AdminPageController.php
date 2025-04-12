<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use App\Models\View;
use App\Models\Order;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\SocialMedia;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminPageController extends Controller
{

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\View\View
     */

    public function dashboard()
    {

        $totalOrders = Order::where('status', 'paid')->count();
        // Current week's total orders
        $currentWeekStart = Carbon::now()->startOfWeek(); // Get the start of this week (Monday)
        $currentTotalOrders = Order::where('status', 'paid')
            ->whereBetween('created_at', [$currentWeekStart, Carbon::now()])
            ->count();

        // Previous week's total orders
        $previousWeekStart = Carbon::now()->subWeek()->startOfWeek(); // Get the start of last week
        $previousWeekEnd = Carbon::now()->subWeek()->endOfWeek(); // Get the end of last week
        $previousTotalOrders = Order::where('status', 'paid')
            ->whereBetween('created_at', [$previousWeekStart, $previousWeekEnd])
            ->count();

        // Calculate the difference in the number of orders
        // $ordersChange = $currentTotalOrders - $previousTotalOrders;
        // $ordersChange = ($ordersChange / $previousTotalOrders) * 100;
        $ordersChange = $previousTotalOrders > 0 ? (($currentTotalOrders - $previousTotalOrders) / $previousTotalOrders) * 100 : 0;

        $totalRevenue = Order::where('status', 'paid')->sum('total');

        // Current week's revenue
        $currentRevenue = Order::where('status', 'paid')
            ->whereBetween('created_at', [$currentWeekStart, Carbon::now()])
            ->sum('total');

        // Previous week's revenue
        $previousWeekStart = Carbon::now()->subWeek()->startOfWeek(); // Get the start of last week
        $previousWeekEnd = Carbon::now()->subWeek()->endOfWeek(); // Get the end of last week
        $previousRevenue = Order::where('status', 'paid')
            ->whereBetween('created_at', [$previousWeekStart, $previousWeekEnd])
            ->sum('total');

        // Calculate the difference in earnings
        // $earningsChange = $currentRevenue - $previousRevenue;
        // $earningsChange = ($earningsChange / $previousRevenue) * 100;
        $earningsChange = $previousRevenue > 0 ? (($currentRevenue - $previousRevenue) / $previousRevenue) * 100 : 0;

        $totalUsers = User::where('role', 'user')->count();
        // Current week's total users
        $currentTotalUsers = User::where('role', 'user')
            ->whereBetween('created_at', [$currentWeekStart, Carbon::now()])
            ->count();
        // Previous week's total users
        $previousTotalUsers = User::where('role', 'user')
            ->whereBetween('created_at', [$previousWeekStart, $previousWeekEnd])
            ->count();
        // Calculate the difference in the number of users
        // $usersChange = $currentTotalUsers - $previousTotalUsers;
        // $usersChange = ($usersChange / $previousTotalUsers) * 100;
        $usersChange = $previousTotalUsers > 0 ? (($currentTotalUsers - $previousTotalUsers) / $previousTotalUsers) * 100 : 0;

        $totalBlogViews = Post::sum('views');

        $totalServices = Service::count();
        // Current week's total services
        $currentTotalServices = Service::where('active', true)
            ->whereBetween('created_at', [$currentWeekStart, Carbon::now()])
            ->count();
        // Previous week's total services
        $previousTotalServices = Service::where('active', true)
            ->whereBetween('created_at', [$previousWeekStart, $previousWeekEnd])
            ->count();
        // Calculate the difference in the number of services
        // $servicesChange = $currentTotalServices - $previousTotalServices;
        // $servicesChange = ($servicesChange / $previousTotalServices) * 100;
        $servicesChange = $previousTotalServices > 0 ? (($currentTotalServices - $previousTotalServices) / $previousTotalServices) * 100 : 0;

        // Data for charts
        // Generate the last 12 months
        // Get the last 12 months from the current month
        $start = Carbon::now()->startOfYear(); // Start from January of the current year

        $months = collect(range(0, 11))->map(function ($i) use ($start) {
            return $start->copy()->addMonths($i)->format('Y-m'); // Move forward month by month
        });



        // Fetch total orders per month
        $ordersData = Order::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as count")
            ->where('status', 'paid')
            ->whereBetween('created_at', [Carbon::now()->subMonths(11)->startOfMonth(), Carbon::now()->endOfMonth()])
            ->groupBy('month')
            ->pluck('count', 'month');

        // Fetch total earnings per month
        $earningsData = Order::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month, SUM(total) as total")
            ->where('status', 'paid')
            ->whereBetween('created_at', [Carbon::now()->subMonths(11)->startOfMonth(), Carbon::now()->endOfMonth()])
            ->groupBy('month')
            ->pluck('total', 'month');

        // Fetch total blog views per month
        $blogViewsData = DB::table('posts')
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month, SUM(CAST(views AS UNSIGNED)) as total")
            ->where('status', 'published')
            ->whereBetween('created_at', [Carbon::now()->subMonths(11)->startOfMonth(), Carbon::now()->endOfMonth()])
            ->groupBy('month')
            ->pluck('total', 'month');


        // dd($ordersData, $earningsData, $blogViewsData);
        // Format the final data for the chart
        $finalData = [
            [
                'name' => "Orders",
                'type' => 'line',
                'data' => $months->map(fn($month) => $ordersData[$month] ?? 0)->toArray()
            ],
            [
                'name' => "Earnings",
                'type' => 'area',
                'data' => $months->map(fn($month) => $earningsData[$month] ?? 0)->toArray()
            ],
            [
                'name' => "Blog Views",
                'type' => 'line',
                'data' => $months->map(fn($month) => $blogViewsData[$month] ?? 0)->toArray()
            ]
        ];

        $users = User::where('role', 'user')->orderBy('id', 'desc')->limit(10)->get();

        $orders = Order::orderBy('id', 'desc')->limit(6)->get();

        // $finalData = json_encode($finalData, JSON_PRETTY_PRINT);
        // dd($finalData);
        return view('admin.index', compact('totalOrders', 'totalRevenue', 'totalUsers', 'totalServices', 'earningsChange', 'ordersChange', 'usersChange', 'servicesChange', 'finalData', 'totalBlogViews', 'users', 'orders'));
    }

    public function users() {
        $users = User::orderBy('id', 'desc')->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function updateUser(User $user) {
        $role = $user->role === 'user' ? 'admin' : 'user';

        $user->update(['role' => $role]);

        return redirect()->back()->with('success', 'User role updated successfully');
    }

    public function deleteUser(User $user) {
        if($user->image) {
            Storage::disk('public')->delete($user->image);
        }

        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully');
    }

    public function views()
    {
        $totalHomeViews = View::where('page_id', 'home')->count();

        $thisWeekViews = View::where('page_id', 'home')
            ->where('created_at', '>=', now()->startOfWeek())
            ->count();

        $lastWeekViews = View::where('page_id', 'home')
            ->whereBetween('created_at', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()])
            ->count();

        // Calculate percentage change
        if ($lastWeekViews > 0) {
            $homeViewChange = (($thisWeekViews - $lastWeekViews) / $lastWeekViews) * 100;
        } else {
            // If there were no views last week, assume 100% increase if there are views this week, otherwise 0
            $homeViewChange = $thisWeekViews > 0 ? 100 : 0;
        }

        $totalServiceViews = View::where('type', 'service')->count();

        $thisWeekViews = View::where('type', 'service')
            ->where('created_at', '>=', now()->startOfWeek())
            ->count();

        $lastWeekViews = View::where('type', 'service')
            ->whereBetween('created_at', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()])
            ->count();

        // Calculate percentage change
        if ($lastWeekViews > 0) {
            $serviceViewChange = (($thisWeekViews - $lastWeekViews) / $lastWeekViews) * 100;
        } else {
            // If there were no views last week, assume 100% increase if there are views this week, otherwise 0
            $serviceViewChange = $thisWeekViews > 0 ? 100 : 0;
        }

        $totalBlogViews = View::where('type', 'post')->count();

        $thisWeekViews = View::where('type', 'post')
            ->where('created_at', '>=', now()->startOfWeek())
            ->count();

        $lastWeekViews = View::where('type', 'post')
            ->whereBetween('created_at', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()])
            ->count();

        // Calculate percentage change
        if ($lastWeekViews > 0) {
            $blogViewChange = (($thisWeekViews - $lastWeekViews) / $lastWeekViews) * 100;
        } else {
            // If there were no views last week, assume 100% increase if there are views this week, otherwise 0
            $blogViewChange = $thisWeekViews > 0 ? 100 : 0;
        }

        $totalPagesViews = View::where('type', 'page')->count();

        $thisWeekViews = View::where('type', 'page')
            ->where('created_at', '>=', now()->startOfWeek())
            ->count();

        $lastWeekViews = View::where('type', 'page')
            ->whereBetween('created_at', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()])
            ->count();

        // Calculate percentage change
        if ($lastWeekViews > 0) {
            $pagesViewChange = (($thisWeekViews - $lastWeekViews) / $lastWeekViews) * 100;
        } else {
            // If there were no views last week, assume 100% increase if there are views this week, otherwise 0
            $pagesViewChange = $thisWeekViews > 0 ? 100 : 0;
        }

        $type = request()->input('type', 'all');  // Default to 'all' if not provided
        $time = request()->input('time', 'all');  // Default to 'all' if not provided

        $query = View::orderBy('id', 'desc');

        // Filter by type
        if ($type !== 'all') {
            $query->where('type', $type);
        }

        // Filter by time
        if ($time === 'today') {
            $query->whereDate('created_at', today());
        } elseif ($time === 'last 7 days') {
            $query->whereDate('created_at', '>=', now()->subDays(7));
        } elseif ($time === 'last 30 days') {
            $query->whereDate('created_at', '>=', now()->subDays(30));
        }

        // Paginate the results
        $views = $query->paginate(10);

        return view('admin.views.index', compact('totalHomeViews', 'homeViewChange', 'totalServiceViews', 'serviceViewChange', 'totalBlogViews', 'blogViewChange', 'totalPagesViews', 'pagesViewChange', 'views'));
    }

    public function subscribers() {
        $subscribers = Subscriber::orderBy('id', 'desc')->paginate(10);

        return view('admin.subscribers.index', compact('subscribers'));
    }

    public function subscriberDelete(Subscriber $subscriber) {
        $subscriber->delete();

        return redirect()->back()->with('success', 'Deleted successfully.');
    }

    public function general() {
        $settings = SiteSetting::first();

        return view('admin.settings.general', compact('settings'));
    }

    public function basic(Request $request) {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'keywords' => 'required',
            // 'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'favicon' => 'image|mimes:ico,png,jpg|max:512',
        ]);

        $data = $request->except(['_token', '_method']);
        $settings = SiteSetting::first();

        if ($request->hasFile('logo')) {
            $data['logo']  = $request->file('logo')->store('logos', 'public');

            if($settings->logo) {
                if ($settings->logo && Storage::disk('public')->exists($settings->logo)) {
                    Storage::disk('public')->delete($settings->logo);
                }
            }
        }
       
        if ($request->hasFile('favicon')) {
            $data['favicon']  = $request->file('favicon')->store('favicon', 'public');

            if($settings->favicon) {
                if ($settings->favicon && Storage::disk('public')->exists($settings->favicon)) {
                    Storage::disk('public')->delete($settings->favicon);
                }
            }
        }

        // Update the settings in the database
        $settings->update($data);

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
    
    public function contact(Request $request) {
        // $request->validate([
        //     'email' => 'required',
        //     'phone' => 'required',
        //     'address' => 'required',
        //     'url' => 'required',
        //     'longitude' => 'required',
        //     'latitude' => 'required',
        // ]);

        $data = $request->except(['_token', '_method']);
        $settings = SiteSetting::first();

        // Update the settings in the database
        $settings->update($data);

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
    
    public function api_key(Request $request) {
        $request->validate([
            'google_key' => '',
            'stripe_key' => '',
            'netopia_key' => '',
            'netopia_signature' => ''
        ]);

        $data = $request->except(['_token', '_method']);
        $settings = SiteSetting::first();

        // Update the settings in the database
        $settings->update($data);

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }

    public function socialMedia() {
        $socialMedia = SocialMedia::all();
        $socialMediaLinks = [
            'facebook' => $socialMedia->where('name', 'facebook')->first(),
            'instagram' => $socialMedia->where('name', 'instagram')->first(),
            'twitter' => $socialMedia->where('name', 'twitter')->first(),
            'youtube' => $socialMedia->where('name', 'youtube')->first(),
        ];
        // dd($socialMediaLinks);
        return view('admin.settings.social-media', compact('socialMediaLinks'));
    }

    public function socialMediaUpdate(Request $request) {
        $request->validate([
            'facebook' => 'required',
            'instagram' => 'required',
            'twitter' => 'required',
            'youtube' => 'required',
        ]);

        $data = $request->except(['_token', '_method']);

        foreach ($data as $key => $value) {
            $socialMedia = SocialMedia::where('name', $value)->first();
            if ($socialMedia) {
                $socialMedia->update([
                    'url' => $value,
                ]);
            } else {
                SocialMedia::create([
                    'name' => $key,
                    'url' => $value,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Social media links updated successfully.');
    }

    public function account() {
        $user = User::findOrFail(Auth::id());

        return view('admin.account.index', compact('user'));
    }

    public function subscription() {
        $settings = SiteSetting::first();

        $subs_sub_title = $settings->subs_sub_title;
        $subs_title = $settings->subs_title;
        $subs_desc = $settings->subs_desc;
        $subs_img = $settings->subs_img;

        return view('admin.settings.subscription', compact('settings', 'subs_sub_title', 'subs_title', 'subs_desc', 'subs_img'));
    }

    public function subs_update(Request $request) {
        $request->validate([
            'subs_sub_title.en' => 'required|string',
            'subs_sub_title.ro' => 'required|string',
            'subs_title.en' => 'required|string',
            'subs_title.ro' => 'required|string',
            'subs_desc.en' => 'required',
            'subs_desc.ro' => 'required',
        ]);

        $data = $request->all();
        $settings = SiteSetting::first();

        if($request->file('subs_img')) {
            $data['subs_img']  = $request->file('subs_img')->store('subs_img', 'public');

            if($settings->subs_img) {
                if ($settings->subs_img && Storage::disk('public')->exists($settings->subs_img)) {
                    Storage::disk('public')->delete($settings->subs_img);
                }
            }
        }

        $settings->update($data);

        return redirect()->back()->with('success', 'Updated successfully.');
    }
}
