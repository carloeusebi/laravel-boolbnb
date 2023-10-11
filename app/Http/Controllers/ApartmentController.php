<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApartmentStoreRequest;
use App\Http\Requests\ApartmentUpdateRequest;
use App\Models\Apartment;
use App\Models\Service;
use App\Models\Sponsorship;
use Braintree;
use Braintree\Transaction;
use Braintree\Gateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Khill\Lavacharts\Laravel\LavachartsFacade as Lava;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $search_value = $request->query('name');

        $query = $search_value ? Apartment::orderBy('updated_at', 'DESC')->where('name', 'LIKE', "%$search_value%") : Apartment::orderBy('updated_at', 'DESC');

        $apartments = $query->where('user_id', $user->id)->get();

        return view('admin.apartments.index', compact('apartments', 'search_value'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $apartment = new Apartment();

        //Include services table in form
        $services = Service::select('id', 'name', 'icon')->get();
        $apartment_service_ids = $apartment->services->pluck('id')->toArray();

        return view('admin.apartments.create', compact('apartment', 'services', 'apartment_service_ids'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ApartmentStoreRequest $request)
    {
        $data =  $request->all();

        $apartment = new Apartment();

        $thumbnail = $request->file('thumbnail');
        if ($thumbnail)
            $data['thumbnail'] = $this->saveImage($thumbnail);

        $apartment->fill($data);

        // Assign the user ID to the apartment
        $apartment->user_id = Auth::user()->id;

        // Create slug from apartment's name

        $isUniqueSlug = false;
        $slug = '';
        $i = 1;
        do {
            $slug = Str::slug($apartment->name, '-');
            if ($i > 1) $slug .= "-$i";
            $isUniqueSlug = Apartment::where('slug', $slug)->get()->count() === 0;
            $i++;
        } while (!$isUniqueSlug);

        $apartment->slug = $slug;

        $apartment->save();

        //Assign service to the apartment if it's checked
        if (array_key_exists('services', $data)) $apartment->services()->attach($data['services']);

        return to_route('admin.apartments.show', $apartment);
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {
        /**
         * @var User
         */
        $user = Auth::user();
        if ($user->cannot('view', $apartment)) abort(403);

        $sponsorships = Sponsorship::all();

        $visits = Lava::DataTable();
        $visits->addDateColumn('Data');
        $visits->addNumberColumn('visits');

        $visitLogs = $apartment->visits->sortBy('date');
        $visitsPerDay = [];

        foreach ($visitLogs as $visit) {
            $dailyVisits = $visitsPerDay[$visit->date] ?? 0;
            $visitsPerDay[$visit->date] = $dailyVisits + 1;
        }

        foreach ($visitsPerDay as $day => $numberOfVisits) {
            $visits->addRow([$day, $numberOfVisits]);
        }

        Lava::ColumnChart('Visits', $visits, ['title' => 'Visite']);

        return view('admin.apartments.show', compact('apartment', 'sponsorships'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment)
    {
        /**
         * @var user
         */
        $user = Auth::user();
        if ($user->cannot('update', $apartment)) abort(403);

        //Include services table in form
        $services = Service::select('id', 'name', 'icon')->get();
        $apartment_service_ids = $apartment->services->pluck('id')->toArray();

        return view('admin.apartments.edit', compact('apartment', 'services', 'apartment_service_ids'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ApartmentUpdateRequest $request, Apartment $apartment)
    {
        /**
         * @var user
         */
        $user = Auth::user();
        if ($user->cannot('update', $apartment)) abort(403);

        $data = $request->all();

        // Assign the user ID to the apartment
        $apartment->user_id = Auth::user()->id;

        // IMAGE UPLOAD
        $thumbnail = $request->file('thumbnail');
        if ($thumbnail) {

            // if there was an old thumbnail delete it
            if ($apartment->thumbnail) {
                Storage::delete($apartment->thumbnail);
            }

            $data['thumbnail'] = $this->saveImage($thumbnail);
        }

        // Create slug from apartment's name
        $apartment->update($data);

        // If a service is toggle add/remove from apartment
        if (count($apartment->services) && !array_key_exists('services', $data)) $apartment->services()->detach();
        elseif (array_key_exists('services', $data)) $apartment->services()->sync($data['services']);

        return to_route('admin.apartments.show', $apartment);
    }

    /**
     * Display a listing of the deleted resource.
     */
    public function trash()
    {
        $apartments = Apartment::onlyTrashed()->where('user_id', Auth::user()->id)->get();
        return view('admin.apartments.trash', compact('apartments'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {
        /**
         * @var user
         */
        $user = Auth::user();
        if ($user->cannot('delete', $apartment)) abort(403);

        $apartment->delete();
        return to_route('admin.apartments.index');
    }

    public function drop(string $id)
    {
        $apartment = Apartment::onlyTrashed()->findOrFail($id);

        /**
         * @var user
         */
        $user = Auth::user();
        if ($user->cannot('update', $apartment)) abort(403);

        $apartment->forceDelete();

        return to_route('admin.apartments.trash');
    }

    public function restore(string $id)
    {
        $apartment = Apartment::onlyTrashed()->findOrFail($id);

        /**
         * @var user
         */
        $user = Auth::user();
        if ($user->cannot('update', $apartment)) abort(403);

        $apartment->restore();
        return to_route('admin.apartments.trash');
    }

    public function dropAll()
    {
        Apartment::onlyTrashed()->where('user_id', Auth::user()->id)->forceDelete();
        return to_route('admin.apartments.trash');
    }

    public function restoreAll()
    {
        Apartment::onlyTrashed()->where('user_id', Auth::user()->id)->restore();
        return to_route('admin.apartments.trash');
    }

    /**
     * Saves the image in the public folder `images`
     * 
     * @return string The pat of the saved image.
     */
    private function saveImage($image)
    {
        return Storage::put('images', $image);
    }

    /**
     * Show the form for the payment of the sponsorship
     */
    public function payment(Apartment $apartment, Request $request)
    {
        /**
         * @var user
         */
        $user = Auth::user();
        if ($user->cannot('pay', $apartment)) abort(403);


        $apartment_sponsorship_ids = $apartment->sponsorships->pluck('id')->toArray();

        $gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY')
        ]);

        if ($request->input('nonce')) {
            $sponsorship = Sponsorship::find($request->sponsorship);
            $nonceFromTheClient = $request->nonce;

            $result = $gateway->transaction()->sale([
                'amount' => $sponsorship->price,
                'paymentMethodNonce' => $nonceFromTheClient
            ]);

            if ($result->success) {
                return view('admin.apartments.index')
                    ->with('alert-message', 'Pagamento avvenuto con successo!')
                    ->with('alert-type', 'success');;
            }
        }

        $token = $gateway->clientToken()->generate();

        return view('admin.apartments.payment', compact('token'));
    }
}
