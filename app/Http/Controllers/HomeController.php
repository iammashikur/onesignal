<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('home');


    }

    public function Push(Request $request)
    {

        function sendMessage($title, $body, $image, $url) {

            $fields = array(
                'app_id' => "776af65f-5b4c-47e3-b437-e8608b2d4836",
                'included_segments' => array('All'),
                'headings' => array('en' => $title),
                'contents' => array('en' => $body),
                'big_picture' => $image,
                'url' => $url

            );

            $fields = json_encode($fields);
            print("\nJSON sent:\n");
            print($fields);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json; charset=utf-8',
                'Authorization: Basic NDJkMWI1OWEtMDY5YS00MTA4LTljMWYtN2U3ZDE0OGYyNDlj'
            ));


            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

            $response = curl_exec($ch);
            curl_close($ch);
        }


            $image = $request->file('image');
            $name = time();
            $folder = 'uploads/';
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            $touch = Image::make($image);
            $touch->fit(720, 480);
            $touch->save(public_path('storage/'.$filePath));


        sendMessage($request->title, $request->body, url('/').'/storage/'.$filePath, $request->url);
        return redirect()->back()->with('message', 'Notification Sent!');

    }


}
