<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Store;
use App\Models\Category;
use App\Models\Events;
use App\Models\Page;
use App\Models\Newsletter;
use App\Helpers\SettingsHelper;

class FrontendController extends Controller
{
    public function home()
    {
        // Load featured coupons for home page
        $featuredCoupons = Coupon::with('store')
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

        // Load featured categories with store counts for home page
        $categories = Category::withCount(['stores' => function($query) {
            $query->where('status', 1);
        }])
        ->where('status', 1)
        ->where('featured', 1)
        ->orderBy('sort_order', 'asc')
        ->take(8)
        ->get();

        // Load categories with "Show Home" selected and their coupons for Category Deals section
        $homeCategories = Category::where('status', 1)
            ->where('show_home', 1)
            ->orderBy('sort_order', 'asc')
            ->get()
            ->map(function($category) {
                // Load coupons for stores in this category
                $category->coupons = Coupon::whereHas('store', function($query) use ($category) {
                    $query->whereHas('categories', function($q) use ($category) {
                        $q->where('category_id', $category->id);
                    });
                })
                ->where('status', 1)
                ->orderBy('sort_order', 'asc')
                ->take(6)
                ->get();
                
                return $category;
            });

        // Load recommended categories with their stores for Recommended Stores section
        $recommendedCategories = Category::where('status', 1)
            ->where('recommended', 1)
            ->orderBy('sort_order', 'asc')
            ->take(4)
            ->get()
            ->map(function($category) {
                // Load stores in this category
                $category->stores = Store::whereHas('categories', function($query) use ($category) {
                    $query->where('category_id', $category->id);
                })
                ->where('status', 1)
                ->orderBy('sort_order', 'asc')
                ->take(6)
                ->get();
                
                return $category;
            });

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
            'homeCategories',
            'recommendedCategories',
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
        // Load all categories with store counts - sorted alphabetically
        $categories = Category::withCount(['stores' => function($query) {
            $query->where('status', 1);
        }])
        ->where('status', 1)
        ->orderBy('category_name', 'asc') // ABC order
        ->get();

        // Load stores for each category
        foreach ($categories as $category) {
            // All stores for text links - organized in columns, sorted alphabetically
            $category->brands = Store::whereHas('categories', function($query) use ($category) {
                $query->where('category_id', $category->id);
            })
            ->where('status', 1)
            ->orderBy('store_name', 'asc') // ABC order for stores
            ->get();
        }

        // Get settings for dynamic colors
        $settings = SettingsHelper::getBranding();

        return view('frontend.categories', compact('categories', 'settings'));
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

    public function eventDetail($slug)
    {
        // Load event by slug
        $event = Events::where('seo_url', $slug)
            ->where('status', 1)
            ->firstOrFail();

        // Load stores associated with this event
        $eventStores = $event->stores()->where('status', 1)->get();

        // Load coupons for this event
        $eventCoupons = Coupon::where('event_id', $event->id)
            ->where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->get();

        // Load related events (same type or similar)
        $relatedEvents = Events::where('event_type', $event->event_type)
            ->where('id', '!=', $event->id)
            ->where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->take(6)
            ->get();

        return view('frontend.event-detail', compact(
            'event', 
            'eventStores', 
            'eventCoupons', 
            'relatedEvents'
        ));
    }

    public function contact()
    {
        // Get settings for dynamic colors
        $settings = SettingsHelper::getBranding();
        
        return view('frontend.contact', compact('settings'));
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        // Create contact submission
        \App\Models\Contact::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'new'
        ]);

        return back()->with('success', 'Thank you for your message! We will get back to you soon.');
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
        // Get settings for dynamic colors
        $settings = SettingsHelper::getBranding();
        
        return view('frontend.about-us', compact('settings'));
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
        // Get settings for dynamic colors
        $settings = SettingsHelper::getBranding();
        
