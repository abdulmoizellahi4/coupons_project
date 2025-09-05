<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Store;
use App\Models\Category;
use App\Models\Events;
use App\Models\Page;

class FrontendController extends Controller
{
    public function home()
    {
        // Load featured coupons for home page
        $featuredCoupons = Coupon::where('featured', 1)
            ->where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->take(8)
            ->get();

        // Load featured stores
        $featuredStores = Store::where('featured', 1)
            ->where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->take(10)
            ->get();

        // Load trending stores
        $trendingStores = Store::where('show_trending', 1)
            ->where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->take(20)
            ->get();

        // Load categories with store counts
        $categories = Category::withCount(['stores' => function($query) {
            $query->where('status', 1);
        }])
        ->where('status', 1)
        ->orderBy('sort_order', 'asc')
        ->take(8)
        ->get();

        // Load active events
        $activeEvents = Events::where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->get();

        // Get statistics
        $totalCoupons = Coupon::where('status', 1)->count();
        $totalStores = Store::where('status', 1)->count();
        $totalCategories = Category::where('status', 1)->count();

        return view('frontend.home.index', compact(
            'featuredCoupons',
            'featuredStores', 
            'trendingStores',
            'categories',
            'activeEvents',
            'totalCoupons',
            'totalStores',
            'totalCategories'
        ));
    }

    public function topDiscounts()
    {
        // Load exclusive coupons only
        $topCoupons = Coupon::with('store')
            ->where('status', 1)
            ->where('exclusive', 1)
            ->where('verified', 1)
            ->orderBy('sort_order', 'asc')
            ->take(20)
            ->get();

        // Load trending stores for sidebar
        $trendingStores = Store::where('show_trending', 1)
            ->where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->take(20)
            ->get();

        return view('frontend.top-discounts', compact('topCoupons', 'trendingStores'));
    }

    public function categories()
    {
        // Load all categories with store counts
        $categories = Category::withCount(['stores' => function($query) {
            $query->where('status', 1);
        }])
        ->where('status', 1)
        ->orderBy('sort_order', 'asc')
        ->get();

        // Group stores by category
        $storesByCategory = [];
        foreach ($categories as $category) {
            $storesByCategory[$category->id] = Store::whereHas('categories', function($query) use ($category) {
                $query->where('category_id', $category->id);
            })
            ->where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->take(4)
            ->get();
        }

        return view('frontend.categories', compact('categories', 'storesByCategory'));
    }

