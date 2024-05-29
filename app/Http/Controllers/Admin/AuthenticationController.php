<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\GeneratedTokensOrIDs;
use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use App\Http\Services\GoogleRecaptchaV3;
use App\Mail\MailONECI;
use App\Models\Entreprise;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
  // Login page
  public function showLogin(){
    if(Auth::check()) {
      Auth::logout();
    }
    $pageConfigs = ['bodyCustomClass'=> 'bg-full-screen-image'];
    return view('admin.auth.login',['pageConfigs' => $pageConfigs]);
  }

  // Register page
  public function showRegister(){
    $pageConfigs = ['bodyCustomClass'=> 'bg-full-screen-image'];
    $entreprises = User::where('users_role_id', 4)->get();
    return view('admin.auth.register',['pageConfigs' => $pageConfigs, 'entreprises' => $entreprises]);
  }
   // Forget Password page
   public function showForgotPassword(){
    $pageConfigs = ['bodyCustomClass'=> 'bg-full-screen-image'];
    return view('admin.auth.passwords.forgot',['pageConfigs' => $pageConfigs]);
  }
   // reset Password page
   public function showResetPassword(Request $request, $id_tag){
     $validator = Validator::make(request()->all(), [
       'l' => ['required', 'string', 'max:50']
     ]);
     // En cas de validation réussie
     if (!$validator->fails()) {
         $user = User::where('id_tag', $id_tag)->latest()->first();
         if(!empty($user)) {
             if($request->input('l') === md5($user->uuid.date('Y-m-d H').env('APP_KEY'))) {
                 $pageConfigs = ['bodyCustomClass'=> 'bg-full-screen-image'];
                 return view('admin.auth.passwords.reset',['pageConfigs' => $pageConfigs]);
             }
         }
     }
     return redirect()->route('admin.auth.login');
  }

  // Password Confirmation page
  public function showPasswordConfirm(){
    $pageConfigs = ['bodyCustomClass'=> 'bg-full-screen-image'];
    return view('admin.auth.passwords.confirm',['pageConfigs' => $pageConfigs]);
  }

  // Verify page
  public function showVerify() {
    if(session()->has('user')) {
        $pageConfigs = ['bodyCustomClass'=> 'bg-full-screen-image'];
        $user = session()->get('user');
        session()->forget('user');
        if(!empty($user->email) && empty($user->email_verified_at)) {
            MailONECI::sendMailTemplate('admin.auth.layouts.mails.verify-email', [
                'verify_url' => route('admin.auth.verify.check', ['id_tag' => $user->id_tag]).'?l='.md5($user->uuid.date('Y-m-d H').env('APP_KEY')),
                'user' => $user,
                'email' => $user->email,
            ], __("admin.auth.email_verification_subject"));
        }
        if(session()->has('resent')) return view('admin.auth.verify',['pageConfigs' => $pageConfigs, 'user' => $user, 'resent' => true]);
        elseif(session()->has('account_created')) return view('admin.auth.verify',['pageConfigs' => $pageConfigs, 'user' => $user, 'account_created' => true]);
        else return view('admin.auth.verify',['pageConfigs' => $pageConfigs, 'user' => $user]);
    } else {
        return redirect()->route('admin.auth.login');
    }

  }

  public function submitLogin(Request $request): \Illuminate\Http\RedirectResponse {
    /* Vérification CAPTCHA serveur si le service de vérification Google reCAPTCHA v3 est actif */
    (new GoogleRecaptchaV3())->verify($request)['error'] ??
      redirect()->route('admin.auth.login')->with((new GoogleRecaptchaV3())->verify($request));
    /* Valider les variables du formulaire */
    $validatedData = $request->validate([
      'username_or_email' => ['required', 'string', 'max:100'],
      'password' => ['required', 'string', 'max:50'],
      'remember_me' => ['sometimes']
    ]);
    /* Validation selon qu'il y a soit l'email ou le pseudonyme */
    $credentials = ['password' => $validatedData['password']];
    $usernameOrEmail = $validatedData['username_or_email'];
    if (filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL)) {
      $credentials['email'] = $usernameOrEmail;
    } else {
        $credentials['login'] = $usernameOrEmail;
    }
    $remember = isset($validatedData['remember_me']) && $validatedData['remember_me'];

    /* Authentification de l'utilisateur */
    if (Auth::attempt($credentials, $remember)) {
        if(auth()->user()->status_id === 0) {
            Auth::check() ?? Auth::logout();
            return back()->withInput()->withErrors(__('admin.auth.locked'));
        }
      // Successfully authenticated
      return redirect()->route('admin.home');
    } else {
      // Authentication failed
      // return back()->withInput()->withErrors(__('admin.auth.failed'));
      throw ValidationException::withMessages(['username_or_email' => __('admin.auth.failed')]);
    }
  }

  public function submitRegister(Request $request) {
      // Vérification CAPTCHA serveur si le service de vérification Google reCAPTCHA v3 est actif
          (new GoogleRecaptchaV3())->verify($request)['error'] ??
          redirect()->route('admin.auth.register')->with((new GoogleRecaptchaV3())->verify($request));

      // Valider les variables du formulaire
      $validator = Validator::make(request()->all(), [
          'username' => ['required', 'string', 'max:50'],
          'password' => ['required', 'confirmed', 'min:6', 'max:50'],
          'first_name' => ['required', 'string', 'max:150'],
          'last_name' => ['required', 'string', 'max:50'],
          'gender' => ['required', 'string', 'max:1'],
          'email' => [
              'required',
              'string',
              'email:rfc,dns',
              'max:100',
              'unique:users',
              //'regex:/^\w+[-\.\w]*@(?!(?:outlook|yopmail|yahoo)\.com$)\w+[-\.\w]*?\.\w{2,4}$/'
              //'regex:/^\w+[-\.\w]*@(?!hotmail\.fr|outlook\.com|gmail\.com|myemail\.com|yahoo\.com)\w+[-\.\w]*?\.\w{2,4}$/'
              //'regex:/^\w+[-\.\w]*@(?!' . $excludedDomainsRegex . ')\w+[-\.\w]*?\.\w{2,4}$/'
              function ($attribute, $value, $fail) {
                  if (!(new Utils())->validateDomain($value, false)) {
                      list(, $domain) = explode('@', $value);
                      $fail(__('admin.auth.email_excluded_domain', ['domain' => $domain]));
                  }
              }
          ],
          'msisdn' => ['required', 'string', 'max:14'],
          'affiliate_account_number' => ['nullable', 'numeric', 'max:14'] // Id Tag du compte de parrainage
      ]);

      // En cas d'échec de validation
      if ($validator->fails()) {
          return redirect()->route('admin.auth.register')->withErrors($validator)->withInput()->with('active_tab', 'individual-profile');
      }

      // Création du compte de l'utilisateur en base
      $uid = Str::uuid();
      $affiliate_user = User::where('id_tag', $request->input('affiliate_account_number'))->first();
      $user = User::create([
          'id_tag' => (new GeneratedTokensOrIDs())->generateUniqueNumberID('id_tag'),
          'uuid' => $uid,
          'users_role_id' => 6, // Utilisateur Standard
          'username' => $request->input('username'),
          'password' => Hash::make($request->input('password')),
          'last_name' => strtoupper($request->input('last_name')),
          'first_name' => strtoupper($request->input('first_name')),
          'gender' => $request->input('gender'),
          'email' => $request->input('email'),
          'msisdn' => $request->input('msisdn'),
          'status_id' => 1,
          'affiliate_account_uuid' => ($affiliate_user->uuid) ?? "",
          'is_active' => 1,
          'is_locked' => 0,
          'is_monitored' => 1,
          'is_deleted' => 0,
          'expiry_account_datetime' => null
      ]);

      // Redirect to verify screen
      return redirect()->route('admin.auth.verify')->with(['user' => $user, 'account_created' => true]);

  }

  public function submitRegisterCompany(Request $request): \Illuminate\Http\RedirectResponse {

    // Vérification CAPTCHA serveur si le service de vérification Google reCAPTCHA v3 est actif
    (new GoogleRecaptchaV3())->verify($request)['error'] ??
    redirect()->route('admin.auth.register')->with((new GoogleRecaptchaV3())->verify($request));

    // Valider les variables du formulaire
    $validator = Validator::make(request()->all(), [
        'registry_number' => ['required', 'string', 'max:50'],
        'password' => ['required', 'confirmed', 'min:6', 'max:50'],
        'company_name' => ['required', 'string', 'max:150'],
        'legal_status' => ['required', 'string', 'max:50'],
        'company_type' => ['required', 'string', 'max:2'],
        'address' => ['required', 'string', 'max:150'],
        'owner_name' => ['required', 'string', 'max:150'],
        'email' => [
            'required',
            'string',
            'email:rfc,dns',
            'max:100',
            'unique:users',
            //'regex:/^\w+[-\.\w]*@(?!(?:outlook|yopmail|yahoo)\.com$)\w+[-\.\w]*?\.\w{2,4}$/'
            //'regex:/^\w+[-\.\w]*@(?!hotmail\.fr|outlook\.com|gmail\.com|myemail\.com|yahoo\.com)\w+[-\.\w]*?\.\w{2,4}$/'
            //'regex:/^\w+[-\.\w]*@(?!' . $excludedDomainsRegex . ')\w+[-\.\w]*?\.\w{2,4}$/'
            function ($attribute, $value, $fail) {
                if (!(new Utils())->validateDomain($value, true)) {
                    list(, $domain) = explode('@', $value);
                    $fail(__('admin.auth.email_excluded_domain', ['domain' => $domain]));
                }
            }
        ],
        'msisdn' => ['required', 'string', 'max:14'],
        'logo' => ['required', 'mimes:jpeg,png,jpg', 'max:2048']
    ]);

    // En cas d'échec de validation
    if ($validator->fails()) {
      return redirect()->route('admin.auth.register')->withErrors($validator)->withInput()->with('active_tab', 'company-profile');
    }

    // Création du compte de l'entreprise en base
    $uid = Str::uuid();
    $user = User::create([
        'id_tag' => (new GeneratedTokensOrIDs())->generateUniqueNumberID('id_tag'),
        'uuid' => $uid,
        'users_role_id' => 4,
        'username' => $request->input('registry_number'),
        'password' => Hash::make($request->input('password')),
        'last_name' => strtoupper($request->input('legal_status')),
        'first_name' => strtoupper($request->input('company_name')),
        'gender' => $request->input('company_type'),
        'email' => $request->input('email'),
        'msisdn' => $request->input('msisdn'),
        'status_id' => 1,
        'is_active' => 1,
        'is_locked' => 0,
        'is_monitored' => 1,
        'is_deleted' => 0,
        'expiry_account_datetime' => null
    ]);

    // Sauvegarde serveur du logo de l'entreprise
    $logo_entreprise_filename = $request->input('registry_number').'.'.$request->file('logo')->extension();
    $logo_entreprise = $request->file('logo')->storeAs('media/company/logo', $logo_entreprise_filename, 'public');
    // Conversion en base 64 du logo de l'entreprise
    $logo_entreprise_base64 = 'data:image/'.$request->file('logo')->extension().';base64, '.base64_encode(Storage::disk('public')->get($logo_entreprise));
    //echo '<img src="'.$logo_entreprise_base64.'" alt="Logo de l'entreprise" />';

    // Ajout des informations de l'entreprise en base
    Entreprise::create([
    'euid' => $uid,
    'nom' => ucwords($request->input('company_name')),
    'raison_sociale' => strtoupper($request->input('company_name')),
    'statut_juridique' => strtoupper($request->input('legal_status')),
    'siege_social' => strtoupper($request->input('address')),
    'logo' => $logo_entreprise_base64,
    'adresse' => $request->input('address'),
    'localisation' => strtoupper($request->input('address')),
    'numero_registre' => $request->input('registry_number'),
    'nom_gerant' => $request->input('owner_name'),
    'type_entreprise' => $request->input('company_type')
    ]);

    // Redirect to verify screen
    return redirect()->route('admin.auth.verify')->with(['user' => $user, 'account_created' => true]);

  }

  public function submitRegisterIndividual(Request $request) {

      // Vérification CAPTCHA serveur si le service de vérification Google reCAPTCHA v3 est actif
      (new GoogleRecaptchaV3())->verify($request)['error'] ??
        redirect()->route('admin.auth.register')->with((new GoogleRecaptchaV3())->verify($request));

      // Valider les variables du formulaire
      $validator = Validator::make(request()->all(), [
          'username' => ['required', 'string', 'max:50'],
          'password' => ['required', 'confirmed', 'min:6', 'max:50'],
          'first_name' => ['required', 'string', 'max:150'],
          'last_name' => ['required', 'string', 'max:50'],
          'gender' => ['required', 'string', 'max:1'],
          'email' => [
              'required',
              'string',
              'email:rfc,dns',
              'max:100',
              'unique:users',
              //'regex:/^\w+[-\.\w]*@(?!(?:outlook|yopmail|yahoo)\.com$)\w+[-\.\w]*?\.\w{2,4}$/'
              //'regex:/^\w+[-\.\w]*@(?!hotmail\.fr|outlook\.com|gmail\.com|myemail\.com|yahoo\.com)\w+[-\.\w]*?\.\w{2,4}$/'
              //'regex:/^\w+[-\.\w]*@(?!' . $excludedDomainsRegex . ')\w+[-\.\w]*?\.\w{2,4}$/'
              function ($attribute, $value, $fail) {
                  if (!(new Utils())->validateDomain($value, false)) {
                      list(, $domain) = explode('@', $value);
                      $fail(__('admin.auth.email_excluded_domain', ['domain' => $domain]));
                  }
              }
          ],
          'msisdn' => ['required', 'string', 'max:14'],
          'company_number' => ['required', 'string', 'max:14']
      ]);

      // En cas d'échec de validation
      if ($validator->fails()) {
          return redirect()->route('admin.auth.register')->withErrors($validator)->withInput()->with('active_tab', 'individual-profile');
      }

      // Création du compte de l'utilisateur en base
      $uid = Str::uuid();
      $affiliate_user = User::where('id_tag', $request->input('company_number'))->first();
      $user = User::create([
          'id_tag' => (new GeneratedTokensOrIDs())->generateUniqueNumberID('id_tag'),
          'uuid' => $uid,
          'users_role_id' => 5,
          'username' => $request->input('username'),
          'password' => Hash::make($request->input('password')),
          'last_name' => strtoupper($request->input('last_name')),
          'first_name' => strtoupper($request->input('first_name')),
          'gender' => $request->input('gender'),
          'email' => $request->input('email'),
          'msisdn' => $request->input('msisdn'),
          'status_id' => 1,
          'affiliate_account_uuid' => ($affiliate_user->uuid) ?? "",
          'is_active' => 1,
          'is_locked' => 0,
          'is_monitored' => 1,
          'is_deleted' => 0,
          'expiry_account_datetime' => null
      ]);

      // Ajout des informations de l'employé en base
      /*Agent::create([
          'euid' => $uid,
          'nom' => ucwords($request->input('company_name')),
          'raison_sociale' => strtoupper($request->input('company_name')),
          'statut_juridique' => strtoupper($request->input('legal_status')),
          'siege_social' => strtoupper($request->input('address')),
          'logo' => $logo_entreprise_base64,
          'adresse' => $request->input('address'),
          'localisation' => strtoupper($request->input('address')),
          'numero_registre' => $request->input('registry_number'),
          'nom_gerant' => $request->input('owner_name'),
          'type_entreprise' => $request->input('company_type')
      ]); */

      // Redirect to verify screen
      return redirect()->route('admin.auth.verify')->with(['user' => $user, 'account_created' => true]);

  }

  public function submitForgotPassword(Request $request) {
    /* Vérification CAPTCHA serveur si le service de vérification Google reCAPTCHA v3 est actif */
    (new GoogleRecaptchaV3())->verify($request)['error'] ??
      redirect()->route('admin.auth.password.forgot')->with((new GoogleRecaptchaV3())->verify($request));
    /* Valider les variables du formulaire */
    request()->validate([
      'email' => [
        'required',
        'string',
        'email:rfc,dns',
        'max:100',
        'exists:users,email'
      ]
    ]);

    $user = User::where('email', $request->input('email'))->latest()->first();
    if(!empty($user)) {
        /* Envoi du lien de réinitialisation par email */
        MailONECI::sendMailTemplate('admin.auth.layouts.mails.reset-password-email', [
            'verify_url' => route('admin.auth.password.reset', ['id_tag' => $user->id_tag]).'?l='.md5($user->uuid.date('Y-m-d H').env('APP_KEY')),
            'user' => $user,
            'email' => $user->email,
        ], __("admin.auth.email_reset_password_subject", ['platform_name' => env("APP_NAME")]));
        /* Redirection sur vue d'envoi avec succès */
        return back()->with(['error' => false, 'success_message' => __('admin.auth.page_forgot_password_content_8', ['platform_name' => env("APP_NAME")])]);
    }
    /* Redirection sur vue d'envoi avec message d'erreur */
    return back()->withInput()->with(['error' => true, 'error_message' => __('admin.auth.page_forgot_password_content_9')]);
  }

  public function submitResetPassword(Request $request) {
    /* Vérification CAPTCHA serveur si le service de vérification Google reCAPTCHA v3 est actif */
    (new GoogleRecaptchaV3())->verify($request)['error'] ??
          redirect()->back()->withInput()->with((new GoogleRecaptchaV3())->verify($request));
    /* Valider les variables du formulaire */
    request()->validate([
      'password' => ['required', 'confirmed', 'min:6', 'max:50'],
      'reset-link' => ['required', 'string', 'max:200']
    ]);
    /* Découpage de "reset-link" et récupération des paramètres */
    $id_tag = basename(parse_url($request->input('reset-link'), PHP_URL_PATH));
    parse_str(parse_url($request->input('reset-link'), PHP_URL_QUERY), $queryParameters);
    $l_value = (isset($queryParameters['l'])) ? $queryParameters['l'] : "";
    /* Vérification de l'authenticité du lien */
    if(!empty($id_tag) && !empty($l_value)) {
        $user = User::where('id_tag', $id_tag)->latest()->first();
        if(!empty($user) && md5($user->uuid.date('Y-m-d H').env('APP_KEY')) === $l_value) {
            /* Mettre à jour le mot de passe de cet utilisateur */
            $user->password_change = $user->password;
            $user->password = Hash::make($request->input('password'));
            $user->last_changed_password_datetime = date('Y-m-d H:i:s');
            $user->save();
            /* Retourner vue modification effectuée */
            return back()->with([
                'error' => false,
                'success_message' => __('admin.auth.page_reset_password_content_9')
            ]);
        }
    }
    /* Retourner un message d'erreur */
    return back()->withInput()->with(['error' => true, 'error_message' => __('admin.auth.page_forgot_password_content_9')]);
  }

  public function submitPasswordConfirm(Request $request) {
    /* Vérification CAPTCHA serveur si le service de vérification Google reCAPTCHA v3 est actif */
      (new GoogleRecaptchaV3())->verify($request)['error'] ??
      redirect()->route('admin.auth.password.reset')->with((new GoogleRecaptchaV3())->verify($request));
    /* Valider les variables du formulaire */
    request()->validate([
      'password' => ['required', 'string', 'max:50']
    ]);
    /* Stocker variables en base */
  }

  public function sendVerify(Request $request) {
    request()->validate([
        't' => ['required', 'string', 'max:100'],
    ]);
    $id_tag = $request->input('t');
    if(!empty($id_tag)) {
        $user = User::where('id_tag', $id_tag)->first();
        return redirect()->route('admin.auth.verify')->with(['user' => $user, 'resent' => true]);
    }

    return redirect()->route('admin.auth.login');
  }

  public function submitVerify(Request $request, $id_tag) {
    request()->validate([
      'l' => ['required', 'string', 'max:100']
    ]);
    if(!empty($id_tag)) {
      $user = User::where('id_tag', $id_tag)->first();
      if($request->input('l') === md5($user->uuid.date('Y-m-d H').env('APP_KEY'))){
          $user->email_verified_at = date('Y-m-d H:i:s');
          //$user->status_id = ($user->status_id == 1) ?? 2; // Statut "vérifié" automatiquement après vérification email
          $user->save();

          return redirect()->route('admin.auth.verify')->with(['user' => $user]);
      }
    }

    return redirect()->route('admin.auth.login');
  }

  /*
   * @TODO:
   *    Multiple Factor authentication,
   *    User Activity Tracking (client, browser, etc...),
   *    Wrong password attempts counter (locked account),
   *    Anti-Brute force script by sleep(5000) after wrong password attempt.
   * */


}