        return view('frontend.privacy-policy', compact('settings'));
    }

    public function blog()
    {
        // Load published blog posts
        $blogs = \App\Models\Blog::published()
            ->ordered()
            ->paginate(6);
        
        // Get settings for dynamic colors
        $settings = SettingsHelper::getBranding();
        
        return view('frontend.blog', compact('blogs', 'settings'));
    }

    public function blogShow($slug)
    {
        $blog = \App\Models\Blog::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();
        
        // Get settings for dynamic colors
        $settings = SettingsHelper::getBranding();
        
        return view('frontend.blog-single', compact('blog', 'settings'));
    }

    public function blogView($slug)
    {
        $blog = \App\Models\Blog::where('slug', $slug)->first();
        if ($blog) {
            $blog->increment('views_count');
        }
        return response()->json(['success' => true]);
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
        // Load category by seo_url
        $category = Category::where('seo_url', $slug)
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

        // Load related categories
        $relatedCategories = Category::where('status', 1)
            ->where('id', '!=', $category->id)
            ->orderBy('sort_order', 'asc')
            ->take(6)
            ->get();

        // Load trending stores for sidebar
        $trendingStores = Store::where('show_trending', 1)
            ->where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->take(30)
            ->get();

        return view('frontend.single_category', compact('category', 'stores', 'categoryCoupons', 'relatedCategories', 'trendingStores'));
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
        $stores = Store::where('status', 1)
            ->where(function($q) use ($query) {
                $q->where('store_name', 'like', "%{$query}%")
                  ->orWhere('content', 'like', "%{$query}%");
            })
            ->orderBy('sort_order', 'asc')
            ->paginate(20);

        // Search in coupons
        $coupons = Coupon::where('status', 1)
            ->where(function($q) use ($query) {
                $q->where('coupon_title', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->orderBy('sort_order', 'asc')
            ->paginate(20);

        // Search in categories
        $categories = Category::where('category_name', 'like', "%{$query}%")
            ->where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('frontend.search', compact('query', 'stores', 'coupons', 'categories'));
    }

    public function getHeaderSearchDefault(Request $request)
    {
        // Return default search data for the header search overlay
        $featuredCoupons = Coupon::with('store')
            ->where('status', 1)
            ->where('featured', 1)
            ->orderBy('sort_order', 'asc')
            ->take(6)
            ->get();

        // If no featured coupons, get some regular coupons
        if ($featuredCoupons->isEmpty()) {
            $featuredCoupons = Coupon::with('store')
                ->where('status', 1)
                ->orderBy('sort_order', 'asc')
                ->take(6)
                ->get();
        }

        $trendingStores = Store::where('show_trending', 1)
            ->where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->take(8)
            ->get();

        // If no trending stores, get some regular stores
        if ($trendingStores->isEmpty()) {
            $trendingStores = Store::where('status', 1)
                ->orderBy('sort_order', 'asc')
                ->take(8)
                ->get();
        }

        $featuredCategories = Category::where('status', 1)
            ->where('featured', 1)
            ->orderBy('sort_order', 'asc')
            ->take(6)
            ->get();

        // If no featured categories, get some regular categories
        if ($featuredCategories->isEmpty()) {
            $featuredCategories = Category::where('status', 1)
                ->orderBy('sort_order', 'asc')
                ->take(6)
                ->get();
        }

        return response()->json([
            'coupons' => $featuredCoupons,
            'stores' => $trendingStores,
            'categories' => $featuredCategories
        ]);
    }

    public function ajaxSearch(Request $request)
    {
        $query = $request->get('q');
        
        if (!$query || strlen($query) < 2) {
            return response()->json([
                'stores' => [],
                'coupons' => [],
                'categories' => [],
                'message' => 'Please enter at least 2 characters',
                'total_results' => 0
            ]);
        }

        // Search in stores
        $stores = Store::where('status', 1)
            ->where(function($q) use ($query) {
                $q->where('store_name', 'like', "%{$query}%")
                  ->orWhere('content', 'like', "%{$query}%");
            })
            ->orderBy('sort_order', 'asc')
            ->take(10)
            ->get();

        // Search in coupons with store relationship
        $coupons = Coupon::with('store')
            ->where('status', 1)
            ->where(function($q) use ($query) {
                $q->where('coupon_title', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%")
                  ->orWhere('brand_store', 'like', "%{$query}%");
            })
            ->orderBy('sort_order', 'asc')
            ->take(10)
            ->get();

        // Search in categories
        $categories = Category::where('status', 1)
            ->where('category_name', 'like', "%{$query}%")
            ->orderBy('sort_order', 'asc')
            ->take(10)
            ->get();

        return response()->json([
            'stores' => $stores,
            'coupons' => $coupons,
            'categories' => $categories,
            'query' => $query,
            'total_results' => $stores->count() + $coupons->count() + $categories->count()
        ]);
    }

    public function testSearch($query)
    {
        // Test search functionality
        $stores = Store::where('status', 1)
            ->where(function($q) use ($query) {
                $q->where('store_name', 'like', "%{$query}%")
                  ->orWhere('content', 'like', "%{$query}%");
            })
            ->orderBy('sort_order', 'asc')
            ->take(10)
            ->get();

        $coupons = Coupon::with('store')
            ->where('status', 1)
            ->where(function($q) use ($query) {
                $q->where('coupon_title', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%")
                  ->orWhere('brand_store', 'like', "%{$query}%");
            })
            ->orderBy('sort_order', 'asc')
            ->take(10)
            ->get();

        return response()->json([
            'query' => $query,
            'stores_count' => $stores->count(),
            'coupons_count' => $coupons->count(),
            'stores' => $stores->pluck('store_name'),
            'coupons' => $coupons->pluck('coupon_title'),
            'debug' => [
                'total_stores' => Store::where('status', 1)->count(),
                'total_coupons' => Coupon::where('status', 1)->count(),
                'search_query' => $query
            ]
        ]);
    }

    public function newsletterSubscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email'
        ]);

        try {
            Newsletter::create([
                'email' => $request->email,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'is_active' => true,
                'subscribed_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Thank you for subscribing to our newsletter!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again.'
            ], 500);
        }
    }

    public function adminNewsletters(Request $request)
    {
        $newsletters = Newsletter::orderBy('created_at', 'desc')->paginate(15);
        
        return view('admin.newsletters.index', compact('newsletters'));
    }

    public function adminNewsletterDelete(Newsletter $newsletter)
    {
        $newsletter->delete();
        
        return redirect()->route('admin.newsletters.index')
                        ->with('success', 'Newsletter subscriber deleted successfully!');
    }

    public function adminNewsletterBulkDelete(Request $request)
    {
        $request->validate([
            'newsletter_ids' => 'required|array|min:1',
            'newsletter_ids.*' => 'exists:newsletters,id',
        ]);

        Newsletter::whereIn('id', $request->newsletter_ids)->delete();

        return redirect()->route('admin.newsletters.index')
                        ->with('success', 'Selected newsletter subscribers deleted successfully!');
    }
}