    public function events()
    {
        // Load all active events
        $events = Events::where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->get();

        // Load coupons for each event
        $eventCoupons = [];
        foreach ($events as $event) {
            $eventCoupons[$event->id] = Coupon::where('event_id', $event->id)
                ->where('status', 1)
                ->orderBy('sort_order', 'asc')
                ->take(6)
                ->get();
        }

        return view('frontend.events', compact('events', 'eventCoupons'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function mobileApp()
    {
        return view('frontend.mobile-app');
    }

    public function share()
    {
        return view('frontend.share');
    }

    public function dealSeeker()
    {
        return view('frontend.deal-seeker');
    }

    public function smashVoucherCodes()
    {
        // Load inspiring/trending coupons
        $inspiringCoupons = Coupon::where('status', 1)
            ->where('featured', 1)
            ->orderBy('sort_order', 'asc')
            ->take(12)
            ->get();

        return view('frontend.smash-voucher-codes', compact('inspiringCoupons'));
    }

    public function studentDiscount()
    {
        // Load student-specific offers
        $studentCoupons = Coupon::where('status', 1)
            ->where('coupon_title', 'like', '%student%')
            ->orWhere('description', 'like', '%student%')
            ->orderBy('sort_order', 'asc')
            ->take(15)
            ->get();

        return view('frontend.student-discount', compact('studentCoupons'));
    }

    public function blackFridayDeals()
    {
        // Load Black Friday event and coupons
        $blackFridayEvent = Events::where('event_name', 'like', '%black friday%')
            ->where('status', 1)
            ->first();

        $blackFridayCoupons = [];
        if ($blackFridayEvent) {
            $blackFridayCoupons = Coupon::where('event_id', $blackFridayEvent->id)
                ->where('status', 1)
                ->orderBy('sort_order', 'asc')
                ->take(20)
                ->get();
        }

        return view('frontend.black-friday-deals', compact('blackFridayCoupons', 'blackFridayEvent'));
    }

    public function cyberMondayVoucherCodes()
    {
        // Load Cyber Monday event and coupons
        $cyberMondayEvent = Events::where('event_name', 'like', '%cyber monday%')
            ->where('status', 1)
            ->first();

        $cyberMondayCoupons = [];
        if ($cyberMondayEvent) {
            $cyberMondayCoupons = Coupon::where('event_id', $cyberMondayEvent->id)
                ->where('status', 1)
                ->orderBy('sort_order', 'asc')
                ->take(20)
                ->get();
        }

        return view('frontend.cyber-monday-voucher-codes', compact('cyberMondayCoupons', 'cyberMondayEvent'));
    }

    public function christmasDealsOnline()
    {
        // Load Christmas event and coupons
        $christmasEvent = Events::where('event_name', 'like', '%christmas%')
            ->where('status', 1)
            ->first();

        $christmasCoupons = [];
        if ($christmasEvent) {
            $christmasCoupons = Coupon::where('event_id', $christmasEvent->id)
                ->where('status', 1)
                ->orderBy('sort_order', 'asc')
                ->take(20)
                ->get();
        }

        return view('frontend.christmas-deals-online', compact('christmasCoupons', 'christmasEvent'));
    }

    public function aboutUs()
    {
        // Load about us page content from admin
        $aboutPage = Page::where('page_slug', 'about-us')
            ->where('status', 1)
            ->first();

        return view('frontend.about-us', compact('aboutPage'));
    }

    public function advertiseWithUs()
    {
        // Load advertise page content from admin
        $advertisePage = Page::where('page_slug', 'advertise-with-us')
            ->where('status', 1)
            ->first();

        return view('frontend.advertise-with-us', compact('advertisePage'));
    }

    public function privacyPolicy()
    {
        // Load privacy policy page content from admin
        $privacyPage = Page::where('page_slug', 'privacy-policy')
            ->where('status', 1)
            ->first();

        return view('frontend.privacy-policy', compact('privacyPage'));
    }

    public function blog()
    {
        // Load blog posts from admin (if you have a blog system)
        return view('frontend.blog');
    }

    public function allBrandsUk(Request $request)
    {
        $query = $request->get('q');
        
        // If no query parameter, show all stores grouped by alphabet
        if (!$query) {
            $allStores = Store::where('status', 1)
                ->orderBy('store_name', 'asc')
                ->get();
            
            // Group stores by first letter
            $storesByLetter = $allStores->groupBy(function($store) {
                $firstLetter = strtoupper(substr($store->store_name, 0, 1));
                // Group numbers together
                if (is_numeric($firstLetter)) {
                    return '0-9';
                }
                return $firstLetter;
            });
            
            return view('frontend.all-brands', compact('storesByLetter', 'query'));
        }
        
        // Load stores filtered by alphabet
        $storesQuery = Store::where('status', 1);
        
        // Filter by alphabet if query parameter exists
        if ($query && $query !== '0-9') {
            $storesQuery->where('store_name', 'like', $query . '%');
        } elseif ($query === '0-9') {
            $storesQuery->whereRaw('store_name REGEXP "^[0-9]"');
        }
        
        $stores = $storesQuery->orderBy('store_name', 'asc')->get();

        return view('frontend.all-brands', compact('stores', 'query'));
    }

    public function contactDetails()
    {
        // Load contact page content from admin
        $contactPage = Page::where('page_slug', 'contact-us')
            ->where('status', 1)
            ->first();

        return view('frontend.contact-details', compact('contactPage'));
    }

    public function category($slug)
    {
        // Load category by slug
        $category = Category::where('category_slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        // Load stores in this category
        $stores = Store::whereHas('categories', function($query) use ($category) {
            $query->where('category_id', $category->id);
        })
        ->where('status', 1)
        ->orderBy('sort_order', 'asc')
        ->paginate(20);

        // Load coupons for stores in this category
        $categoryCoupons = Coupon::whereHas('store', function($query) use ($category) {
            $query->whereHas('categories', function($q) use ($category) {
                $q->where('category_id', $category->id);
            });
        })
        ->where('status', 1)
        ->orderBy('sort_order', 'asc')
        ->take(12)
        ->get();

        return view('frontend.category', compact('category', 'stores', 'categoryCoupons'));
    }

    public function store($slug)
    {
        // Load store by slug
        $store = Store::where('seo_url', $slug)
            ->where('status', 1)
            ->firstOrFail();

        // Load store's categories
        $storeCategories = $store->categories()->where('status', 1)->get();

        // Load store's events
        $storeEvents = $store->events()->where('status', 1)->get();

        // Load coupons for this store
        $storeCoupons = Coupon::where('brand_store', $store->store_name)
            ->where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->get();

        // Load related stores
        $relatedStores = Store::whereHas('categories', function($query) use ($store) {
            $query->whereIn('category_id', $store->categories->pluck('id'));
        })
        ->where('id', '!=', $store->id)
        ->where('status', 1)
        ->orderBy('sort_order', 'asc')
        ->take(6)
        ->get();

        return view('frontend.store', compact(
            'store', 
            'storeCategories', 
            'storeEvents', 
            'storeCoupons', 
            'relatedStores'
        ));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        
        if (!$query) {
            return redirect()->route('home');
        }

        // Search in stores
        $stores = Store::where('store_name', 'like', "%{$query}%")
            ->orWhere('content', 'like', "%{$query}%")
            ->where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->paginate(20);

        // Search in coupons
        $coupons = Coupon::where('coupon_title', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->paginate(20);

        // Search in categories
        $categories = Category::where('category_name', 'like', "%{$query}%")
            ->where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('frontend.search', compact('query', 'stores', 'coupons', 'categories'));
    }

    public function newsletterSubscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletter_subscribers,email'
        ]);

        // Here you would typically save to a newsletter_subscribers table
        // For now, we'll just return a success message
        
        return back()->with('success', 'Thank you for subscribing to our newsletter!');
    }
}
