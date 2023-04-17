<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function (\App\Services\OpenaiService $service) {
    $contents = $service->chat("以下会話文章をjsonデータで出力せよ。
    文字は不要です。
    必要なデータは、開始日時(キー名はstarted_at)、終了日時(キー名はended_at)、タイトル(キー名はtitle)です。
    終了日時が見当たらない場合、nullとしてください。
    〆切は含まないでください。
    開始日時と終了日時が不明な場合、データとして扱わないでください。
    同じ日時は同一データとして扱ってください。

    ### 会話文章

    締め切り　5月7日　24時

    朝活ホームミーティング
    5月14日　日曜日

    朝10時〜11時30分
    いつもと時間違うのでお気を付けてください

    早めの入場に協力ください。

    アムウェイプラザ🅰️ルーム


    会場     500円
    zoom     500円

    チケット枚数を〆切までにコメントお願いします😊

    ⭐️zoomは電波の関係で通信が不安定になる可能性あるので了承ください。
    ");
    dd($contents);
    //return view('welcome');
});
