<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Page;
use App\Models\Post;
use App\Models\View;
use App\Models\Review;
use App\Models\Service;
use App\Models\Category;
use App\ViewLoggerTrait;
use App\Models\Promotion;
use App\Models\SiteSetting;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use App\Models\HomepageContent;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\DependencyInjection\ServicesResetter;

class PageController extends Controller
{
    use ViewLoggerTrait;

    public function changeLang(Request $request)
    {
        App::setLocale($request->lang);
        session()->put('lang', $request->lang);

        return redirect()->back();
    }

    public function home()
    {
        $header = HomepageContent::where('section', 'header')->first();
        $overview = HomepageContent::where('section', 'overview')->first();
        $why_choose_us = HomepageContent::where('section', 'why_choose_us')->first();

        $key_features = HomepageContent::where('type', 'key_features')->get();
        $promotions = Promotion::orderBy('id', 'desc')->get();
        
        $reviews = Review::where('is_approved', true)->get();
        $blogs = Post::where('status', 'published')->orderBy('id', 'desc')->limit(3)->get();

        $featured_services_id = HomepageContent::where('section', 'featured_services')->first();
        $decoded = json_decode($featured_services_id->data, true);
        $values = array_values($decoded);
        $featured_services = Service::whereIn('id', $values)->withAvg('reviews', 'rating')->get();

        $instas = HomepageContent::where('type', 'insta')->orderBy('id', 'desc')->get();

        $this->storeViewData('home', 'page');

        $homepage = HomepageContent::where('section', 'header')->first();
        $datePublished = $homepage->created_at->format('Y-m-d\TH:i:sP');
        $dateModified = $homepage->updated_at->format('Y-m-d\TH:i:sP');
        $homepageImg = asset('/storage/' . $homepage->image);

        $site_settings = SiteSetting::first();
        $pageName = "Home - " . $site_settings->title;
        $keywords = $site_settings->keywords;
        $description = $site_settings->description;
        $logo = asset('/storage/' . $site_settings->logo);

        $instaLink = SocialMedia::where('name', 'instagram')->first();

        return view('pages.index', compact(
            'header',
            'overview',
            'why_choose_us',
            'key_features',
            'promotions',
            'reviews',
            'blogs',
            'featured_services',
            'instas',
            'datePublished',
            'dateModified',
            'pageName',
            'homepageImg',
            'pageName',
            'keywords',
            'description',
            'logo',
            'instaLink'
        ));
    }

    public function services(Request $request)
    {
        $services = Service::query()
            ->where('status', 'published')
            ->withAvg('reviews', 'rating');

        // Category filter
        $categoryName = null;
        if ($request->has('category') && $request->category) {
            $services->where('category_id', $request->category);

            // Get category name (assuming you have a Category model)
            $category = Category::find($request->category);
            $categoryName = $category ? $category : null;
        }

        // Keyword search
        $keyword = null;
        if ($request->has('keyword') && $request->keyword) {
            $keyword = $request->keyword;
            $keywordLower = strtolower($keyword);

            $services->where(function ($query) use ($keywordLower) {
                $query->whereRaw('LOWER(JSON_UNQUOTE(JSON_EXTRACT(name, "$.en"))) LIKE ?', ['%' . $keywordLower . '%'])
                    ->orWhereRaw('LOWER(JSON_UNQUOTE(JSON_EXTRACT(name, "$.ro"))) LIKE ?', ['%' . $keywordLower . '%'])
                    ->orWhereRaw('LOWER(description) LIKE ?', ['%' . $keywordLower . '%']);
            });
        }

        // Get paginated results
        $services = $services->paginate(10);

        $categories = Category::get();

        $this->storeViewData('services', 'page');

        $site_settings = SiteSetting::first();
        $keywords = $site_settings->keywords;
        $datePublished = $site_settings->created_at->format('Y-m-d\TH:i:sP');
        $description = $site_settings->description;

        return view('pages.services', compact('services', 'categories', 'keyword', 'categoryName', 'keywords', 'datePublished', 'description'));
    }

    public function service(Service $service)
    {
        $faqs = Faq::where('service_id', $service->id)->get();
        $similerServices = Service::where('category_id', $service->category_id)
            ->where('id', '!=', $service->id)->where('status', 'published')
            ->withAvg('reviews', 'rating')->get();

        $ratingsData = Review::where('service_id', $service->id)->where('is_approved', true)->selectRaw('rating, COUNT(*) as count')
            ->groupBy('rating')
            ->orderBy('rating', 'desc')
            ->pluck('count', 'rating')
            ->toArray();

        $totalReviews = array_sum($ratingsData);
        $totalRatingSum = 0;

        // Ensure all ratings (1-5) exist and calculate total rating sum
        $ratings = [];
        for ($i = 5; $i >= 1; $i--) {
            $count = $ratingsData[$i] ?? 0;
            $ratings[] = [
                'rating' => $i,
                'count' => $count,
                'percentage' => $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0
            ];
            $totalRatingSum += $i * $count;
        }

        // Calculate average rating
        $averageRating = $totalReviews > 0 ? round($totalRatingSum / $totalReviews, 1) : 0;

        $this->storeViewData(null, 'service', $service->id);
        $service->quantity = 1;
        
        return view('pages.service-details', compact('service', 'faqs', 'similerServices', 'ratings', 'totalReviews', 'averageRating', 'ratingsData'));
    }

    public function blogs()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(10);

        $this->storeViewData('blogs', 'page');

        $site_settings = SiteSetting::first();
        $keywords = $site_settings->keywords;
        $datePublished = $site_settings->created_at->format('Y-m-d\TH:i:sP');

        return view('pages.blogs', compact('posts', 'keywords', 'datePublished'));
    }


    public function post(Post $post)
    {
        $post->update(['views' => (int)$post->views + 1]);
        $this->storeViewData(null, 'post', null, $post->id);
        return view('pages.post', compact('post'));
    }

    public function about()
    {
        $page = Page::where('slug', 'about')->first();

        $this->storeViewData('about', 'page');

        return view('pages.about', compact('page'));
    }

    public function termsConditions()
    {
        $page = Page::where('slug', 'terms-conditions')->first();

        $this->storeViewData('terms-conditions', 'page');

        return view('pages.terms-conditions', compact('page'));
    }

    public function contact()
    {
        $this->storeViewData('contact', 'page');

        $site_settings = SiteSetting::first();
        $keywords = $site_settings->keywords;
        $datePublished = $site_settings->created_at->format('Y-m-d\TH:i:sP');
        $dateModified = $site_settings->updated_at->format('Y-m-d\TH:i:sP');

        $location = $site_settings->street.', '. $site_settings->city.', '.$site_settings->country;
        $phone = $site_settings->phone;
        $email = $site_settings->email;

        return view('pages.contact', compact('keywords', 'datePublished', 'dateModified', 'location', 'phone', 'email'));
    }

    public function refundPolicy()
    {
        $page = Page::where('slug', 'refund-policy')->first();
        $this->storeViewData('refund-policy', 'page');

        return view('pages.refund-policy', compact('page'));
    }
}
