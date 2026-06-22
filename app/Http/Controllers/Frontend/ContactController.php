<?php

namespace App\Http\Controllers\Frontend;

use App\DTOs\Branch\BranchData;
use App\Events\ContactFormSubmissionCreated;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\ContactFormSubmission;
use App\Notifications\User\ContactUsNotification;
use App\Settings\ImageSettings;
use App\Settings\SeoSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $branches = BranchData::collection(Branch::all());

        $seoSettings = app(SeoSettings::class);
        $imageSettings = app(ImageSettings::class);

        seo()
            ->title($seoSettings->contact_title)
            ->description($seoSettings->contact_description)
            ->url($request->fullUrl());

        // Get hero banner images with fallback to default images
        $heroImage = $imageSettings->contact_hero
            ? url(Storage::url($imageSettings->contact_hero))
            : url(Storage::url('default_images/contact_hero.webp'));
        $heroImageMobile = $imageSettings->contact_hero_mobile
            ? url(Storage::url($imageSettings->contact_hero_mobile))
            : url(Storage::url('default_images/contact_hero_mobile.webp'));

        return view('frontend.pages.contact.index', [
            'branches' => $branches,
            'heroImage' => $heroImage,
            'heroImageMobile' => $heroImageMobile,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'message' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            $contactForm = ContactFormSubmission::create($request->only([
                'name',
                'phone',
                'email',
                'message',
            ]));

            ContactFormSubmissionCreated::dispatch($contactForm);

            Notification::route('mail', $request->email)
                ->notify(new ContactUsNotification($contactForm));

            DB::commit();

            return redirect()->route('contact.index')->with('success', 'Mesajınızı aldık! En kısa sürede size geri dönüş sağlayacağız.');
        } catch (\Exception $e) {
            DB::rollBack();

            flash()->addError('Bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.', 'Hata!');

            return redirect()->route('contact.index');
        }

    }
}
