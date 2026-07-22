<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Banner;
use App\Models\Career;
use App\Models\Office;
use App\Models\Post;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ViewController extends Controller
{
    public function index()
    {
        $banner = Banner::first();
        $about = About::first();
        $offices = Office::orderBy('created_at', 'asc')->limit(4)->get();
        $posts = Post::where('type', '!=', 'rapport')->limit(3)->get();
        $testimonials = Testimonial::all();

        return view('apps.pages.home', compact('banner', 'about', 'offices', 'posts', 'testimonials'));
    }

    public function office()
    {
        $offices = Office::orderBy('created_at', 'asc')->get();
        $reports = Post::where('type', 'rapport')->paginate(6);

        return view('apps.pages.office', compact('offices', 'reports'));
    }

    public function about()
    {
        $events = Post::where('type', 'event')->paginate(6);

        return view('apps.pages.about', compact('events'));
    }

    public function jobs()
    {
        $careers = Career::paginate(9);

        return view('apps.pages.jobs', compact('careers'));
    }

    public function job($id)
    {
        $career = Career::find($id);

        return view('apps.pages.job', compact('career'));
    }

    public function posts()
    {
        $posts = Post::where('type', '!=', 'event')->paginate(9);

        return view('apps.pages.posts', compact('posts'));
    }

    public function post($id)
    {
        $post = Post::find($id);

        return view('apps.pages.post', compact('post'));
    }

    public function contacts()
    {
        return view('apps.pages.contacts');
    }

    public function membershipStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lastname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'enterprise' => 'nullable|string|max:255',
            'phone' => 'required|string|min:13',
            'email' => 'required|email|max:255',
        ], [
            'lastname.required' => 'Le nom est requis.',
            'lastname.string' => 'Le nom doit être une chaîne de caractères.',
            'lastname.max' => 'Le nom ne doit pas dépasser 255 caractères.',

            'firstname.required' => 'Le prénom complet est requis.',
            'firstname.string' => 'Le prénom complet doit être une chaîne de caractères.',
            'firstname.max' => 'Le prénom complet ne doit pas dépasser 255 caractères.',

            'enterprise.required' => 'Le nom d\'entreprise est requis.',
            'enterprise.max' => 'Le nom d\'entreprise doit être une chaîne de caractères.',

            'phone.required' => 'Le numéro de téléphone du message est requis.',
            'phone.string' => 'Le numéro de téléphone doit être une chaîne de caractères.',
            'phone.min' => 'Le numéro de téléphone ne doit pas être en dessous de 13 chiffres.',

            'email.required' => 'L’adresse e-mail est requise.',
            'email.email' => 'Veuillez fournir une adresse e-mail valide.',
            'email.max' => 'L’adresse e-mail ne doit pas dépasser 255 caractères.',


        ]);

        if ($validator->fails()) {
            $firstErrorMessage = $validator->errors()->first();
            return redirect()->back()
                ->with('error', $firstErrorMessage);
        }

        // TODO: Réactiver l'envoi email quand le SMTP sera configuré
        // Mail::to('hello@kksmartcom.com')->send(new MembershipMail($request->all()));

        return redirect()->back()->with('success', 'Votre demande d\'adhésion a été envoyé avec succès ! Un retour vous sera fait à l\'adresse email indiqué.');
    }

    public function contactStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'object' => 'required|string|max:255',
            'message' => 'required|string',
        ], [
            'email.required' => 'L’adresse e-mail est requise.',
            'email.email' => 'Veuillez fournir une adresse e-mail valide.',
            'email.max' => 'L’adresse e-mail ne doit pas dépasser 255 caractères.',

            'object.required' => 'L’objet du message est requis.',
            'object.string' => 'L’objet du message doit être une chaîne de caractères.',
            'object.max' => 'L’objet du message ne doit pas dépasser 255 caractères.',

            'message.required' => 'Le contenu du message est requis.',
            'message.string' => 'Le contenu du message doit être une chaîne de caractères.',
        ]);

        if ($validator->fails()) {
            $firstErrorMessage = $validator->errors()->first();
            return redirect()->back()
                ->with('error', $firstErrorMessage);
        }

        // TODO: Réactiver l'envoi email quand le SMTP sera configuré
        // Mail::to('hello@kksmartcom.com')->send(new ContactMail($request->all()));

        return redirect()->back()->with('success', 'Message envoyé.');
    }

    public function searchStore(Request $request)
    {
        $posts = Post::all();

        if ($request->has('query') && $request->input('query') != '') {
            $query = $request->input('query');

            $posts = Post::where(function ($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%");
            })
                ->where('type', '!=', 'event')
                ->paginate(9);
        } else {
            $posts = Post::where('type', '!=', 'event')->paginate(9);
        }

        return view('apps.pages.posts', compact('posts'));
    }
}
