<?php
//
//namespace App\Http\Controllers;
//
//use Illuminate\Http\Request;
//
//class PagesController extends Controller
//{
////    public function wishlist()
////    {
////        return view('wishlist');
////    }
////    public function welcome()
////    {
////        return view('welcome');
////    }
////    public function manage()
////    {
////        return view('manage');
////    }
//}


namespace App\Http\Controllers;

use App\WishListData;
use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function __construct(){
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $wishlist = WishListData::latest()->paginate(5);

        return view('welcome', compact('wishlist'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'description' => 'required',
            'price' => 'required',
            'link' => 'required',
        ]);

        WishListData::create($request->all());

        return redirect()->route('index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param WishListData $wishlist
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
        $wishlist = WishListData::find($id);
        return view('wishlist', compact('wishlist'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param WishListData $wishlist
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $wishlist = WishListData::find($id);
        return view('manage', compact('wishlist','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param WishListData $wishlist
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $wishlist = WishListData::find($id);
        $wishlist->name = request('name');
        $wishlist->image = request('image');
        $wishlist->description = request('description');
        $wishlist->price = request('price');
        $wishlist->link = request('link');
        $wishlist->save();


        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'description' => 'required',
            'price' => 'required',
            'link' => 'required',
        ]);

        $wishlist->update($request->all());

        return redirect()->route('index')
            ->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param WishListData $wishlist
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        WishListData::find($id)->delete();

        return redirect()->route('index')
            ->with('success', 'Product deleted successfully');
    }
}
